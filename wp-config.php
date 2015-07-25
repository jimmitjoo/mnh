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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('DB_NAME'));

/** MySQL database username */
define('DB_USER', getenv('DB_USER'));

/** MySQL database password */
define('DB_PASSWORD', getenv('DB_PASSWORD') );

/** MySQL hostname */
define('DB_HOST', getenv('DB_HOST'));

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
define('AUTH_KEY',         'Gio2pvrQWES3WtBq7AFPSVu4Iw4IiS6UjJd4XWtjA8ylV3H9Dsf6h848DzXR0s5E');
define('SECURE_AUTH_KEY',  'Yb4a8EAAOnPYddqEwIup8xfSp6Zz0G8V73DWemSGyHFFxcJwvteLuZqedMdpgcJN');
define('LOGGED_IN_KEY',    'AfBr3j83u2perWVki3gP3VCp1S26apokTcfGnJSxI0YeODzpt4ihjYCTLoqLlrBW');
define('NONCE_KEY',        'FlAEzkqG8gMTfUaOiq8XkiMo1m0C70WSfRL6dLlk4to9ZUPwjJMcjRp2dmimyk6J');
define('AUTH_SALT',        '7tEkJmv4RYmwqNkk74khXEWkp0WwEsh239zITRWeC9s9guqBbikse8xYo6s88REr');
define('SECURE_AUTH_SALT', 'MG6xdNQf8TRX3odLikAx1cTDTfTyQ5ZMW3dbi0eFGaEOsLUCN8g0x7FgbFODjKof');
define('LOGGED_IN_SALT',   'rYnAr6Aorb8PWUfMQd2A0qo0omXMT1HzYOPBoYlUzD9KBrHaczy1wDdyorAhZ9EN');
define('NONCE_SALT',       'wduhwXtqqfTDYrTV7rS40DfrTri0zLCxYwnvL2pxsopVMDtpn8Em8eQcj5BRHEfo');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'm09h_';

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
