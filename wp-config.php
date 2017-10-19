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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'j#Gyfe%RC|c<*D>&F-Fb$z&ws&QYs).5q#q)bm=<XF)3EU`{};qehF?R}xFlJ|&z');
define('SECURE_AUTH_KEY',  'f=>aJj4sa[Oid[]X$jGZ/[%gd`t{Aa#8;|KnIBmw:bUZ+jfN)Xo3m4; w=o_b&DZ');
define('LOGGED_IN_KEY',    '<yobz&,x3!t>VMK9<0N^%Q[Aq>oZvfz9Ch<&2wr|/e Dnqw.6;pJEJj3n^P4Vse*');
define('NONCE_KEY',        'awM!^ty+:1]zr0=}kI$E)dRb{;P;vKolpdGEOi[.L^~3lyT6&*as8^f-Hd+s(HJ_');
define('AUTH_SALT',        'e$>efH{2~~;A>{@>aiX[OHRg^-sabn.{0wmV::|bP0ByI^)jWoqLQ0.{P[f|ttY1');
define('SECURE_AUTH_SALT', 't?(Q~rj]ARvX2TA{F1#GH0;ciW/a%F2[#VSG*q7np2e1j_-O][n+-d ;v$ uJW={');
define('LOGGED_IN_SALT',   '!CCLNBIivCl<u$Hs6yt05n:OW`oA&Z}D7hVnplX[-hC4-la>l||,~|T>SYgojNmO');
define('NONCE_SALT',       '~AaESqWu+*B/%ap~3`Hoq4d`4&U0zRRAnq/<|O-`8!E(J3J<2_AG|V7@Ja^4Y*fg');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'xd_';

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
