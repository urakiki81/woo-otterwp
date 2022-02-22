<?php
/**
 * Toggle Customizer Control
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( class_exists( 'WP_Customize_Control' ) ) {
// Exit if WP_Customize_Control does not exsist.





class Otterwp_Toggle_Switch_Custom_control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'toggle_switch';
	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue(){
		wp_enqueue_style( 'otterwp-custom-controls-css', plugin_dir_url( __DIR__ ) . 'admin/assets/custom-control.css', array(), '1.0', 'all' );
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content(){
	?>
		<div class="toggle-switch-control">
			<div class="toggle-switch">
				<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
				<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
					<span class="toggle-switch-inner"></span>
					<span class="toggle-switch-switch"></span>
				</label>
			</div>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if( !empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
			<?php } ?>
		</div>
	<?php
	}
}
class Otterwp_Slider_Custom_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered
	 */
	public $type = 'slider_control';
	/**
	 * Enqueue our scripts and styles
	 */
	public function enqueue() {
		wp_enqueue_script( 'otterwp-custom-controls-js', plugin_dir_url( __DIR__ ) . 'admin/assets/custom-control.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
		wp_enqueue_style( 'otterwp-custom-controls-css', plugin_dir_url( __DIR__ ) . 'admin/assets/custom-control.css', array( ), '1.0', 'all' );
	}
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
	?>
		<div class="slider-custom-control">
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
			<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
		</div>
	<?php
	}
}
	/**
	 * Text Radio Button Custom Control

	 */
	class otterwp_Text_Radio_Button_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'text_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_style( 'otterwp-custom-controls-css', plugin_dir_url( __DIR__ ) . 'admin/assets/custom-control.css', array(), '1.0', 'all' );
			wp_enqueue_script( 'otterwp-custom-controls-js', plugin_dir_url( __DIR__ ) . 'admin/assets/custom-control.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="text_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<div class="radio-buttons">
					<?php foreach ( $this->choices as $key => $value ) { ?>
						<label class="radio-button-label">
							<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
							<span><?php echo esc_attr( $value ); ?></span>
						</label>
					<?php	} ?>
				</div>
			</div>
		<?php
		}
	}
	class Otterwp_Customize_Alpha_Color_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'alpha-color';
		/**
		 * Add support for palettes to be passed in.
		 *
		 * Supported palette values are true, false, or an array of RGBa and Hex colors.
		 */
		public $palette;
		/**
		 * Add support for showing the opacity value on the slider handle.
		 */
		public $show_opacity;
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'otterwp-custom-controls-js', plugin_dir_url( __DIR__ ) . 'admin/assets/custom-control.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
			wp_enqueue_style( 'otterwp-custom-controls-css', plugin_dir_url( __DIR__ ) . 'admin/assets/custom-control.css', array( 'wp-color-picker' ), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			// Process the palette
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				// Default to true.
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}

			// Support passing show_opacity as string or boolean. Default to true.
			$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

			?>
				<label>
					<?php // Output the label and description if they were passed in.
					if ( isset( $this->label ) && '' !== $this->label ) {
						echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
					}
					if ( isset( $this->description ) && '' !== $this->description ) {
						echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
					} ?>
				</label>
				<input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
			<?php
		}
	}
	/**
	 * WPColorPicker Alpha Color Picker Custom Control
	 */
	if ( ! function_exists( 'otterwp_hex_rgba_sanitization' ) ) {
	function otterwp_hex_rgba_sanitization( $input, $setting ) {
        if ( empty( $input ) || is_array( $input ) ) {
            return $setting->default;
        }

        if ( false === strpos( $input, 'rgb' ) ) {
            // If string doesn't start with 'rgb' then santize as hex color
            $input = sanitize_hex_color( $input );
        } else {
            if ( false === strpos( $input, 'rgba' ) ) {
                // Sanitize as RGB color
                $input = str_replace( ' ', '', $input );
                sscanf( $input, 'rgb(%d,%d,%d)', $red, $green, $blue );
                $input = 'rgb(' . Otterwp_in_range( $red, 0, 255 ) . ',' . Otterwp_in_range( $green, 0, 255 ) . ',' . Otterwp_in_range( $blue, 0, 255 ) . ')';
            }
            else {
                // Sanitize as RGBa color
                $input = str_replace( ' ', '', $input );
                sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
                $input = 'rgba(' . Otterwp_in_range( $red, 0, 255 ) . ',' . Otterwp_in_range( $green, 0, 255 ) . ',' . Otterwp_in_range( $blue, 0, 255 ) . ',' . Otterwp_in_range( $alpha, 0, 1 ) . ')';
            }
        }
        return $input;
    }
}
	if ( ! function_exists( 'Otterwp_in_range' ) ) {
		function Otterwp_in_range( $input, $min, $max ){
			if ( $input < $min ) {
				$input = $min;
			}
			if ( $input > $max ) {
				$input = $max;
			}
			return $input;
		}
	}


	/**
	 * Only allow values between a certain minimum & maxmium range
	 *
	 * @param  number	Input to be sanitized
	 * @return number	Sanitized input
	 */
	function otterwp_range_sanitization( $input, $setting ) {
		$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;
		$min = $input_attrs['min'] ? $input_attrs['min'] : '';
		$max = $input_attrs['max'] ? $input_attrs['max'] : '';
	
		if ( isset( $input ) && is_numeric( $input ) ) {
			if( is_array( $input_attrs ) ) {
				if ( isset( $min ) && is_numeric( $min ) ) {
					if ( $input < $min ) {
						$input = $min;
					}
				}
				if ( isset( $max ) && is_numeric( $max ) ) {
					if ( $input > $max ) {
						$input = $max;
					}
				}
			}
			return $input;
		} else {
			return $setting->default;
		}
	}
	/**
	 * Switch sanitization
	 *
	 * @param  string		Switch value
	 * @return integer	Sanitized value
	 */
	
	if ( ! function_exists( 'otterwp_switch_sanitization' ) ) {
		function otterwp_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}
		/**
	 * Radio Button and Select sanitization
	 *
	 * @param  string		Radio Button value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'otterwp_radio_sanitization' ) ) {
		function otterwp_radio_sanitization( $input, $setting ) {
			//get the list of possible radio box or select options
		 $choices = $setting->manager->get_control( $setting->id )->choices;

			if ( array_key_exists( $input, $choices ) ) {
				return $input;
			} else {
				return $setting->default;
			}
		}
	}
	if ( ! function_exists( 'otterwp_text_sanitization' ) ) {
		function otterwp_text_sanitization( $input ) {
			if ( strpos( $input, ',' ) !== false) {
				$input = explode( ',', $input );
			}
			if( is_array( $input ) ) {
				foreach ( $input as $key => $value ) {
					$input[$key] = sanitize_text_field( $value );
				}
				$input = implode( ',', $input );
			}
			else {
				$input = sanitize_text_field( $input );
			}
			return $input;
		}
	}
}
