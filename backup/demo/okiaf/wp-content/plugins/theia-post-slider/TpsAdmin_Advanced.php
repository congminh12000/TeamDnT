<?php

/*
 * Copyright 2012-2015, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

class TpsAdmin_Advanced {
	public $showPreview = false;

	public function echoPage() {
		?>
		<form method="post" action="options.php">
			<?php settings_fields( 'tps_options_advanced' ); ?>
			<?php $options = get_option( 'tps_advanced' ); ?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="default_activation_behavior"><?php _e( "Default activation behavior:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<select id="default_activation_behavior" name="tps_advanced[default_activation_behavior]">
							<option value="1" <?php echo $options['default_activation_behavior'] == 1 ? 'selected' : ''; ?>>
								Enable by default on all posts
							</option>
							<option value="0" <?php echo $options['default_activation_behavior'] == 0 ? 'selected' : ''; ?>>
								Disable by default on all posts
							</option>
						</select>

						<p class="description">
							You can also enable or disable the slider on a post-by-post basis.
						</p>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="post_types"><?php _e( "Post types:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<?php
						$postTypes = get_post_types( array(), 'objects' );
						?>
						<select id="post_types" name="tps_advanced_post_types[]" size="10" multiple>
							<?php
							foreach ( $postTypes as $key => $type ) {
								?>
								<option value="<?php echo $key; ?>" <?php echo in_array( $key, $options['post_types'] ) ? 'selected' : ''; ?>>
									<?php echo $type->labels->name; ?>
								</option>
								<?php
							}
							?>
						</select>

						<p class="description">
							By default, the slider is enabled only for <b>posts</b>. Use Ctrl+Click or CommandKey+Click
							to select multiple types.
						</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="touch_gestures"><?php _e( "Touch gestures:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type='hidden' value='false' name='tps_advanced[enable_touch_gestures]'>
							<input type="checkbox"
							       id="touch_gestures"
							       name="tps_advanced[enable_touch_gestures]"
							       value="true" <?php echo $options['enable_touch_gestures'] ? 'checked' : ''; ?>>
							Enable touch gestures for sliding left/right to the previous/next slide.
							<p></p>
						</label>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="override_subtitles"><?php _e( "Subpage titles:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type='hidden' value='false' name='tps_advanced[override_subtitles]'>
							<input type="checkbox"
							       id="override_subtitles"
							       name="tps_advanced[override_subtitles]"
							       value="true" <?php echo $options['override_subtitles'] ? 'checked' : ''; ?>>
							Override subpage titles.
							<p></p>
						</label>

						<p class="description">
							Recommended. Prevent duplicate title tags. Set a title for each subpage using <strong>[tps_title]Your Title[/tps_title]</strong>.
						</p>
					</td>
				</tr>
			</table>

			<h3><?php _e( "Slide Loading Mechanism", 'theia-post-slider' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label><?php _e( "Slide loading mechanism:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type="radio"
							       name="tps_advanced[slide_loading_mechanism]"
							       value="ajax" <?php echo $options['slide_loading_mechanism'] == 'ajax' ? 'checked' : ''; ?>>
							Load slides efficiently using AJAX.
							<p class="description">
								Recommended. Most efficient option and offers best user experience. Uses preloading and
								caching methods.
							</p>
						</label>
						<br>
						<label>
							<input type="radio"
							       name="tps_advanced[slide_loading_mechanism]"
							       value="all" <?php echo $options['slide_loading_mechanism'] == 'all' ? 'checked' : ''; ?>>
							Load all slides at once.
							<p class="description">
								Legacy mode. Use this option if you have compatibility issues.
							</p>
						</label>

						<p></p>
					</td>
				</tr>
			</table>
			<br>

			<h3><?php _e( "Ad behavior", 'theia-post-slider' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label for="tps_refresh_ads"><?php _e( "Ad refreshing:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type="checkbox"
							       id="tps_refresh_ads"
							       name="tps_advanced[refresh_ads]"
							       onchange="updateAdRefreshing()"
							       value="true" <?php echo $options['refresh_ads'] ? 'checked' : ''; ?>>
							Refresh ads when navigating to another slide.
							<p></p>
						</label>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="tps_refresh_ads_every_n_slides"><?php _e( "Refresh ads every N slides:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<input type="number"
						       class="small-text"
						       id="tps_refresh_ads_every_n_slides"
						       name="tps_advanced[refresh_ads_every_n_slides]"
						       value="<?php echo htmlentities( $options['refresh_ads_every_n_slides'] ); ?>">

						<p class="description">
							Use "1" to refresh ads on every slide.
						</p>

						<p></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( "Ad refreshing mechanism:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type="radio"
							       id="tps_ad_refreshing_mechanism_javascript"
							       name="tps_advanced[ad_refreshing_mechanism]"
							       value="javascript" <?php echo $options['ad_refreshing_mechanism'] == 'javascript' ? 'checked' : ''; ?>>
							Refresh ads using JavaScript.
							<p class="description">
								Works with Google DoubleClick and partners. Requires that you use
								<strong>
									<a href="https://support.google.com/dfp_premium/answer/177207">
										GPT (Google Publishing Tags)
									</a>
								</strong>
								and
								<strong>
									<a href="https://support.google.com/dfp_premium/answer/183282">
										asynchronous rendering
									</a>
								</strong>.
								DART tags are not supported. Google AdSense is not supported because their Terms of
								Service forbid this kind of behavior.
							</p>
						</label>
						<br>
						<label>
							<input type="radio"
							       id="tps_ad_refreshing_mechanism_page"
							       name="tps_advanced[ad_refreshing_mechanism]"
							       value="page" <?php echo $options['ad_refreshing_mechanism'] == 'page' ? 'checked' : ''; ?>>
							Refresh ads by refreshing the entire page.
							<p class="description">
								Works with any other ads, including Google AdSense. Transition effects will not be used
								when refreshing the page.
							</p>
						</label>

						<p></p>
					</td>
				</tr>
			</table>

			<h3><?php _e( "Troubleshooting", 'theia-post-slider' ); ?></h3>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">
						<label><?php _e( "Compatibility options:", 'theia-post-slider' ); ?></label>
					</th>
					<td>
						<label>
							<input type='hidden' value='false' name='tps_advanced[remove_canonical_rel]'>
							<input type="checkbox"
							       name="tps_advanced[remove_canonical_rel]"
							       value="true" <?php echo $options['remove_canonical_rel'] ? 'checked' : ''; ?>>
							Disable canonical URLs on slides.
							<p class="description">
								Canonical URLs are added by WordPress on each subsequent page, which could prevent
								your slides to be indexed by Google.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[do_not_check_for_multiple_instances]'>
							<input type="checkbox"
							       name="tps_advanced[do_not_check_for_multiple_instances]"
							       value="true" <?php echo $options['do_not_check_for_multiple_instances'] ? 'checked' : ''; ?>>
							Do not check for multiple instances of the same post.
							<p class="description">
								Try this if the entire page refreshes on each slide when it shouldn't.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[do_not_cache_rendered_html]'>
							<input type="checkbox"
							       name="tps_advanced[do_not_cache_rendered_html]"
							       value="true" <?php echo $options['do_not_cache_rendered_html'] ? 'checked' : ''; ?>>
							Do not cache rendered HTML.
							<p class="description">
								Enable this if you use Twitter embeds, or any other plugin that generates iframes.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[try_to_fix_broken_html]'>
							<input type="checkbox"
							       id="try_to_fix_broken_html"
							       name="tps_advanced[try_to_fix_broken_html]"
							       value="true" <?php echo $options['try_to_fix_broken_html'] ? 'checked' : ''; ?>>
							Try to fix broken HTML.
							<p class="description">
								 This will use either <a href="http://php.net/manual/en/book.tidy.php">PHP Tidy</a> (if installed) or <a href="http://htmlpurifier.org/">HTMLPurifier</a> to fix posts with broken HTML. Note that this can cause your pages to load slower or have compatibility issues with other plugins. Therefore, we recommend disabling this option and manually validating your posts' code.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[document_ready_js]'>
							<input type="checkbox"
							       name="tps_advanced[document_ready_js]"
							       value="true" <?php echo $options['document_ready_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(document).ready()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[window_load_js]'>
							<input type="checkbox"
							       name="tps_advanced[window_load_js]"
							       value="true" <?php echo $options['window_load_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(window).load()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[domcontentloaded_js]'>
							<input type="checkbox"
							       name="tps_advanced[domcontentloaded_js]"
							       value="true" <?php echo $options['domcontentloaded_js'] ? 'checked' : ''; ?>>
							Trigger <strong>DOMContentLoaded</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[document_resize_js]'>
							<input type="checkbox"
							       name="tps_advanced[document_resize_js]"
							       value="true" <?php echo $options['document_resize_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(document).resize()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[document_scroll_js]'>
							<input type="checkbox"
							       name="tps_advanced[document_scroll_js]"
							       value="true" <?php echo $options['document_scroll_js'] ? 'checked' : ''; ?>>
							Trigger <strong>jQuery(document).scroll()</strong> upon navigating to another slide.
							<p class="description">
								Try this when only the first slide is displayed correctly.
							</p>
						</label>
						<br>
						<label>
							<input type='hidden' value='false' name='tps_advanced[add_header_to_excerpt]'>
							<input type="checkbox"
							       name="tps_advanced[add_header_to_excerpt]"
							       value="true" <?php echo $options['add_header_to_excerpt'] ? 'checked' : ''; ?>>
							Include text from [tps_header] and [tps_footer] in excerpts.
							<p class="description">
								 You might want to do this depending on the theme you are using.
							</p>
						</label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit"
				       class="button-primary"
				       value="<?php _e( 'Save All Changes', 'theia-post-slider' ) ?>" />
			</p>
		</form>
		<script type="text/javascript">
			function updateAdRefreshing() {
				var $ = jQuery,
					enabled = $('#tps_refresh_ads').attr('checked') == 'checked';
				$('#tps_refresh_ads_every_n_slides').attr('readonly', !enabled);
				$('#tps_ad_refreshing_mechanism_javascript').attr('disabled', !enabled);
				$('#tps_ad_refreshing_mechanism_page').attr('disabled', !enabled);
			}

			updateAdRefreshing();
		</script>
		<?php
	}
}
