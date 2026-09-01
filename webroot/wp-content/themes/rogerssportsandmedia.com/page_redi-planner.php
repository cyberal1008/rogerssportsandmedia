<?php
/**
 * Template Name: R.E.D.i Planner
 *
 * Campaign planning form. Field options come from the parent theme's
 * inc/redi-planner/config.php, which is the same file the REST validator
 * uses, so the form and the server can't drift apart. Submissions go to
 * /wp-json/redi/v1/submit (see inc/redi-planner/redi-planner.php).
 */

$redi_config = redi_planner_get_config(); // parent theme inc/redi-planner.

// Split the flat market list into display groups for the dropdown.
// Tier labels for the duplicated market names are still pending.
$redi_national  = array( 'Canada', 'Canada Excl. Quebec', 'Atlantic' );
$redi_provinces = array(
	'British Columbia', 'Alberta', 'Saskatchewan', 'Manitoba', 'Ontario', 'Quebec',
	'New Brunswick', 'Nova Scotia', 'Prince Edward Island', 'Newfoundland & Labrador',
);
$redi_markets   = array_values( array_diff( $redi_config['markets'], $redi_national, $redi_provinces ) );

get_header();
?>

<main id="content" role="main">
	<div class="redi-page">
		<div class="wrapper">

			<div class="redi-intro">
				<img class="redi-logo"
					src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/redi-planner/redi-planner-logo.png' ); ?>"
					alt="R.E.D.i Planner" width="1000" height="500" />
				<h1 class="redi-sr-only">Plan Your Campaign with R.E.D.i</h1>
				<p>Tell us about your campaign across Rogers Sports &amp; Media platforms and we&rsquo;ll email you a detailed plan.</p>
			</div>

			<div class="redi-card" id="redi-form-card">
				<div class="redi-form-error" id="redi-form-error" role="alert"></div>

				<form id="redi-form" class="redi-form" novalidate>

					<fieldset>
						<legend>Campaign Details</legend>
						<div class="redi-grid">

							<div class="redi-field redi-field--full">
								<label for="redi-name">Campaign Name
									<span class="redi-tip" tabindex="0" title="Please provide a descriptive campaign name that includes the advertiser/brand, campaign or product name, timing, and market details (e.g., Client Name Special Rewards Membership Q4 2026 English Canada)." aria-label="Please provide a descriptive campaign name that includes the advertiser/brand, campaign or product name, timing, and market details (e.g., Client Name Special Rewards Membership Q4 2026 English Canada).">?</span>
								</label>
								<input type="text" id="redi-name" name="campaignName" maxlength="100" autocomplete="off" />
								<p class="redi-error" id="redi-error-campaignName"></p>
							</div>

							<div class="redi-field">
								<label for="redi-market">Campaign Market</label>
								<select id="redi-market" name="campaignMarket">
									<option value="">Select a market</option>
									<optgroup label="National">
										<?php foreach ( $redi_national as $market ) : ?>
											<option value="<?php echo esc_attr( $market ); ?>"><?php echo esc_html( $market ); ?></option>
										<?php endforeach; ?>
									</optgroup>
									<optgroup label="Provinces">
										<?php foreach ( $redi_provinces as $market ) : ?>
											<option value="<?php echo esc_attr( $market ); ?>"><?php echo esc_html( $market ); ?></option>
										<?php endforeach; ?>
									</optgroup>
									<optgroup label="Markets">
										<?php foreach ( $redi_markets as $market ) : ?>
											<option value="<?php echo esc_attr( $market ); ?>"><?php echo esc_html( $market ); ?></option>
										<?php endforeach; ?>
									</optgroup>
								</select>
								<p class="redi-error" id="redi-error-campaignMarket"></p>
							</div>

							<div class="redi-field">
								<label for="redi-budget">Campaign Budget <span class="redi-hint">(min $<?php echo esc_html( number_format( $redi_config['budget_min'] ) ); ?>)</span></label>
								<div class="redi-currency">
									<span>$</span>
									<input type="text" id="redi-budget" name="campaignBudget" inputmode="numeric" autocomplete="off" placeholder="25,000" />
								</div>
								<p class="redi-error" id="redi-error-campaignBudget"></p>
							</div>

							<div class="redi-field">
								<label for="redi-start-date">Campaign Start Date</label>
								<input type="date" id="redi-start-date" name="startDate" min="<?php echo esc_attr( current_time( 'Y-m-d' ) ); ?>" />
								<p class="redi-error" id="redi-error-startDate"></p>
							</div>

							<div class="redi-field">
								<label for="redi-duration">Campaign Duration <span class="redi-hint">(weeks)</span></label>
								<select id="redi-duration" name="durationWeeks">
									<option value="">Select duration</option>
									<?php foreach ( $redi_config['durations'] as $weeks ) : ?>
										<option value="<?php echo esc_attr( $weeks ); ?>"><?php echo esc_html( $weeks ); ?> weeks</option>
									<?php endforeach; ?>
								</select>
								<p class="redi-error" id="redi-error-durationWeeks"></p>
							</div>

							<div class="redi-field redi-field--full">
								<label for="redi-category">Advertiser Category</label>
								<input type="text" id="redi-category" name="advertiserCategory" list="redi-category-list"
									autocomplete="off" placeholder="Type to search categories" />
								<datalist id="redi-category-list">
									<?php foreach ( $redi_config['categories'] as $category ) : ?>
										<option value="<?php echo esc_attr( $category ); ?>"></option>
									<?php endforeach; ?>
								</datalist>
								<p class="redi-error" id="redi-error-advertiserCategory"></p>
							</div>

						</div>
					</fieldset>

					<fieldset>
						<legend>Platforms &amp; Content</legend>

						<div class="redi-field">
							<span class="redi-choice-label">Campaign Platforms <span class="redi-hint">(select all that apply)</span></span>
							<div class="redi-choices">
								<?php foreach ( $redi_config['platforms'] as $platform ) : ?>
									<label class="redi-choice">
										<input type="checkbox" name="campaignPlatforms" value="<?php echo esc_attr( $platform ); ?>" />
										<span><?php echo esc_html( $platform ); ?></span>
									</label>
								<?php endforeach; ?>
								<span class="redi-choice redi-choice--soon" aria-disabled="true">
									<span>OOH <em>Coming Soon</em></span>
								</span>
							</div>
							<p class="redi-error" id="redi-error-campaignPlatforms"></p>
						</div>

						<div class="redi-field" style="margin-top: 20px;">
							<span class="redi-choice-label">Media Content</span>
							<div class="redi-choices">
								<?php foreach ( $redi_config['media_content'] as $content ) : ?>
									<label class="redi-choice redi-choice--radio">
										<input type="radio" name="mediaContent" value="<?php echo esc_attr( $content ); ?>" />
										<span><?php echo esc_html( $content ); ?></span>
									</label>
								<?php endforeach; ?>
							</div>
							<p class="redi-error" id="redi-error-mediaContent"></p>
						</div>
					</fieldset>

					<fieldset>
						<legend>Detailed Plan</legend>

						<div class="redi-field">
							<label for="redi-email">Email Address <span class="redi-hint">(your plan is emailed here)</span></label>
							<input type="email" id="redi-email" name="emailAddress" autocomplete="email" placeholder="you@company.com" required />
							<p class="redi-error" id="redi-error-emailAddress"></p>
						</div>
					</fieldset>

					<div class="redi-hp" aria-hidden="true">
						<label for="redi-website">Website</label>
						<input type="text" id="redi-website" name="website" tabindex="-1" autocomplete="off" />
					</div>

					<div class="redi-submit-row">
						<button type="submit" id="redi-submit" class="button">Get My Plan</button>
						<p class="redi-disclaimer">By submitting this form you agree to the Rogers <a href="/legal/" target="_blank" rel="noopener noreferrer">Terms &amp; Conditions</a>.</p>
					</div>

				</form>
			</div>

			<div class="redi-results" id="redi-results">
				<div class="redi-confirm" id="redi-confirm">
					<strong>Your detailed plan is on its way.</strong>
					Your plan will be emailed to you soon. If you have any questions in the meantime, reach out to <a href="mailto:r.e.d.iplanner@rci.rogers.com">r.e.d.iplanner@rci.rogers.com</a>.
					<p class="redi-request-id" id="redi-request-id"></p>
				</div>
				<div class="redi-start-over">
					<button type="button" id="redi-start-over" class="button">Plan Another Campaign</button>
				</div>
			</div>

		</div>
	</div>
</main>

<?php get_footer(); ?>
