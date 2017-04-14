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
define('DB_NAME', 'teamdnt_ofood');

/** MySQL database username */
define('DB_USER', 'teamdnt_ofood');

/** MySQL database password */
define('DB_PASSWORD', '08sTk4LsLi');

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
define('AUTH_KEY',         '*$^d6-X8fTMN@xYm6,CI055&$1goqwT)Iwc%l6FR@#_,?W>E<A3y}_;xYMzf=Ey&');
define('SECURE_AUTH_KEY',  '>aivF ?HY6ob7%5BT[m:r-@I;@)0h0{]R)~o*eu5Q]SB+@68~^JSDJdxT!Q0[j/]');
define('LOGGED_IN_KEY',    'AJcEi6+2  L)nxbea)o&~ l?ZI=l[H;@FX&`tll&Om6 7`N$qHgF)W]_6mNotw!g');
define('NONCE_KEY',        '7D9jth/VmfZ:QtxCwgxjqd]Z_QdQaN:SLe,*8btWXEP %@!Kmj.2DZUe0G*<jwyv');
define('AUTH_SALT',        '?Q{W#u}*kj6|]3.[SutWsn>ny${yjq_1oC}Jkwp:`s1zkjmt+xZt4C,gZ!zd<goZ');
define('SECURE_AUTH_SALT', ']6:Cq3<Ng_@nVE<(l@%ac;)@w)R$LenI(HXJ*di+^Cun>(kQsy9#+W*k.z6*R{i`');
define('LOGGED_IN_SALT',   '|S7sY#V#[jFhtor}|#VWATX4R 7w)]j,aMy,oB=Q)DR<4<jAjQZZD@G37}Y*R(qM');
define('NONCE_SALT',       '{;+4568DJ[6+ZaqM76?9pHg/.QXfrlwf:R8P^}]=Ppc=||!pNq,/zg?q-T,!HeVa');

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
