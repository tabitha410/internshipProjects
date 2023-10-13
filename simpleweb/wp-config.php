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
define( 'DB_NAME', 'simpleweb' );

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
define( 'AUTH_KEY',         'GJ0*ivqPX`RYL6~#38gbpOjC@}sK~/},x-|`n M#S_ RZW(NCQSxc$r,DGb.VqJT' );
define( 'SECURE_AUTH_KEY',  'B__-0&2+`g]:Ky3q]^lStG@iah4OX_+(SzQ0MZ!dY/Y[Bb%E8^yzN*>pwf2Nh>dG' );
define( 'LOGGED_IN_KEY',    'QeH5cNX}`Zg_5{;dwaW.+K]PiBhY)}7DfcSIHjvLQO|+u4Wj9S4}J ]B1I ]`4e!' );
define( 'NONCE_KEY',        '+QfDPN]eNQw%|z&_/!WVtF6/m52;Lb>F{emyu^@Gnze4p9DRxI[B7o&UKpF&~OOH' );
define( 'AUTH_SALT',        '5`]E$N;7d:^LDv823>4,yXq.KT&[{Cp+`,^(ih/K3Z_ioQk)JxP>,lH8)7sN|R? ' );
define( 'SECURE_AUTH_SALT', 'NrAr=kR4u[5ELGV-(}h`!4t5iHzi(d:3P<n/lx]ttKtlV+x|*^<?E(}-RM1t5dv{' );
define( 'LOGGED_IN_SALT',   'tkjcQSl4Pi&mrLWN5A{!?b#S,.5&M]Wc_3tavj!!MY^:FM|)s*|yNeHQv6w|19Y<' );
define( 'NONCE_SALT',       'gUXYR9{z[rB~h#BBoVp<<kp4fEZt455_iH&oKQg%2)^%$_vD<~e#UcWZ 9R~T#JK' );

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
