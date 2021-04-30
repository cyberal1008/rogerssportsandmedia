<?php
	/**
	 * Customizer Settigns.
	 */


if ( ! class_exists( 'RSM_Customizer_Settings' ) ) {
	class RSM_Customizer_Settings {


		/**
		 * register.
		 * hooks into "customizer_register"
		 */
		public static function register( $wp_customize ) {

			/** Panels */
			$wp_customize->add_panel(
				'header_settings',
				array(
					'title'       => 'RSM Home Settings',
					'description' => 'RSM Home Settings',
					'priority'    => 30,
				)
			);

			$wp_customize->add_section(
				'rsm_video_links',
				array(
					'title'       => __( 'Header Settings', 'rsm_parent' ),
					'priority'    => 40,
					'capability'  => 'edit_theme_options',
					'description' => __( 'Edit looping Video in the header.', 'rsm_parent' ),
					'panel'       => 'header_settings',
				)
			);

			$wp_customize->add_section(
				'rsm_featured_posts',
				array(
					'title'       => __( 'What\'s Happening section', 'rsm_parent' ),
					'priority'    => 50,
					'capability'  => 'edit_theme_options',
					'description' => __( 'Edit the three featured posts.', 'rsm_parent' ),
					'panel'       => 'header_settings',
				)
			);

			$wp_customize->add_setting(
				'post_ids',
				array(
					'default'    => '1, 2, 3',
					'type'       => 'theme_mod',
					'capability' => 'edit_theme_options',
					'transport'  => 'refresh',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'post_ids',
					array(
						'label'    => __( 'Change Post IDs below.', 'rsm_parent' ),
						'section'  => 'rsm_featured_posts',
						'type'     => 'text',
						'priority' => 5,
					)
				)
			);

			// Video Section
			$extra_links = array(
				[ 'Desktop', 'desktop_vid_link' ],
				// [ 'Mobile', 'mob_vid_link' ],
			);
			foreach ( $extra_links as $link ) {
				// Section title.
				$wp_customize->add_setting(
					$link[1] . '_title',
					array(
						'type'      => 'theme_mod',
						'transport' => 'refresh',
					)
				);
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$link[1] . '_title',
						array(
							'label'    => __( $link[0], 'rsm_parent' ),
							'settings' => $link[1] . '_title',
							'priority' => 15,
							'section'  => 'rsm_video_links',
							'type'     => 'hidden',
						)
					)
				);

				// Link Video Title
				$wp_customize->add_setting(
					$link[1] . '_vid_title',
					array(
						'type'       => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport'  => 'refresh',
					)
				);
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$link[1] . '_vid_title',
						array(
							'label'       => __( $link[0] . ' Video Title', 'rsm_parent' ),
							'settings'    => $link[1] . '_vid_title',
							'priority'    => 15,
							'section'     => 'rsm_video_links',
							'type'        => 'text',
							'input_attrs' => array(
								'type'  => 'text',
								'class' => 'video-title',
							),
						)
					)
				);
				// Video Description
				$wp_customize->add_setting(
					$link[1] . '_vid_desc',
					array(
						'type'       => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport'  => 'refresh',
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$link[1] . '_vid_desc',
						array(
							'label'       => __( $link[0] . ' Video Description', 'rsm_parent' ),
							'settings'    => $link[1] . '_vid_desc',
							'priority'    => 15,
							'section'     => 'rsm_video_links',
							'type'        => 'textarea',
							'input_attrs' => array(
								'type'  => 'text',
								'class' => 'video-desc',

							),
						)
					)
				);

				// Button Text
				$wp_customize->add_setting(
					$link[1] . '_button_text',
					array(
						'type'       => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport'  => 'refresh',
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$link[1] . '_button_text',
						array(
							'label'       => __( $link[0] . ' Button Text', 'rsm_parent' ),
							'settings'    => $link[1] . '_button_text',
							'priority'    => 15,
							'section'     => 'rsm_video_links',
							'input_attrs' => array(
								'type'  => 'text',
								'class' => 'video-button-text',

							),
						)
					)
				);
				// Button URL
				$wp_customize->add_setting(
					$link[1] . '_button_url',
					array(
						'type'       => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport'  => 'refresh',
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$link[1] . '_button_url',
						array(
							'label'       => __( $link[0] . ' Button URL', 'rsm_parent' ),
							'settings'    => $link[1] . '_button_url',
							'priority'    => 15,
							'section'     => 'rsm_video_links',
							'input_attrs' => array(
								'type' => 'text',
							),
						)
					)
				);

				// Link Video URL
				$wp_customize->add_setting(
					$link[1] . '_video_url',
					array(
						'type'       => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport'  => 'refresh',
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$link[1] . '_video_url',
						array(
							'label'       => __( $link[0] . ' Video URL', 'rsm_parent' ),
							'settings'    => $link[1] . '_video_url',
							'priority'    => 15,
							'section'     => 'rsm_video_links',
							'input_attrs' => array(
								'type' => 'text',

							),
						)
					)
				);
				// Link Image URL
				$wp_customize->add_setting(
					$link[1] . '_image_url',
					array(
						'type'       => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport'  => 'refresh',
					)
				);

				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$link[1] . '_image_url',
						array(
							'label'       => __( $link[0] . ' Image URL', 'rsm_parent' ),
							'settings'    => $link[1] . '_image_url',
							'priority'    => 15,
							'section'     => 'rsm_video_links',
							'input_attrs' => array(
								'type' => 'text',

							),
						)
					)
				);
			}
		}
	}

	// Registering the Customizer API.
	add_action( 'customize_register', array( 'RSM_Customizer_Settings', 'register' ) );
}
