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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'xhunter' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'E!j6:lkbTpX5q~e6.,c%PCeFTd=.#%]1lV>8zu!k{qu]FGOa4bM,{s1K*(&W}=;T' );
define( 'SECURE_AUTH_KEY',  '&l*k}!tTo&t34)yzM?Q7=ZQAize]V~MC@nz?*:*hlOuq[wmHPEI*)l`8-$@7V2V7' );
define( 'LOGGED_IN_KEY',    'K<}?>TG0U=!X$|lpxXRR:[G,b^.P]hQ?mrs3BL2`-%b^Ze{{&mV7ERe479H6Pd$-' );
define( 'NONCE_KEY',        ')!Sq>7&Ib4< 8fi=EA].yw>/hBGE!4yDZ],Yg6HhH@7o/dW^bYy9Ak47%@30%PFB' );
define( 'AUTH_SALT',        'O{.V=y:jjk(>p(c@.jjdIuy#4Rf$5(,)quCKOQlzfqK{6-RhL(}jiUlr&]I{REE0' );
define( 'SECURE_AUTH_SALT', ']s?/7%1%^xo?[o`?RMy6ZUGBiy{-4Shug[#mKL,n;_B8Liv9s=Yy<jVK*7{q-u!6' );
define( 'LOGGED_IN_SALT',   '*0*xU9L$EqH)SFOTfTe%mR[oCl3uy=nA7BuVHt~5m@uN[]8G(P**7a~=4H]L+t/{' );
define( 'NONCE_SALT',       ' pqIoP>m)<=CilyvZ72Lqr<CHv?Bv[~?hVhFI>u[fqI?Lf53p=^C,>a_ToL+:82,' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wmvn_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
