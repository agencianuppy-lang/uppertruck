<?php

define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
/** Enable W3 Total Cache */
 // Added by W3 Total Cache

/** Enable W3 Total Cache */

/** Enable W3 Total Cache */

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
define('DB_NAME', 'uppertru_wp173');

/** MySQL database username */
define('DB_USER', 'uppertru_wp173');

/** MySQL database password */
define('DB_PASSWORD', '9GS]@5pdv0');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('DISABLE_WP_CRON', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ox9ex5azup12vcs9cmgzeli8aekyijgwam82yteaa96oon4tjpbdarrbmpxvyj2w');
define('SECURE_AUTH_KEY',  '2gzkrk3h4paqsafnauunbbiqhgkaexzvox0ex6pwz7pybe5yjujwnkt6fto0hom7');
define('LOGGED_IN_KEY',    'au1t1zdlnkyytgzmisenxewrsivvacq1t7hgyn5itoiuwazjk8wwhzrxjo5evg77');
define('NONCE_KEY',        'kub3oncxore8zqdbgsb7x845ppcmy2jhscowa4fsobyvnayha6lzorvtvj9lu2cb');
define('AUTH_SALT',        'kvnmqvs6zirauafy19onjwgo19heog2q59a0yrdvttq1fr17fkjkkhjp7jozvoto');
define('SECURE_AUTH_SALT', 'gaxkse8evmfcjttrw8qwamanfmhl8zzqgx4m2f1w3hjvbtfwwivoa627ikxlz847');
define('LOGGED_IN_SALT',   '4dqrqjg6gzblxq8g2eaaheeifr4dcypnirgtwexhsmiqn1leymvcfpvcvz2vq8ve');
define('NONCE_SALT',       'tu7ijupn3qdhvwgx6kwelczz3zekwzxm78dvrn3rvppzcxxtmk80nam5hei9dhvz');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpxq_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');