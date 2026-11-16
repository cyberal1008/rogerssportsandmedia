<?php
/**
 * R.E.D.i Planner reach and budget allocation calculator.
 *
 * @package rdm-rsm-parent
 */

class Redi_Planner_Calculator {

	public function calculate( array $input, array $lookup ) {
		$channels = array();
		$platforms = $input['campaignPlatforms'];
		$content = $input['mediaContent'];

		if ( in_array( 'Radio', $platforms, true ) ) {
			$channels[] = 'Radio';
		}
		if ( in_array( 'Podcast', $platforms, true ) ) {
			$channels[] = 'Podcast';
		}
		if ( in_array( 'Linear TV', $platforms, true ) ) {
			if ( in_array( $content, array( 'Sports', 'Both' ), true ) ) {
				$channels[] = 'Sports - Linear TV';
			}
			if ( in_array( $content, array( 'News & Entertainment', 'Both' ), true ) ) {
				$channels[] = 'NE CityTV - Linear TV';
				$channels[] = 'NE Specialty - Linear TV';
			}
		}
		if ( in_array( 'Streaming TV', $platforms, true ) ) {
			if ( in_array( $content, array( 'Sports', 'Both' ), true ) ) {
				$channels[] = 'Sports - Streaming TV';
			}
			if ( in_array( $content, array( 'News & Entertainment', 'Both' ), true ) ) {
				$channels[] = 'NE - Streaming TV';
			}
		}

		if ( ! $channels || ! is_finite( (float) $input['campaignBudget'] ) || $input['campaignBudget'] <= 0 ) {
			throw new InvalidArgumentException( 'Invalid budget or platform selection.' );
		}

		$curves = array();
		$total_population = 0;
		foreach ( $channels as $channel ) {
			$universe = strpos( $channel, 'TV' ) !== false ? 'TV Universe' : $channel . ' Universe';
			$population = $lookup['reach'][ $universe ] ?? null;
			$limit = $lookup['reach'][ $channel ] ?? null;
			$cpm = $lookup['cpm'][ $channel ] ?? null;
			if ( ! is_numeric( $population ) || $population <= 0 || ! is_numeric( $limit ) || $limit < 0 || $limit > 1 || ! is_numeric( $cpm ) || $cpm <= 0 ) {
				throw new RuntimeException( 'Missing or invalid lookup data for ' . $channel . '.' );
			}
			$population = (float) $population;
			$factor = $population <= 100000
				? ( strpos( $channel, 'Streaming TV' ) !== false ? 1.5 : ( $channel === 'Podcast' ? 2 : 1.25 ) )
				: ( strpos( $channel, 'Streaming TV' ) !== false ? 2 : ( $channel === 'Podcast' ? 3 : 1.5 ) );
			$p = $factor / $population;
			if ( $p >= 1 ) {
				throw new RuntimeException( 'Invalid population for ' . $channel . '.' );
			}
			$rate = -log1p( -$p ) * 1000 / (float) $cpm;
			$curves[ $channel ] = array( 'limit' => (float) $limit, 'rate' => $rate );
			$total_population = max( $total_population, $population );
		}

		$budget = (float) $input['campaignBudget'];
		$upper = -INF;
		$max_rate = 0.0;
		foreach ( $curves as $curve ) {
			if ( $curve['limit'] > 0 ) {
				$upper = max( $upper, log( $curve['limit'] * $curve['rate'] ) );
				$max_rate = max( $max_rate, $curve['rate'] );
			}
		}
		if ( ! is_finite( $upper ) || ! is_finite( $max_rate * $budget ) ) {
			throw new RuntimeException( 'No reach is available for the selected channels.' );
		}

		// The Python objective maximizes the sum of channel reaches, not combined reach.
		$lower = $upper - $max_rate * $budget;
		for ( $i = 0; $i < 200; $i++ ) {
			$price = ( $lower + $upper ) / 2;
			$sum = 0.0;
			foreach ( $curves as $curve ) {
				if ( $curve['limit'] > 0 ) {
					$sum += max( 0, ( log( $curve['limit'] * $curve['rate'] ) - $price ) / $curve['rate'] );
				}
			}
			if ( $sum > $budget ) {
				$lower = $price;
			} else {
				$upper = $price;
			}
		}

		$spend = array();
		$sum = 0.0;
		foreach ( $curves as $channel => $curve ) {
			$amount = $curve['limit'] > 0 ? max( 0, ( log( $curve['limit'] * $curve['rate'] ) - $upper ) / $curve['rate'] ) : 0.0;
			$spend[ $channel ] = $amount;
			$sum += $amount;
		}
		if ( $sum <= 0 || ! is_finite( $sum ) ) {
			throw new RuntimeException( 'Could not calculate budget allocation.' );
		}

		$unreached = 1.0;
		$platform_spend = array();
		foreach ( $curves as $channel => $curve ) {
			$amount = $spend[ $channel ] * $budget / $sum;
			$reach = $curve['limit'] * -expm1( -$curve['rate'] * $amount );
			$unreached *= 1 - $reach;
			$name = strpos( $channel, 'NE ' ) === 0 ? 'News & Entertainment ' . substr( $channel, 3 ) : $channel;
			$platform_spend[ $name ] = (int) round( $amount, 0, PHP_ROUND_HALF_EVEN );
		}
		$overall_reach = 1 - $unreached;

		return array(
			'overall_reach'      => round( $overall_reach * 100, 2, PHP_ROUND_HALF_EVEN ),
			'total_population'   => (int) $total_population,
			'population_reached' => (int) ( $overall_reach * $total_population ),
			'platform_spend'     => $platform_spend,
		);
	}
}
