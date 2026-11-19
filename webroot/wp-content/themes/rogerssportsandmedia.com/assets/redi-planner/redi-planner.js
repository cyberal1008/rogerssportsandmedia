/**
 * R.E.D.i Planner form validation and submission.
 *
 * Config is injected via wp_localize_script as REDI_PLANNER:
 *   { restUrl, nonce, budgetMin, restrictions }
 *
 * We POST to the WP REST route, which emails the submission to the R.E.D.i
 * mailbox. On success we clear and hide the form (a submitted plan can't
 * be re-edited) and show the detailed-plan confirmation or the instant
 * estimate, not both. On failure we keep everything so the user can retry.
 */
(function () {
	'use strict';

	var form = document.getElementById('redi-form');
	if (!form || typeof REDI_PLANNER === 'undefined') {
		return;
	}

	var formCard = document.getElementById('redi-form-card');
	var results = document.getElementById('redi-results');
	var confirmBox = document.getElementById('redi-confirm');
	var estimateBox = document.getElementById('redi-estimate');
	var detailedConfirm = document.getElementById('redi-detailed-confirm');
	var formError = document.getElementById('redi-form-error');
	var submitBtn = document.getElementById('redi-submit');
	var planCheckbox = document.getElementById('redi-plan');
	var marketSelect = document.getElementById('redi-market');
	var budgetMin = parseFloat(REDI_PLANNER.budgetMin) || 0;
	var restrictions = REDI_PLANNER.restrictions || {};

	function syncPlatformRestrictions() {
		var restricted = restrictions[marketSelect.value] || [];
		form.querySelectorAll('input[name="campaignPlatforms"]').forEach(function (checkbox) {
			var label = checkbox.closest('.redi-choice');
			var isRestricted = restricted.indexOf(checkbox.value) !== -1;
			checkbox.disabled = isRestricted;
			if (isRestricted) {
				checkbox.checked = false;
			}
			if (label) {
				label.classList.toggle('redi-choice--unavailable', isRestricted);
			}
		});
	}

	marketSelect.addEventListener('change', syncPlatformRestrictions);
	syncPlatformRestrictions();

	function syncPlanFields() {
		var wantsPlan = planCheckbox.checked;
		document.querySelectorAll('.redi-plan-only').forEach(function (el) {
			el.classList.toggle('is-hidden', !wantsPlan);
		});
	}

	planCheckbox.addEventListener('change', syncPlanFields);
	syncPlanFields();

	function closeTips(except) {
		document.querySelectorAll('.redi-tip.is-open').forEach(function (tip) {
			if (tip !== except) {
				tip.classList.remove('is-open');
				tip.querySelector('.redi-tip-btn').setAttribute('aria-expanded', 'false');
			}
		});
	}

	document.querySelectorAll('.redi-tip').forEach(function (tip) {
		var btn = tip.querySelector('.redi-tip-btn');
		btn.addEventListener('click', function () {
			var open = tip.classList.toggle('is-open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			closeTips(tip);
		});
	});

	document.addEventListener('click', function (e) {
		if (!e.target.closest('.redi-tip')) {
			closeTips(null);
		}
	});

	document.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') {
			closeTips(null);
		}
	});

	/* --- field errors --- */

	function setError(name, message) {
		var el = document.getElementById('redi-error-' + name);
		var input = form.querySelector('[name="' + name + '"]');
		if (el) {
			el.textContent = message || '';
			el.classList.toggle('is-visible', !!message);
		}
		if (input && input.type !== 'checkbox' && input.type !== 'radio') {
			input.setAttribute('aria-invalid', message ? 'true' : 'false');
		}
	}

	function clearErrors() {
		form.querySelectorAll('.redi-error').forEach(function (el) {
			el.textContent = '';
			el.classList.remove('is-visible');
		});
		form.querySelectorAll('[aria-invalid]').forEach(function (el) {
			el.setAttribute('aria-invalid', 'false');
		});
		formError.classList.remove('is-visible');
	}

	/* --- collect and validate client-side (the server re-validates everything) --- */

	function collect() {
		var platforms = [];
		form.querySelectorAll('input[name="campaignPlatforms"]:checked').forEach(function (cb) {
			platforms.push(cb.value);
		});

		return {
			campaignName: form.campaignName.value.trim(),
			campaignMarket: form.campaignMarket.value,
			campaignBudget: form.campaignBudget.value.trim(),
			campaignPlatforms: platforms,
			mediaContent: form.mediaContent.value,
			startDate: form.startDate.value,
			durationWeeks: form.durationWeeks.value,
			advertiserCategory: form.advertiserCategory.value,
			requestDetailedPlan: planCheckbox.checked,
			emailAddress: planCheckbox.checked ? form.emailAddress.value.trim() : null,
			website: form.website.value // honeypot
		};
	}

	function validate(data) {
		var ok = true;
		var budget = parseFloat(String(data.campaignBudget).replace(/[$,\s]/g, ''));

		if (!data.campaignName) { setError('campaignName', 'Campaign name is required.'); ok = false; }
		else if (data.campaignName.length > 100) { setError('campaignName', 'Campaign name must be 100 characters or fewer.'); ok = false; }

		if (!data.campaignMarket) { setError('campaignMarket', 'Select a market.'); ok = false; }

		if (isNaN(budget) || budget <= 0) { setError('campaignBudget', 'Enter a budget amount.'); ok = false; }
		else if (budget < budgetMin) { setError('campaignBudget', 'Minimum budget is $' + budgetMin.toLocaleString() + '.'); ok = false; }

		if (!data.campaignPlatforms.length) { setError('campaignPlatforms', 'Select at least one platform.'); ok = false; }
		if (!data.mediaContent) { setError('mediaContent', 'Select a media content option.'); ok = false; }
		if (!data.startDate) { setError('startDate', 'Enter a valid start date.'); ok = false; }
		if (!data.durationWeeks) { setError('durationWeeks', 'Select a campaign duration.'); ok = false; }

		// The category field is a searchable text input backed by a datalist,
		// so typed values must match one of the listed categories exactly.
		var categories = Array.prototype.map.call(
			document.querySelectorAll('#redi-category-list option'),
			function (option) { return option.value; }
		);
		if (!data.advertiserCategory || categories.indexOf(data.advertiserCategory) === -1) {
			setError('advertiserCategory', 'Choose a category from the list.');
			ok = false;
		}

		var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
		if (data.requestDetailedPlan && (!data.emailAddress || !emailPattern.test(data.emailAddress))) {
			setError('emailAddress', 'Enter a valid email address.');
			ok = false;
		}
		return ok;
	}

	function trackCompletion() {
		// Site analytics completion event (requirement from Q14).
		if (typeof _satellite !== 'undefined') {
			_satellite.track('redi-planner-detailed');
		}
	}

	function showEstimate(estimate, data) {
		estimateBox.hidden = !estimate;
		if (!estimate) {
			return;
		}
		document.getElementById('redi-estimate-reach').textContent = estimate.overall_reach.toLocaleString() + '%';
		document.getElementById('redi-estimate-population').textContent = estimate.total_population.toLocaleString();
		document.getElementById('redi-estimate-reached').textContent = estimate.population_reached >= 1000000
			? (estimate.population_reached / 1000000).toFixed(1) + 'M'
			: estimate.population_reached.toLocaleString();
		document.getElementById('redi-estimate-campaign-name').textContent = data.campaignName;
		document.getElementById('redi-detail-name').textContent = data.campaignName;
		document.getElementById('redi-detail-market').textContent = data.campaignMarket;
		document.getElementById('redi-detail-budget').textContent = '$' + Number(String(data.campaignBudget).replace(/[$,\s]/g, '')).toLocaleString();
		document.getElementById('redi-detail-platforms').textContent = data.campaignPlatforms.join(', ');
		document.getElementById('redi-detail-content').textContent = data.mediaContent === 'Both'
			? 'Sports and News & Entertainment'
			: data.mediaContent;
		document.getElementById('redi-detail-date').textContent = data.startDate;
		document.getElementById('redi-detail-duration').textContent = data.durationWeeks + (data.durationWeeks === '1' ? ' week' : ' weeks');
		document.getElementById('redi-detail-category').textContent = data.advertiserCategory;
		var list = document.getElementById('redi-estimate-spend');
		var chart = document.getElementById('redi-budget-chart');
		var platforms = Object.keys(estimate.platform_spend);
		var colors = ['#d9291c', '#4d4d4d', '#999999', '#d9d9d9', '#e3e3e3', '#ebebeb', '#f2f2f2'];
		var allocated = platforms.filter(function (platform) {
			return estimate.platform_spend[platform] > 0;
		}).sort(function (a, b) {
			return estimate.platform_spend[b] - estimate.platform_spend[a];
		});
		var total = allocated.reduce(function (sum, platform) {
			return sum + estimate.platform_spend[platform];
		}, 0);
		var segments = [];
		var start = 0;
		list.textContent = '';
		allocated.forEach(function (platform, index) {
			var amount = estimate.platform_spend[platform];
			var color = colors[index % colors.length];
			var percentage = amount / total * 100;
			var item = document.createElement('li');
			var swatch = document.createElement('span');
			swatch.className = 'redi-budget-swatch';
			swatch.style.backgroundColor = color;
			swatch.setAttribute('aria-hidden', 'true');
			item.appendChild(swatch);
			item.appendChild(document.createTextNode(platform + ' — $' + amount.toLocaleString() + ' (' + percentage.toFixed(1) + '%)'));
			list.appendChild(item);
			var end = start + percentage;
			segments.push(color + ' ' + start + '% ' + end + '%');
			start = end;
		});
		chart.hidden = !segments.length;
		chart.style.background = segments.length ? 'conic-gradient(' + segments.join(', ') + ')' : '';
		chart.setAttribute('aria-label', 'Platform spend: ' + allocated.map(function (platform) {
			return platform + ', ' + (estimate.platform_spend[platform] / total * 100).toFixed(1) + ' percent';
		}).join('; '));
	}

	/* --- submit --- */

	form.addEventListener('submit', function (e) {
		e.preventDefault();
		clearErrors();

		var data = collect();
		if (!validate(data)) {
			var firstError = form.querySelector('.redi-error.is-visible');
			if (firstError) {
				firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
			}
			return;
		}

		submitBtn.disabled = true;
		submitBtn.textContent = 'Submitting…';

		fetch(REDI_PLANNER.restUrl, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-Redi-Nonce': REDI_PLANNER.nonce,
				'X-WP-Nonce': REDI_PLANNER.restNonce
			},
			body: JSON.stringify(data)
		})
			.then(function (res) {
				return res.json().then(function (json) {
					return { status: res.status, json: json };
				});
			})
			.then(function (res) {
				if (res.json && res.json.success) {
					if (data.requestDetailedPlan) {
						trackCompletion();
					}
					showEstimate(data.requestDetailedPlan ? null : res.json.estimate, data);
					detailedConfirm.hidden = !data.requestDetailedPlan;
					document.getElementById('redi-request-id').textContent =
						res.json.requestId ? 'Reference: ' + res.json.requestId : '';
					results.classList.add('is-visible');
					confirmBox.classList.add('is-visible');
					// A submitted plan can't be re-edited, so clear and hide the form.
					form.reset();
					syncPlanFields();
					syncPlatformRestrictions();
					formCard.style.display = 'none';
					results.scrollIntoView({ behavior: 'smooth', block: 'start' });
				} else if (res.status === 400 && res.json && res.json.errors) {
					Object.keys(res.json.errors).forEach(function (field) {
						setError(field, res.json.errors[field]);
					});
				} else {
					formError.textContent = (res.json && res.json.message) ||
						"We couldn't submit your plan request. Please try again.";
					formError.classList.add('is-visible');
				}
			})
			.catch(function () {
				formError.textContent = "We couldn't submit your plan request. Please check your connection and try again.";
				formError.classList.add('is-visible');
			})
			.finally(function () {
				submitBtn.disabled = false;
				submitBtn.textContent = 'Get My Plan';
			});
	});

	/* --- start over (new submission after a detailed plan) --- */

	var startOver = document.getElementById('redi-start-over');
	if (startOver) {
		startOver.addEventListener('click', function () {
			results.classList.remove('is-visible');
			confirmBox.classList.remove('is-visible');
			formCard.style.display = '';
			form.reset();
			syncPlanFields();
			syncPlatformRestrictions();
			clearErrors();
			formCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	}
})();
