<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'teamdnt_sgsaram');

/** MySQL database username */
define('DB_USER', 'teamdnt_sgsaram');

/** MySQL database password */
define('DB_PASSWORD', 'IYsRj5GBX');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'K{pal$$];GnBVNovFfSTqR449<ax}zg*T>97UpGZTU>Q<V7W rd]4Kh83u$}_ux_');
define('SECURE_AUTH_KEY',  'm?;yH@kuyo0$&[K)Z:9uS)|Q|;@GNGl@,1U[Fi$8dfx*WX;7`GBN:!&Co#a9VO<P');
define('LOGGED_IN_KEY',    'z7)/!/UP@)*jqfnp+!gsT3Vk%G:^|y_:{{o#rU%2]WOg+un;9rQ3w&GvtO_i/Q*2');
define('NONCE_KEY',        'IAD/mCz6$^``}tlZhHfI,GdQY!TVakuApRR1zE&Rhvx9H$?jNOJXp/T4/7!_irJX');
define('AUTH_SALT',        ' /UG}6 V]YDsuk:*@AW}7~E]U-[1#SY7tYa9Xm[Z1n/4uIudX%W^5^iL ]hv 1Jz');
define('SECURE_AUTH_SALT', 'j.6w25k;w]<DluuG:F!1DV.jOVY06x6e+U$~5Y;pUC$SG`RBgk!S#Pd~+o3?Of8%');
define('LOGGED_IN_SALT',   'Bg:r?=iJ/>^BWKQM|GRk6 W?10^(11huu_h,oSiiKH;@`9!xn?Y?!YyHMlaxXybs');
define('NONCE_SALT',       'Mrw*Y9%2>S*-Lzxu|Ewp?GS:Hf D^CCmt@Mqwv#Y])[VV-9`)z|Tmwd:og*_#-;2');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
