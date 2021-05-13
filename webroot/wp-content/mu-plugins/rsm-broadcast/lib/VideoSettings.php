<?php


namespace RSM\Broadcast;


class VideoSettings {
	const SLUG = "rsm_video_settings";
	const SETTINGS_GROUP = "rsm-video-settings-group";

	public function add_admin_menu() {
		add_menu_page( 'Video Settings',
			'Video Settings',
			'administrator',
			self::SLUG,
			array( $this, "settings_page" ),
			'dashicons-admin-tools'
		);
	}

	public function register_settings() {
		//register our settings
		register_setting( self::SETTINGS_GROUP, 'brightcove_account_id' );
		register_setting( self::SETTINGS_GROUP, 'brightcove_player_id' );
	}

	public function settings_page() {
		?>
        <div class="wrap">
            <h1>Video Settings</h1>

            <form method="post" action="options.php">
				<?php settings_fields( self::SETTINGS_GROUP ); ?>
				<?php do_settings_sections( self::SETTINGS_GROUP ); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">Brightcove Account ID</th>
                        <td>
                            <label>
                                <input type="text" name="brightcove_account_id"
                                       value="<?php echo esc_attr( get_option( 'brightcove_account_id' ) ); ?>"/>
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Brightcove Player ID</th>
                        <td>
                            <label>
                                <input type="text" name="brightcove_player_id"
                                       value="<?php echo esc_attr( get_option( 'brightcove_player_id' ) ); ?>"/>
                            </label>
                        </td>
                    </tr>

                </table>

				<?php submit_button(); ?>

            </form>
        </div>
	<?php }
}