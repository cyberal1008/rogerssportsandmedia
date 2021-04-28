<?php


namespace RSM\TV;


class Util {
	public static function get_meta_value( $post_meta, $section_id, $field_id ) {
		return isset( $post_meta[ $section_id ][ $field_id ] ) ? $post_meta[ $section_id ][ $field_id ] : null;
	}

	public static function is_assoc( array $arr ) {
		if ( array() === $arr ) {
			return false;
		}

		return array_keys( $arr ) !== range( 0, count( $arr ) - 1 );
	}

	public static function datetimepicker( $bool, $bool1 ) {

		if ( $bool && $bool1 ) {
			return " datetimepicker-field";
		} else if ( $bool ) {
			return " datepicker-field";
		} else if ( $bool1 ) {
			return " timepicker-field";
		} else {
			return "";
		}
	}

	public static function render_image_box( $post, $callback_args ) {
		global $content_width, $_wp_additional_image_sizes;
		$schema  = $callback_args['args'];
		$section = "image";
		$field   = "tile";

		$post_meta         = get_post_meta( $post->ID, $schema['slug'], true );
		$old_content_width = $content_width;
		$content_width     = 254;

		$id       = sprintf( '%s_%s_%s', $schema['slug'], $section, $field );
		$name     = sprintf( '%s[%s][%s]', $schema['slug'], $section, $field );
		$image_id = self::get_meta_value( $post_meta, $section, $field );

		if ( $image_id && get_post( $image_id ) ) {
			if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
				$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
			} else {
				$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
			}
			if ( ! empty( $thumbnail_html ) ) {
				$content = $thumbnail_html;
				$content .= '<p class="hide-if-no-js">
                                <a href="javascript:;" data-action="remove" class="rsm_action_button" >' . esc_html__( 'Remove tile image', RSM_TV_LOCALE ) . '</a>
                                <input type="hidden" id="'.$id.'" class="rsm_show_img_hidden" name="' . $name . '" value="' . esc_attr( $image_id ) . '" />
                             </p>';
			}
			$content_width = $old_content_width;
		} else {
			$content = '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
			$content .= '<p class="hide-if-no-js">
                            <a href="javascript:;" class="rsm_action_button" data-action="set">' . esc_html__( 'Set tile image', RSM_TV_LOCALE ) . '</a>
                            <input type="hidden" id="'.$id.'" class="rsm_show_img_hidden" name="' . $name . '" value="" />
                         </p>';
		}
		echo $content;
	}


	public static function render_meta_box( $post, $callback_args ) {
		$schema = $callback_args['args'];
		?>
        <div class="wrap xml_metadata">
			<?php $post_meta = get_post_meta( $post->ID, $schema['slug'], true ); ?>
			<?php foreach ( $schema['fields'] as $section ) : ?>
                <h3 class="title"><?php echo esc_html( $section['title'] ) ?></h3>
                <table class="form-table">
                    <tbody>
					<?php foreach ( $section['fields'] as $field ) :
						if ( "hidden" === $field['type'] ) {
							continue;
						}

						$id    = sprintf( '%s_%s_%s', $schema['slug'], $section['id'], $field['id'] );
						$name  = sprintf( '%s[%s][%s]', $schema['slug'], $section['id'], $field['id'] );
						$value = self::get_meta_value( $post_meta, $section['id'], $field['id'] );
						if ( ! isset( $value ) && isset( $field['default'] ) ) {
							$value = $field['default'];
						}

						$datepicker = isset( $field['datepicker'] ) ? $field['datepicker'] : false;
						$timepicker = isset( $field['timepicker'] ) ? $field['timepicker'] : false;

						?>
                        <tr valign="top">
							<?php printf(
								'<th scope="row"><label for="%s">%s</label></th>',
								esc_attr( $id ),
								esc_html( $field['label'] )
							) ?>
                            <td>
								<?php if ( 'checkbox' === $field['type'] ) :
									if ( is_null( $value ) ) {
										$value = array();
									}
									?>
                                    <fieldset id="<?php echo esc_attr( $id ) ?>">
										<?php foreach ( $field['choices'] as $check_value => $check_label ) : ?>
											<?php printf(
												'<label><input type="checkbox" id="%s" name="%s[]" value="%s"%s /> %s</label><br />',
												esc_attr( $id ),
												esc_attr( $name ),
												esc_attr( $check_value ),
												checked( in_array( $check_value, $value ), true, false ),
												esc_html( $check_label )
											) ?>
										<?php endforeach; ?>
                                    </fieldset>
								<?php elseif ( 'textarea' === $field['type'] ) : ?>
									<?php
									printf( '<textarea id="%s" name="%s" maxlength="%s">%s</textarea>',
										esc_attr( $id ),
										esc_attr( $name ),
										esc_attr( $field['maxlength'] ),
										esc_attr( $value )
									);
									?>
								<?php elseif ( 'upload_image' === $field['type'] ) : ?>
									<?php printf(
										'<p><input type="url" id="%s" name="%s" value="%s" class="image_url" /><button type="button" class="rsm_upload_button" value="Upload Image">Upload Image</button></p>',
										esc_attr( $id ),
										esc_attr( $name ),
										esc_attr( $value )
									) ?>
								<?php elseif ( 'dropdown' === $field['type'] ) : ?>
									<?php
									if ( is_null( $value ) ) {
										$value = array();
									} else if ( is_scalar( $value ) ) {
										$value = array( $value );
									}
									?>
                                    <fieldset>
										<?php
										if ( isset( $field['is_multiple'] ) && true === $field['is_multiple'] ) {
											printf( '<select name="%s" id="%s" size="20" multiple>', esc_attr( $name ) . '[]', esc_attr( $id ) );
										} else {
											printf( '<select name="%s" id="%s">', esc_attr( $name ), esc_attr( $id ) );
										}
										?>
										<?php
										foreach ( $field['choices'] as $option_value => $option_label ) {
											printf( '<option value="%s"%s>%s</option>',
												esc_attr( $option_value ),
												selected( in_array( $option_value, $value ), true, false ),
												esc_html( $option_label )
											);
										}
										?>
										<?php printf( '</select>' ); ?>
                                    </fieldset>

								<?php elseif ( 'select_post' === $field['type'] ) : ?>
									<?php printf(
										'<p id="select-video-wrap"><span class="video-title">%s</span> <a href="#" class="select-video">%s</a>%s</p>',
										! empty( $value ) ? esc_html( get_the_title( $value ) ) : '',
										esc_html__( 'Select', RDM_LOCALE ),
										sprintf(
											'<input type="hidden" id="%s" name="%s" value="%s" />',
											esc_attr( $id ),
											esc_attr( $name ),
											esc_attr( $value )
										)
									) ?>

								<?php elseif ( 'hybrid' === $field['type'] ) : ?>
                                    <fieldset class="hybrid_fieldset">
										<?php
										$hybrid = array(
											"name"  => "Other:",
											"value" => "rdmHybridValue",
										);

										$other_value        = false;
										$other_id           = "";
										$other_name         = "";
										$remove_field_class = "";

										if ( isset( $field['choices'] ) && ( empty ( $value ) || ! isset( $field['choices'][ $value ] ) ) ) {

											$other_value        = $value;
											$other_id           = "[hybrid_id]";
											$other_name         = "[hybrid_name]";
											$remove_field_class = " remove-field";

											$value = $hybrid['value'];
										}

										printf( '<select class="hybrid-field%s" name="%s%s" id="%s%s">', esc_attr( $remove_field_class ), esc_attr( $name ), esc_attr( $other_name ), esc_attr( $id ), esc_attr( $other_id ) );
										foreach ( $field['choices'] as $option_value => $option_label ) {
											printf( '<option value="%s"%s>%s</option>',
												esc_attr( $option_value ),
												selected( $option_value, $value, false ),
												esc_html( $option_label )
											);
										}
										printf( '<option value="%s"%s>%s</option>',
											esc_attr( $hybrid['value'] ),
											selected( $hybrid['value'], $value, false ),
											esc_html( $hybrid['name'] )
										);
										printf( '</select>' );
										if ( $other_value !== false ) {
											printf(
												'<input type="text" id="%s" name="%s" value="%s"/>',
												esc_attr( $id ),
												esc_attr( $name ),
												esc_attr( $other_value )
											);
										}

										?>
                                    </fieldset>
								<?php elseif ( 'multiple_set' === $field['type'] ) : ?>
                                    <div class='multiple-set-parent'>
                                        <div class="multiple-set">
											<?php
											//form the div template to be used for multiple values
											$div_to_use = "<div class='m-fieldset-template'
											data-index='index-placeholder'
											id='{$id}'>";
											foreach ( $field['fields'] as $field_data ) :
												$field_name = $field_data['label'];
												$field_slug = $field_data['id'];
												$field_type = $field_data['type'];

												if ( ! empty( $field_name ) ) {
													$div_to_use .= "<label>{$field_name}</label>&nbsp;&nbsp;&nbsp;";
												}

												if ( 'dropdown' === $field_type ) {
													$div_to_use .= "<select name='{$name}[index-placeholder][{$field_slug}]'>";
													foreach ( $field_data['choices'] as $option_value => $option_label ) {
														$div_to_use .= sprintf( '<option value="%s">%s</option>',
															esc_attr( $option_value ),
															esc_html( $option_label )
														);
													}
													$div_to_use .= "</select>";
												} else {
													$div_to_use .= "<input type='{$field_type}' name='{$name}[index-placeholder][{$field_slug}]' value='{$field_slug}-value-placeholder'/>";
												}
												$div_to_use .= "<br/><br/>";
											endforeach;
											$div_to_use .= "<button class='button button-secondary rdm-option-remove-button'>Remove</button>";
											$div_to_use .= "</div>";

											$values = $value;
											if ( count( $values ) > 0 ):
												foreach ( $value as $i => $field_values ) :
													//replace the placeholders wih the actual values
													$div_to_use_html = str_replace( 'index-placeholder', $i, $div_to_use );
													foreach ( $field['fields'] as $field_data ) :
														$field_slug  = esc_attr( $field_data['id'] );
														$field_value = ! empty( $values[ $i ][ $field_slug ] ) ? esc_attr( $values[ $i ][ $field_slug ] ) : '';

														if ( 'dropdown' === $field_data['type'] ) {
															$div_to_use_html = preg_replace(
																'/\<option\svalue="' . $field_value . '"\>/',
																'<option value="' . $field_value . '" selected="selected">',
																$div_to_use_html );
														} else {
															$div_to_use_html = str_replace(
																"{$field_slug}-value-placeholder",
																$field_value,
																$div_to_use_html );
														}
													endforeach;
													echo str_replace( 'm-fieldset-template', 'm-fieldset', $div_to_use_html );
												endforeach;
											endif;
											?>
                                        </div>
										<?php
										//print the template for js
										echo $div_to_use;
										?>
                                        <button class="button button-secondary rdm-option-add-button">Add</button>
                                    </div>
								<?php elseif ( "upload" === $field['type'] ) : ?>
									<?php
									printf( '<input type="file" id="%s" name="%s" class="upload-fieldset remove-field" data-fieldid="%s" accept="%s"/><br/><input type="text" id="%s" name="%s" value="%s" class="regular-text" />',
										esc_attr( uniqid() ),
										esc_attr( uniqid() ),
										esc_attr( $id ),
										esc_attr( $field['allowed_filetypes'] ),
										esc_attr( $id ),
										esc_attr( $name ),
										esc_attr( $value )
									) ?>
								<?php else : ?>
									<?php
									printf(
										'<input type="%s" id="%s" name="%s" value="%s" class="regular-text%s"/>',
										esc_attr( $field['type'] ),
										esc_attr( $id ),
										esc_attr( $name ),
										esc_attr( $value ),
										self::datetimepicker( $datepicker, $timepicker )
									) ?>
								<?php endif; ?>

								<?php if ( ! empty( $field['description'] ) ) {
									?>
                                    <p class="description">
										<?php
										if ( is_array( $field['description'] ) ) {
											$descno   = 1;
											$all_desc = array();
											foreach ( $field['description'] as $descval ) {
												$all_desc[] = ( $descno ++ ) . ". " . esc_html( $descval );
											}
											echo implode( "<br/>", $all_desc );
										} else {
											echo esc_html( $field['description'] );
										}
										?>
                                    </p>
									<?php
								}
								?>
                            </td>
                        </tr>
					<?php endforeach; ?>
                    </tbody>
                </table>
			<?php endforeach; ?>
        </div>
		<?php

	}
}