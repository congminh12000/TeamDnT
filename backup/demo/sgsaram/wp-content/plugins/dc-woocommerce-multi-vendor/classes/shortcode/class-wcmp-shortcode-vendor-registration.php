<?php

/**
 * WCMp Vendor Registration Shortcode Class
 *
 * @version		2.4.3
 * @package		WCMp/shortcode
 * @author 		DualCube
 */
class WCMp_Vendor_Registration_Shortcode {

    public function __construct() {
        
    }

    /**
     * Output the vendor Registration shortcode.
     *
     * @access public
     * @param array $atts
     * @return void
     */
    public static function output($attr) {
        global $WCMp;
        $frontend_style_path = $WCMp->plugin_url . 'assets/frontend/css/';
        $frontend_style_path = str_replace(array('http:', 'https:'), '', $frontend_style_path);
        $suffix = defined('WCMP_SCRIPT_DEBUG') && WCMP_SCRIPT_DEBUG ? '' : '.min';
        wp_enqueue_style('wcmp_vandor_registration_css', $frontend_style_path . 'vendor-registration' . $suffix . '.css', array(), $WCMp->version);
        wp_enqueue_script('google-recaptcha','https://www.google.com/recaptcha/api.js');
        $WCMp->template->get_template('shortcode/vendor_registration.php');
    }

}
