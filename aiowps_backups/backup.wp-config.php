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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'nd&k^5EcbiFLa-?VHfEaSEvuuhseovT!%2,pV}Y/h*g08R,w<5vC;H@uH}#< &T[' );
define( 'SECURE_AUTH_KEY',   '8LHPI$E*#6*KZpd.wci+M0|{r)Feh_i(NB`1hlBMYI]*p>;2Q,|b#?-))S*L]+*a' );
define( 'LOGGED_IN_KEY',     '!0t>>W<7M3Le*[5v0uO_YN&3y:6i4h@?zHUQR}ly?Il)5E(4CD13o2],5GN2 $O3' );
define( 'NONCE_KEY',         '}5zq(zbwNfPk@T*5ch/AX&C5 [pjJ/8;82&ifbTLVcuiF9si/^kw]Q;7cU@v;0oE' );
define( 'AUTH_SALT',         ';F4R8ppL!z&ZZ2m@k; %RX9+cCMj7HFrGP)HWg[2$2Rk| &}G&gv`NEK>eXSwvzX' );
define( 'SECURE_AUTH_SALT',  'h^VD~N][rpieq#9R8rlxDYeqPt)|F4mg*JTyX&yxn(J_qsQqIH #nkN&Nj-,pUV2' );
define( 'LOGGED_IN_SALT',    'fOFvT|umD2MP?N5HItq{6EtP*PmC2zAvd=| BJvh,~X?{7T#nnBq>Ivo|LhS2THR' );
define( 'NONCE_SALT',        'X?fL?GOOwwm>@}|J$yGG{DpWtyi]Q;D{%h>[HkGvtDZ@p|y+l^ mo(18Ly+-V/0=' );
define( 'WP_CACHE_KEY_SALT', '<5%jISYl1k=bOAO9&q^^1#yGQ425E&;sx]:p{ihXr%QT*&v)Dq+,,8QN_Cvf-KJC' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
//Disable File Edits
if (!defined('DISALLOW_FILE_EDIT')) { define('DISALLOW_FILE_EDIT', true); }