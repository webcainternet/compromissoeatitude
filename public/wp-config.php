<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/srv/httpd/compromissoeatitude.org.br/public/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'comeati');

/** MySQL database username */
define('DB_USER', 'comeati');

/** MySQL database password */
define('DB_PASSWORD', '12qw12qw1#n3T');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '^?o(8^pTD6$Bn:qCKZSn;g[gpRLGGO(x5 JoD~9?Kom:.Th/),6_,ETh8-UVlQ<o');
define('SECURE_AUTH_KEY',  ':kz0ohpY_bAsbe[2P[vl@MS}Iza8N29R,OeWTCV8v(]N1qsZ.a:YbL%Oguc_V2~k');
define('LOGGED_IN_KEY',    'f@)A^Otuiov><N_Jf._e]m},PFs2Z{qPgA_ZZJD4 xgmLtD[CHQ4!Hb_b,#M6Vi2');
define('NONCE_KEY',        '- U`F-2@3t-Br_*+@q|&rfLRdLGd5P|Z!$ds>w)!LU5K%c,,eN]^,$ItsxDo^XP1');
define('AUTH_SALT',        'R!8fxM2[!t7wlMWOi^9DB%@V9)X)!^3.cmvo7I{fxoQMs)sGZI8.XF#KE*OXw<:G');
define('SECURE_AUTH_SALT', 'KTDFE;o3N5~_=GMGEu7Se3OHFVE}*uY!@>GI)&-IfQ]RA(D Jji};yc]]%#_/W9E');
define('LOGGED_IN_SALT',   'EJ$`q]s _.P7UYnb]q=XPs`_%.v7/L(A,4e=1E]bn%IJF<Ns?4,!6Q`?UT6#H+:W');
define('NONCE_SALT',       '-$XW.Uk1#$wIb>Nbhts4z>},^.5RyEEgB1%n(9%SRYo,Q{Py|$(+7=/43qg/ ^x9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
//define('WP_DEBUG', true);
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
