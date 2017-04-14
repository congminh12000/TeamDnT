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
define('DB_NAME', 'teamdnt_okiaf');

/** MySQL database username */
define('DB_USER', 'teamdnt_okiaf');

/** MySQL database password */
define('DB_PASSWORD', 'Ni2YOqzvVe');

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
define('AUTH_KEY',         ']>|NPePhr2r@C}@@pu2ITUX9wQ(%u1y>}iag05O(4%yck2%)3-ZP%y)]RdJt,;Dq');
define('SECURE_AUTH_KEY',  'jM=fh<Ng9De9kh`{yjoAz<$n>>9; c!Bh6~L}x67?8p,vYh~hjPPLd{U^mEThTTM');
define('LOGGED_IN_KEY',    'V<14&IKzKr>#2j4}&8u7eFb2>_Yc&_PoLVjeUoKJKhp}Od5F+s|@0{qG>$Su6Jty');
define('NONCE_KEY',        '+ G@&XDT_JR e594u7z.6br+Y;UnwRx&ZABAu Y8(&}SEj[)>i>Btt=~u]*Mym0o');
define('AUTH_SALT',        ']/Vp`[L0)QIU}q#65`bi{qc6DxN:E~?5!$+5RtDfmRyt@EldhZo&fRPW1JV`_3f ');
define('SECURE_AUTH_SALT', '7VX`=8#s$dt}|XJl3xYo]MsM]`sL=9RA-gODPzaMO4J6F1Qq3:E.a3/m<lZ1>X+d');
define('LOGGED_IN_SALT',   '<;6$qkp 06G8Z)-mkaM4Ua=^6c~H_;^S&y6d~@:>.>2 5-;*sMM>H #W<-& Z[)6');
define('NONCE_SALT',       '7rtW9X#hg`)cE<F@2~m|P)Xuv^l{C/,y`SWM6Tn~Ur,@L4A}D>{a`DqWET!.tj8(');

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
