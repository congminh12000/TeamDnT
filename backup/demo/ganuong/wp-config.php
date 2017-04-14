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
define('DB_NAME', 'teamdnt_ganuong');

/** MySQL database username */
define('DB_USER', 'teamdnt_ganuong');

/** MySQL database password */
define('DB_PASSWORD', 'bbhDst60zE');

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
define('AUTH_KEY',         'y|b.6s5ob!a)R;?l/q+kl}lq):*P-uG~1t$Rb#5h6Q|&(+B-Jv o-Z(ojk3w@it+');
define('SECURE_AUTH_KEY',  'kMgW+VA|3@V[MWLt$HAp|c(E)a!7+`KUdn.)3A4SgH_]`[MHVL)O]S &{DNyl$Z_');
define('LOGGED_IN_KEY',    'z=C[-e ^rEV%ICy%%Dm=|mYu$;|a-ALFZq+Tyga%CP+T1gb &:ZFc?U3S|B}%H{*');
define('NONCE_KEY',        'S*rjXlIA(m?CWci-jZEnf|n9 <MkP -+]K.7ufmp6qEVzht7-c/_hx.kU ml#uUr');
define('AUTH_SALT',        'W?UtMAV>^Da9 7@vksXa|`B0DTjE2uR.F|g%-CI rPVPOHBDA~HNF%f3Dl1T0[_v');
define('SECURE_AUTH_SALT', 'p|eCEPMth+ecrl=o~O!Mr4=GTGpn|);v^m+$qvlg^:T^0%+{cdCU-txBNle`O|]<');
define('LOGGED_IN_SALT',   'b##=R#:K?<AZTVEQ!sO*vINzss-N5U+@0(|*Y1 |!5r%He5Cc+>]mTUV|nA[-)XS');
define('NONCE_SALT',       '+,11F~!=a6_Fy.,q9vw.IyGZz(+ A`WUKx&(ChSJ:+rOhH2#Y<D c+FG}_&tjR2V');

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
