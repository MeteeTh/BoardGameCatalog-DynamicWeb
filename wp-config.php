<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'boardgame' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '12345678' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '|kuioMaJHv9rE]57tP[pTIvf-*pGFTttVGe&5NxT}A[5:*XBOn[hjP_,FYwd>37i' );
define( 'SECURE_AUTH_KEY',  '_L4al||23Pr:7H~+ BJ!Gk* ocd;Ss3lK+&#hXL&@?*pCjkm0e{Y*:L]7bFB?7wj' );
define( 'LOGGED_IN_KEY',    'l*8vipu0?c|M&%a-]@O*-GZ[X3A36HW{[;P#TYaWQ.ww/P:HK!kRwIoebhwh}Ki|' );
define( 'NONCE_KEY',        'x.sJv1l6Y2$nPSuTb}}vW1:*&{XIkq6E*rgg3yeMm-InY6`2/?qkbTXou#f`i_fs' );
define( 'AUTH_SALT',        '`2(kk/zDl/EW/8lxxVfpz!C!|`{U~&^m#*bG3?WF5YavQ86Ox*?BsHRP.=]b1F8g' );
define( 'SECURE_AUTH_SALT', 'z(hL2t7>]W{*Z{ZGH%A9lpUBA.MJ>6|TM5b,Pil@XQBt]6fd]ISvnW@z!o+7ntKB' );
define( 'LOGGED_IN_SALT',   ';R{WgG](hgjMY`4Y@j5@/.HbGhLysnosv?kLUv-IBu:#@we`^7]6.sn]1zY$R7NR' );
define( 'NONCE_SALT',       ')#gpk:mh?-YVm^/xS)hSve>t3QO0>%:`;].Qvch1}4RSEedtw[v tmcmQ@VWSO3:' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
