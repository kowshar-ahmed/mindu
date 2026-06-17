<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mindu' );
/** Database username */
define( 'DB_USER', 'root' );
/** Database password */
define( 'DB_PASSWORD', '' );
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
define( 'AUTH_KEY',         'RGjq(?>#EQ2Iq[CgD5q3hI8D6@)T=@Zu@e)bcMmJg[ZlETa9BmS6p!qJ{W(N3ia]' );
define( 'SECURE_AUTH_KEY',  'UGo;sSj:{95z9J@#ZB8V4H~$o-rl<>~2`.C>?^#aq8kCd<vn1#R=+`jl.GgDB3RS' );
define( 'LOGGED_IN_KEY',    '%!eF|<@C*J}I^=OzD.HBgDuKV}o m^tsjDv{=[(Nu%R2O8(7${-N!n(BRm1g<%qh' );
define( 'NONCE_KEY',        'pgcA63R9qb]8@ffI/VvFZ:a@|dORC+bw|yf>5B-:`qIo!TC)b-s+3Bw*/G [Kr*~' );
define( 'AUTH_SALT',        '/u0n6p4};eD>LHlmB?ZS/| f!)GVcFA A$wT.meni9*z[kY@/iNGkW*l^!pv# ?F' );
define( 'SECURE_AUTH_SALT', 'a%tw/)!R#qD[6$K)nGWg;0:Wd6z((eZAL6/qv_kJZo+!}2+LX*+&YZ`InTS8gR?v' );
define( 'LOGGED_IN_SALT',   'gzzYc/1m|1! C@;yz8{bh[d?Gj;>14:jl0KCHL$_:p.D%PWk)&B7Y4Jm!%ba$XF2' );
define( 'NONCE_SALT',       'S:~)W|=!bC3L_m<#|mPvn}@WPO/r@zz#aqmN!te9}g#%s6hWwXZhav[OGI|ej{:N' );
/**#@-*/
/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
/* Add any custom values between this line and the "stop editing" line. */
/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';