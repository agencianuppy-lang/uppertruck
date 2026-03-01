<?php
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
define('WP_CACHE', true);
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
define('DB_NAME', 'uppertru_wp440');

/** MySQL database username */
define('DB_USER', 'uppertru_wp440');

/** MySQL database password */
define('DB_PASSWORD', 'l[b0Xt5xTrr-t4M8x([9])3c]!r(Q)E(po-9VU(((@W!.!@A]BO9)(-(!S!]CS]A))0(3x');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'rj173ogqqgfcvieuif6pa2mqeru1pdxhvj0mr44lwvvolfkdykcsbgzbxastnleg');
define('SECURE_AUTH_KEY',  'c4s8lxo5yq9fee98cz3bycv5n9deoyzu8dqqbrhblfvxpvndnsjvox9pej9inbmg');
define('LOGGED_IN_KEY',    '0h617bc2fkm2az5fyhm5lexjrlrek0yxipte5ja1emihsn5yhltizkmubgbaxy1v');
define('NONCE_KEY',        'goxu7uc3dkrgxf9j1asspjh3bidwdijgman58icfs8xfswvxrulyq7sso9yepvah');
define('AUTH_SALT',        'iyhestsyyoifmbzwaehzrf6hhp9xtxbvhmdw7d8j9nxgkgjacaprcidill3wkf70');
define('SECURE_AUTH_SALT', 'w4bpvssgfycpmlkssoucmg709cfwokhvfycjhrgcbb2dkvkuzqsqi9abnjl7year');
define('LOGGED_IN_SALT',   'eqzix5wyfsloc0h1bptokqyxgo2jfs6zwlim4wqnkxnbvv28nbuzwbyo39r2vooy');
define('NONCE_SALT',       '0xd5wowj08kokxz1pj0tsqgvsmh4o5l40j3ybnoipwjja6w3qqs8mifmphzyk2kj');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpeh_';

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