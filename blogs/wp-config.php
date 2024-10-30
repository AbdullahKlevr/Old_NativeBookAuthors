<?php
define( 'WP_CACHE', true );


































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
define( 'DB_NAME', "webvyoli_native" );

/** Database username */
define( 'DB_USER', "webvyoli_native" );

/** Database password */
define( 'DB_PASSWORD', "p9r4.!(.5pSoL)21" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'p4w7ypchucsbwegnkqcyjuvbfwmug5pwl5bd1a0mcgsjfqltu2baswuzykxkxpg2' );
define( 'SECURE_AUTH_KEY',  'ndralg4rdz3l2uuoefkzfi5ceocvr9btho8ts8rcwrqx64thjorldndfkukt3izg' );
define( 'LOGGED_IN_KEY',    'btyllpuyivjpmsflwnw0hnxqtruxv15ek3alkglvsdkrobwfrrqixp4ztecjqr3z' );
define( 'NONCE_KEY',        '5avaicytvohmsiwpxanuofz5ybolkrd5qvl6r18sxh00wz3kknihosxt6extuid9' );
define( 'AUTH_SALT',        'zzkhy0u8iwl4n8ajqs0b5lbscdz6ax4guadv1dwzelrxxl2oa0gbaamirvfpkyob' );
define( 'SECURE_AUTH_SALT', 'qaldxdysdfgaj08fpenw8lbtnlvxmja7axth4fq4zteu3qiokff0aqi9cvei7jgx' );
define( 'LOGGED_IN_SALT',   'qmq5rqaqfuy2upnxfpcp01purx3jja1thlgpxlrc1cq3auedcigtfgv6cce5ph2g' );
define( 'NONCE_SALT',       'ebn5tilomnvhes2hbgbump6f5djqoo49jr33hsqmyhqa3j5a3bwaeik9yn8lrwst' );

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



define( 'DUPLICATOR_AUTH_KEY', 'iHHwblY%>-[@khoXmmzB~mQzq`@K7{ .DvQ5&G7)tEUl,5hG-H/1;|THGZY-&,=E' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
