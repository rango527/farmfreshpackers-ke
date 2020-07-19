<?php
define('WP_MEMORY_LIMIT', '512M');
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
define( 'DB_NAME', 'farmfreshpackersDB' );

/** MySQL database username */
define( 'DB_USER', 'farmfreshpackersDBUser' );

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

define('AUTH_KEY',         'A[n)ffFvY?GsV+)qzzbP%^OQ5!Si8ig:*]0#&ic|~xqqsv/|H~JU+3|H+d1N^sfT');
define('SECURE_AUTH_KEY',  '0Z-L+qjJ*XR8U)]|M/6NtPuS_4n|`d$:1tX0qDjmZ_-O6+$WkWMk=}Yn@ci%Kagk');
define('LOGGED_IN_KEY',    'Ic%a$Zbs~e/)M(!T`{Bn)t1j>j;Ec::r|zXKj|+qwexEm=RUM~TbcF/%v!!.{U a');
define('NONCE_KEY',        '<5vhW&-V+4yldGVx+eC ,Ov*Yjz7mWLlgP l~.~J|U-=!N!,o=W|VJ@o9XzAf.<d');
define('AUTH_SALT',        '4Z~;1pE{0EVz_#++L7^R`35$M$^1?@4t&{S.Szm9</]X 8]+EaW1|T1W6)=7mPaD');
define('SECURE_AUTH_SALT', '?/jt@%*m-f^cKCB{X,,eNp0(dVghdRw)dx*6zv(Z[%3-|E9lRz5g3UkPsdmg.3}?');
define('LOGGED_IN_SALT',   '=:]MzVY|.GTuMvY0l8[=G*gt-:dD^p?9/v3:UM&!_-nhO|s@p6q:88-Cf-(r01q1');
define('NONCE_SALT',       'K9v&$ttr,v-rwia$;+3K}-z*,>ym<KU-UXK]!?;~M@uIb=|g|Pp{gA (#<w]W.(x');

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
