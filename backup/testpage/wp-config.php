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
define('DB_NAME', 'teamdnt_testpage');

/** MySQL database username */
define('DB_USER', 'teamdnt_testpage');

/** MySQL database password */
define('DB_PASSWORD', 'raPVPv3oP');

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
define('AUTH_KEY',         ',.rv1h%;o2U`L3(hDby4~$c-9US}.8n@$uypFbJ#sXL|]k0$!5+f-kEe or_4J?;');
define('SECURE_AUTH_KEY',  'rE(F<qy7|y+*|H_[cBI@MT@eTy,an+Ph:7O8J*yuU4@va@6>~:ef;C:>0sZ2Jc%V');
define('LOGGED_IN_KEY',    'iA3[+ZA_KvnBzzAN&AP/Sm~Fu8w/Skv2doN>8M|WEM~[f7TzZ^;}e/gLvq|nBEjM');
define('NONCE_KEY',        'qC3`*^=~_KQ2h/;$DqR{`5okBBPI<Hx7QG%x,n3`4+`H!rp*n#Svah7GT fP:Jh{');
define('AUTH_SALT',        '7`}e~$m#Lot df/0U8?um_Zr^?g.mWAHr(5 49^`ZsJ6??DVi~g 5N]0ct*_keBf');
define('SECURE_AUTH_SALT', 'X|upn,hO`8-.?wz,F]eV` #6&nxx0J*^HI*v(EFMiK@mtM(W6SO?gw|/3y);]uCH');
define('LOGGED_IN_SALT',   '`|0g 9h@2dH))>/r!,_Mw?&*.B_;O`fB7Fk4CN)awBWZK$ KEx1v4oV;Kc=a_>^x');
define('NONCE_SALT',       '`NB>+Hg?ULj>W/9Uu^BIUjYZ?n)tyz,8)Oa9[ (LaD!vZ A$Y`3<7QK#dc[2M@Jz');

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
