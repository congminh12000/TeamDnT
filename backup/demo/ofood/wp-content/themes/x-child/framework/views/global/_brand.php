<?php

// =============================================================================
// VIEWS/GLOBAL/_BRAND.PHP
// -----------------------------------------------------------------------------
// Outputs the brand.
// =============================================================================

$site_name        = get_bloginfo( 'name' );
$site_description = get_bloginfo( 'description' );
$logo             = x_make_protocol_relative( x_get_option( 'x_logo' ) );
$site_logo        = '<img src="' . $logo . '" alt="' . $site_description . '">';

?>

<?php echo '<h1 class="visually-hidden">' . $site_name . '</h1>'; ?>
<div class="x-column x-sm x-1-3"><a style="color:#000;" target="_blank" href="teamdnt.asia">teamdnt</a></div>
<div class="x-column x-sm x-1-3">
<a href="<?php echo home_url( '/' ); ?>" class="<?php x_brand_class(); ?>" title="<?php echo $site_description; ?>">
  <?php echo ( $logo == '' ) ? $site_name : $site_logo; ?>
</a>
</div>
<div style="padding-top:15px;" class="x-column x-sm x-1-3"><a class="dat-ga-button" target="_blank" href="#">ĐẶT GÀ NƯỚNG</a></div>