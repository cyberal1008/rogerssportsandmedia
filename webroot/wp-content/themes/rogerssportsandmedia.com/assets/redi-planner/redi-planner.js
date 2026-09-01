/**
 * R.E.D.i Planner form validation and submission.
 *
 * Config is injected via wp_localize_script as REDI_PLANNER:
 *   { restUrl, nonce, budgetMin }
 *
 * Every submission requests a detailed plan. We POST to the WP REST route,
 * which emails the submission to the R.E.D.i mailbox. On success we clear
 * and hide the form (a submitted plan can't be re-edited) and show the
 * confirmation. On failure we keep everything so the user can retry.
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
	var formError = document.getElementById('redi-form-error');
	var submitBtn = document.getElementById('redi-submit');
	var budgetMin = parseFloat(REDI_PLANNER.budgetMin) || 0;

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
			requestDetailedPlan: true,
			emailAddress: form.emailAddress.value.trim(),
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
		if (!data.emailAddress || !emailPattern.test(data.emailAddress)) {
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
					trackCompletion();
					document.getElementById('redi-request-id').textContent =
						res.json.requestId ? 'Reference: ' + res.json.requestId : '';
					results.classList.add('is-visible');
					confirmBox.classList.add('is-visible');
					// A submitted plan can't be re-edited, so clear and hide the form.
					form.reset();
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
			clearErrors();
			formCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	}
})();
