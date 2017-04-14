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
define('DB_NAME', 'teamdnt_manplus');

/** MySQL database username */
define('DB_USER', 'teamdnt_manplus');

/** MySQL database password */
define('DB_PASSWORD', 'Teamdnt2');

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
define('AUTH_KEY',         'JpE*l>JbYVN3scQX+//Yoz,%7?q5h]Bjv;(H)xYRC-`H821r Pz#!l-;xhwkrd88');
define('SECURE_AUTH_KEY',  '4#U#,bZ}lWGPDr#wJluR},PYK`w[9kUB=`OToLF=hlY%b#>KZ8#t&ex!Iz@tfLLO');
define('LOGGED_IN_KEY',    '_SXzL1PWe0kp3,yIFyUxZz=`VMIi>&d B-E8<PK`#lQgwHy^M3-D&k>w]Ic;qoTB');
define('NONCE_KEY',        'pvoVsHZUfaDd8~BUU`|(p[>$QDQ:PpJds/uGB?$yGm-yz8r30bMW3-/? =5aqIo4');
define('AUTH_SALT',        'Y$TN}lTuIdA7CUNwt9+3 4HVN)$lQ&M78izF2MBEyaPNciiHGPth@vYX;dva{OJ#');
define('SECURE_AUTH_SALT', 'ks|U#x.;QYLL]*n+N3C|KiNhE6MS@k (#OS:#CCHJ,uq-&2^MnuqiIU/oqHaR|D&');
define('LOGGED_IN_SALT',   '}Ic?wxJB0 &u)RI8t&XVLF,e|emENfDsyvaI=iRE*`z.(z$F%?:T_VA[ur82P%!8');
define('NONCE_SALT',       'Xp>3$Q!Sr9*94|rRGy u?r^%A XVAN-aA*>&wCNyW0*q4UNg*GJfyRKAd8`GZL8r');

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
