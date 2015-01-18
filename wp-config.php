<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wordpress');
define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME']);
define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp-content');
//define('WP_DEFAULT_THEME', 'mytheme');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kanatek_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '%e$~IAs&7wT2`y{lMa=-]>.LSJ8Z:@l[E[l3$k|F.8J1>{8c~n}+a[OwMO9O`Opm');
define('SECURE_AUTH_KEY',  'kA.Hsze;2nJ5c@&K&E=S^sz&A>x=?|X++fm}%5N > DrHR5l+h9r75c51uW(aB-3');
define('LOGGED_IN_KEY',    '|q^9 %|9tMYs,2X]*w|)r&?L}edR]_+^?a)l#4KIu`}>W^nXZ|B%dDE by~%(N&[');
define('NONCE_KEY',        '[)uG)`]H-7>8|e(pb+cch)zP-x/*bf+^1903:!RK]J_dc`:J4^A(+P}[PD-};p6`');
define('AUTH_SALT',        '#n1CwT1N1[~,F?[aHl`Rh%Y1csXAHK}sQiHHUzo~O_ |DvQp[ou)RzM#?(GD=DqF');
define('SECURE_AUTH_SALT', 'l}{H :n+Y1e+Hc74W(^^a*YTs+@nX3^|,X/k`Ql3F_S%EBGT|KZaWxsR#JQr,yzO');
define('LOGGED_IN_SALT',   '>g],CQ_dzX/fw:[nvYDvu-SJ|Z9%;$}N2-MG_P=SU!hVyD~us+=?st}Iv$5UYY&e');
define('NONCE_SALT',       '>L[z1K0w-n;M9B9lWQG9q#p>x];%[jmgNW@ #Zd,kvk>K?w972OO;VrGw4e1;7M[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
