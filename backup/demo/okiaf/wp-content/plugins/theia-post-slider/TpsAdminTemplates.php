<?php

/*
 * Copyright 2012-2015, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

class TpsAdminTemplates {
	public static function getVerticalPositionHtml( $currentOptions, $postPage = false ) {
		$prefix   = $postPage ? 'tps_options' : 'tps_nav';
		$onchange = $postPage ? '' : 'updateSlider()';
		?>
		<tr valign="top">
			<th scope="row">
				<label for="tps_nav_vertical_position"><?php _e( "Vertical position:", 'theia-post-slider' ); ?></label>
			</th>
			<td>
				<select id="tps_nav_vertical_position"
				        name="<?php echo $prefix; ?>[nav_vertical_position]"
				        onchange="<?php echo $onchange; ?>">
					<?php
					$options = array();
					if ( $postPage ) {
						$options['global'] = 'Use global setting';
					}
					$options = array_merge( $options, TpsOptions::get_button_vertical_positions() );
					foreach ( $options as $key => $value ) {
						$output = '<option value="' . $key . '"' . ( $key == $currentOptions['nav_vertical_position'] ? ' selected' : '' ) . '>' . $value . '</option>' . "\n";
						echo $output;
					}
					?>
				</select>
			</td>
		</tr>
		<?php
	}

	public static function getHideNavigationBarOnFirstSlideHtml( $currentOptions, $postPage = false ) {
		$prefix = $postPage ? 'tps_options' : 'tps_nav';
		?>
		<tr valign="top">
			<th scope="row">
				<label for="tps_nav_hide_on_first_slide"><?php _e( "Hide on first slide:", 'theia-post-slider' ); ?></label>
			</th>
			<td>
				<select id="tps_nav_hide_on_first_slide"
				        name="<?php echo $prefix; ?>[nav_hide_on_first_slide]">
					<?php
					$options = TpsOptions::get_generic_boolean();
					foreach ( $options as $key => $value ) {
						$output = '<option value="' . $key . '"' . ( $key == $currentOptions['nav_hide_on_first_slide'] ? ' selected' : '' ) . '>' . $value . '</option>' . "\n";
						echo $output;
					}
					?>
				</select>
			</td>
		</tr>
		<?php
	}
}