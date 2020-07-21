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

define('WP_MEMORY_LIMIT', '512M');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'farmfresh_biolife' );

/** MySQL database username */
define( 'DB_USER', 'farmfreshpackersuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Rango(4)' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('FS_METHOD', 'direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?ft9l#4#v3YOA]g7&i.#SFFP_AFPB-N3[/+5Mlu<fpdk }VL)Rx1Ax%2QR)^7ZZd');
define('SECURE_AUTH_KEY',  ',R2MY+OB7*Y-?VV.yulB9<)HYB)l,8J*${uqlWLiBK~GsV;}=Fz_87Ac/8S:bJCM');
define('LOGGED_IN_KEY',    '@LIC=Nl$q!500*dhCR~R#*Oo{<6i]+dKN!YRbAz6T5czv5}[FIXhCoZXx.|vvb6:');
define('NONCE_KEY',        '.9oc+LP}sr+p-!k!$*`K8jfB_PZfJNWHU :x_|A6><TYg./71.!^RM6uC^$[w3RG');
define('AUTH_SALT',        ')50*@>^>XCd^]B]F5$}W(1~N8(i5C=@;W.d!@P.PHuo3rsJbuimIp&nnvd?mFP6D');
define('SECURE_AUTH_SALT', 's(f^$<T+@NHEkUKj >;i22F6qwE*G_xmN>M*.(vSd@tRw3d|JEfSl+It3*m{o7(%');
define('LOGGED_IN_SALT',   '(dg|hLKCnr~8Yr2}F<K<lyX=|>@TW!z>+hn`x#lH8d`N&JU+Lh 6q@Gdg4DgMU&:');
define('NONCE_SALT',       'ko?qM(GPUQrK.4kl8+PD%qe86N_pgNCfGxmF-jTQ^9{%^!,NL}8F1?bEIY)Ndk*N');



/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
