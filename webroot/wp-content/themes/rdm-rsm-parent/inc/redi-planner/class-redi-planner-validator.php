<?php
/**
 * R.E.D.i Planner submission validator.
 *
 * Kept as plain PHP with no WordPress functions so it can be tested from
 * the CLI (tests/redi-planner/validator-test.php) without a WP bootstrap.
 * The allowed option lists come in through the constructor. The REST layer
 * builds them from inc/redi-planner/config.php plus wp_options overrides.
 *
 * @package rdm-rsm-parent
 */

class Redi_Planner_Validator {

	private $markets;
	private $platform_restrictions;
	private $platforms;
	private $media_content;
	private $durations;
	private $categories;
	private $budget_min;
	private $today;

	public function __construct( array $config ) {
		$this->markets               = $config['markets'];
		$this->platform_restrictions = $config['platform_restrictions'];
		$this->platforms             = $config['platforms'];
		$this->media_content         = $config['media_content'];
		$this->durations             = array_map( 'intval', $config['durations'] );
		$this->categories            = $config['categories'];
		$this->budget_min            = (float) $config['budget_min'];
		$this->today                 = isset( $config['today'] ) ? $config['today'] : date( 'Y-m-d' );
	}

	/**
	 * Validate raw submission input.
	 *
	 * @param array $input Decoded request body.
	 * @return array { valid: bool, errors: [field => message], data: clean payload }
	 */
	public function validate( array $input ) {
		$errors = array();
		$data   = array();

		// campaignName is the only free text field besides email. Strip tags, trim, cap at 100.
		$name = is_string( $input['campaignName'] ?? null ) ? trim( strip_tags( $input['campaignName'] ) ) : '';
		if ( $name === '' ) {
			$errors['campaignName'] = 'Campaign name is required.';
		} elseif ( mb_strlen( $name ) > 100 ) {
			$errors['campaignName'] = 'Campaign name must be 100 characters or fewer.';
		} else {
			$data['campaignName'] = $name;
		}

		$data['campaignMarket']     = $this->pick_one( $input, 'campaignMarket', $this->markets, 'Select a market.', $errors );
		$data['mediaContent']       = $this->pick_one( $input, 'mediaContent', $this->media_content, 'Select a media content option.', $errors );
		$data['advertiserCategory'] = $this->pick_one( $input, 'advertiserCategory', $this->categories, 'Select an advertiser category.', $errors );

		// campaignBudget accepts "$25,000.50" style input and must clear the minimum.
		$raw_budget = $input['campaignBudget'] ?? '';
		$stripped   = is_scalar( $raw_budget ) ? preg_replace( '/[$,\s]/', '', (string) $raw_budget ) : '';
		if ( $stripped === '' || ! is_numeric( $stripped ) ) {
			$errors['campaignBudget'] = 'Enter a budget amount.';
		} elseif ( (float) $stripped < $this->budget_min ) {
			$errors['campaignBudget'] = sprintf( 'Minimum budget is $%s.', number_format( $this->budget_min ) );
		} else {
			$data['campaignBudget'] = (float) $stripped;
		}

		// campaignPlatforms must be a non-empty array with every entry from the allowed set,
		// and none of them restricted for the submitted campaignMarket.
		$platforms  = $input['campaignPlatforms'] ?? null;
		$restricted = $this->platform_restrictions[ $input['campaignMarket'] ?? '' ] ?? array();
		if ( ! is_array( $platforms ) || count( $platforms ) === 0 ) {
			$errors['campaignPlatforms'] = 'Select at least one platform.';
		} elseif ( count( array_diff( $platforms, $this->platforms ) ) > 0 || count( array_intersect( $platforms, $restricted ) ) > 0 ) {
			$errors['campaignPlatforms'] = 'Invalid platform selection.';
		} else {
			$data['campaignPlatforms'] = array_values( array_unique( $platforms ) );
		}

		// startDate has to be a real calendar date, today or later.
		$date = $input['startDate'] ?? '';
		$dt   = is_string( $date ) ? DateTime::createFromFormat( 'Y-m-d', $date ) : false;
		if ( ! $dt || $dt->format( 'Y-m-d' ) !== $date ) {
			$errors['startDate'] = 'Enter a valid start date.';
		} elseif ( $date < $this->today ) {
			$errors['startDate'] = 'Start date must be today or later.';
		} else {
			$data['startDate'] = $date;
		}

		// durationWeeks must be one of the allowed dropdown values.
		$duration = $input['durationWeeks'] ?? null;
		if ( ! is_numeric( $duration ) || ! in_array( (int) $duration, $this->durations, true ) ) {
			$errors['durationWeeks'] = 'Select a campaign duration.';
		} else {
			$data['durationWeeks'] = (int) $duration;
		}

		// requestDetailedPlan: normalize bool-ish values and reject anything else.
		$plan = $input['requestDetailedPlan'] ?? null;
		if ( is_string( $plan ) && in_array( strtolower( $plan ), array( 'true', 'false' ), true ) ) {
			$plan = strtolower( $plan ) === 'true';
		}
		if ( ! is_bool( $plan ) ) {
			$errors['requestDetailedPlan'] = 'Choose whether you want a detailed plan.';
		} else {
			$data['requestDetailedPlan'] = $plan;

			// emailAddress is required and validated only when a detailed plan is
			// requested. Otherwise it's forced to null so no PII rides along.
			if ( $plan ) {
				$email = is_string( $input['emailAddress'] ?? null ) ? trim( $input['emailAddress'] ) : '';
				if ( $email === '' || ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
					$errors['emailAddress'] = 'Enter a valid email address.';
				} else {
					$data['emailAddress'] = $email;
				}
			} else {
				$data['emailAddress'] = null;
			}
		}

		if ( count( $errors ) > 0 ) {
			return array( 'valid' => false, 'errors' => $errors, 'data' => array() );
		}
		return array( 'valid' => true, 'errors' => array(), 'data' => $data );
	}

	/**
	 * Validate a required single-select against its allowed list.
	 */
	private function pick_one( array $input, $field, array $allowed, $message, array &$errors ) {
		$value = $input[ $field ] ?? '';
		if ( ! is_string( $value ) || ! in_array( $value, $allowed, true ) ) {
			$errors[ $field ] = $message;
			return null;
		}
		return $value;
	}
}
