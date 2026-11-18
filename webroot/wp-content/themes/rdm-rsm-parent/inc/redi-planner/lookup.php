<?php
/**
 * Import and retrieve R.E.D.i Planner lookup data.
 *
 * @package rdm-rsm-parent
 */

function redi_planner_read_csv( $path, $kind ) {
	$channels = array( 'Sports - Linear TV', 'Sports - Streaming TV', 'NE CityTV - Linear TV', 'NE Specialty - Linear TV', 'NE - Streaming TV', 'Radio', 'Podcast' );
	$columns = $kind === 'reach'
		? array_merge( array( 'Market' ), $channels, array( 'TV Universe', 'Radio Universe', 'Podcast Universe' ) )
		: array_merge( array( 'Market' ), $channels );
	$file = fopen( $path, 'r' );
	if ( ! $file ) {
		throw new RuntimeException( 'Could not open the uploaded CSV.' );
	}

	try {
		$header = fgetcsv( $file, 0, ',', '"', '' );
		if ( ! is_array( $header ) ) {
			throw new RuntimeException( 'The CSV is empty.' );
		}
		$header[0] = preg_replace( '/^\xEF\xBB\xBF/', '', $header[0] );
		$header = array_map( 'trim', $header );
		$positions = array();
		foreach ( $columns as $column ) {
			$matches = array_keys( $header, $column, true );
			if ( count( $matches ) !== 1 ) {
				throw new RuntimeException( 'Missing or duplicate CSV column: ' . $column );
			}
			$positions[ $column ] = $matches[0];
		}

		$rows = array();
		$line = 1;
		while ( ( $row = fgetcsv( $file, 0, ',', '"', '' ) ) !== false ) {
			$line++;
			$market = trim( $row[ $positions['Market'] ] ?? '' );
			if ( $market === '' ) {
				if ( count( array_filter( $row, static function ( $value ) { return trim( $value ) !== ''; } ) ) > 0 ) {
					throw new RuntimeException( 'Missing market on CSV row ' . $line . '.' );
				}
				continue;
			}
			if ( $kind === 'cpm' && $market === 'Halfiax' ) {
				$market = 'Halifax';
			}
			if ( isset( $rows[ $market ] ) ) {
				throw new RuntimeException( 'Duplicate market in CSV: ' . $market );
			}
			$values = array();
			foreach ( array_slice( $columns, 1 ) as $column ) {
				$value = trim( $row[ $positions[ $column ] ] ?? '' );
				if ( $value === '' ) {
					$values[ $column ] = null;
					continue;
				}
				if ( $kind === 'cpm' && preg_match( '/^\$\s*-\s*$/', $value ) ) {
					$values[ $column ] = 0.0;
					continue;
				}
				$is_percentage = substr( $value, -1 ) === '%';
				$value = str_replace( array( '$', ',', '%' ), '', $value );
				if ( ! is_numeric( $value ) || ! is_finite( (float) $value ) || (float) $value < 0 || ( $is_percentage && ( $kind !== 'reach' || ! in_array( $column, $channels, true ) ) ) ) {
					throw new RuntimeException( 'Invalid value in ' . $column . ' on CSV row ' . $line . '.' );
				}
				$value = (float) $value / ( $is_percentage ? 100 : 1 );
				if ( $kind === 'reach' && in_array( $column, $channels, true ) && $value > 1 ) {
					throw new RuntimeException( 'Reach must be between 0 and 1 in ' . $column . ' on CSV row ' . $line . '.' );
				}
				$values[ $column ] = $value;
			}
			$rows[ $market ] = $values;
		}
		if ( ! $rows ) {
			throw new RuntimeException( 'The CSV contains no markets.' );
		}
		return $rows;
	} finally {
		fclose( $file );
	}
}

function redi_planner_import_csvs( $reach_path, $cpm_path ) {
	global $wpdb;

	$reach = redi_planner_read_csv( $reach_path, 'reach' );
	$cpm = redi_planner_read_csv( $cpm_path, 'cpm' );
	$missing = array_merge( array_diff( array_keys( $reach ), array_keys( $cpm ) ), array_diff( array_keys( $cpm ), array_keys( $reach ) ) );
	if ( $missing ) {
		throw new RuntimeException( 'Markets do not match between the CSV files: ' . implode( ', ', $missing ) );
	}
	$missing = array_diff( redi_planner_get_config()['markets'], array_keys( $reach ) );
 	if ( $missing ) {
 		throw new RuntimeException( 'Missing configured markets in CSV files: ' . implode( ', ', $missing ) );
 	}

	$table = $wpdb->prefix . 'redi_planner_lookup';
	$charset = $wpdb->get_charset_collate();
	if ( $wpdb->query( "CREATE TABLE IF NOT EXISTS `$table` (market varchar(191) NOT NULL, reach longtext NOT NULL, cpm longtext NOT NULL, PRIMARY KEY (market)) ENGINE=InnoDB $charset" ) === false ) {
		throw new RuntimeException( 'Could not create lookup table: ' . $wpdb->last_error );
	}
	$engine = $wpdb->get_var( $wpdb->prepare( 'SELECT ENGINE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = %s', $table ) );
	if ( strcasecmp( (string) $engine, 'InnoDB' ) !== 0 ) {
		throw new RuntimeException( 'The lookup table must use InnoDB for safe imports.' );
	}
	if ( $wpdb->query( 'START TRANSACTION' ) === false ) {
		throw new RuntimeException( 'Could not start lookup import: ' . $wpdb->last_error );
	}
	try {
		if ( $wpdb->query( "DELETE FROM `$table`" ) === false ) {
			throw new RuntimeException( 'Could not clear previous lookup data: ' . $wpdb->last_error );
		}
		foreach ( $reach as $market => $values ) {
			$reach_json = wp_json_encode( $values );
			$cpm_json = wp_json_encode( $cpm[ $market ] );
			if ( $reach_json === false || $cpm_json === false || $wpdb->insert( $table, array( 'market' => $market, 'reach' => $reach_json, 'cpm' => $cpm_json ), array( '%s', '%s', '%s' ) ) === false ) {
				throw new RuntimeException( 'Could not save lookup data for ' . $market . ': ' . $wpdb->last_error );
			}
		}
		if ( $wpdb->query( 'COMMIT' ) === false ) {
			throw new RuntimeException( 'Could not commit lookup data: ' . $wpdb->last_error );
		}
	} catch ( RuntimeException $error ) {
		$wpdb->query( 'ROLLBACK' );
		throw $error;
	}
	if ( ! update_option( 'redi_planner_lookup_ready', true ) && ! get_option( 'redi_planner_lookup_ready' ) ) {
		throw new RuntimeException( 'Lookup data was saved, but estimates could not be enabled.' );
	}
	return count( $reach );
}

function redi_planner_get_lookup( $market ) {
	global $wpdb;
	$table = $wpdb->prefix . 'redi_planner_lookup';
	$row = $wpdb->get_row( $wpdb->prepare( "SELECT reach, cpm FROM `$table` WHERE market = %s", $market ), ARRAY_A );
	if ( ! $row ) {
		throw new RuntimeException( 'Lookup data not found for market ' . $market . '. ' . $wpdb->last_error );
	}
	$reach = json_decode( $row['reach'], true );
	$cpm = json_decode( $row['cpm'], true );
	if ( ! is_array( $reach ) || ! is_array( $cpm ) ) {
		throw new RuntimeException( 'Invalid stored lookup data for market ' . $market . '.' );
	}
	return array( 'reach' => $reach, 'cpm' => $cpm );
}
