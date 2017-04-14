<!DOCTYPE html><!-- HTML 5 -->
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php // Get Theme Options from Database
	$theme_options = glades_theme_options();
?>

	<div id="wrapper" class="hfeed">

		<div id="topheader-wrap">
			<?php locate_template('/inc/top-header.php', true); ?>
		</div>

		<div id="header-wrap">

			<header id="header" class="container clearfix" role="banner">

				<div id="logo" class="clearfix">

				<?php glades_site_logo(); ?>
				<?php glades_site_title(); ?>

				<?php // Display Tagline on header if activated
				if ( isset($theme_options['header_tagline']) and $theme_options['header_tagline'] == true ) : ?>
					<h2 class="site-description"><?php echo bloginfo('description'); ?></h2>
				<?php endif; ?>

				</div>

				<nav id="mainnav" class="clearfix" role="navigation">
					<?php // Display Main Navigation
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => false,
							'menu_id' => 'mainnav-menu',
							'menu_class' => 'main-navigation-menu',
							'echo' => true,
							'fallback_cb' => 'glades_default_menu')
						);
					?>
				</nav>

			</header>

		</div>

		<?php // Display Custom Header Image
			glades_display_custom_header(); ?>