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
define( 'DB_NAME', 'DB_NAME_TAG' );

/** MySQL database username */
define( 'DB_USER', 'DB_USER_TAG' );

/** MySQL database password */
define( 'DB_PASSWORD', 'DB_PASSWORD_TAG' );

/** MySQL hostname */
define( 'DB_HOST', 'DB_HOST_TAG' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '<3DMVlJqH9SGBag5Fae@IHWY2NSViG`rbq,i;}=hMV+=ZZNCo<qY<A4[}dN>l^!o' );
define( 'SECURE_AUTH_KEY',  '&eCSDCMLl:~;z=L(*TulKfC)qu#~j`&QQ12E$bm#6s7caJh5$NR4=Vn[0=a-AF4E' );
define( 'LOGGED_IN_KEY',    'Jz_GGv!3Wj>a48<rtsgGfE|R%yLQE@,mKARtJWOEbLTAw50MI_`JU~Q}}H(PY^c{' );
define( 'NONCE_KEY',        '.>o[29$o^&{}@oP)Aa=iNxVqPLKnu$Ry{)o(#_i[rR9:3+x?@;_ct?b=k*k&.5.|' );
define( 'AUTH_SALT',        'zL9iOI]=]NYy6nM+LJ|;s`q/w_o{[X./PzW5bHO{~};_<=a:L!kzXfnaUGX`8A:n' );
define( 'SECURE_AUTH_SALT', '/S L#P[`SZ&OQK)/;a=u5QuG-R$gS7_HZ2F9<DS<:$j52Op!>fC54G6$phi(Wnxl' );
define( 'LOGGED_IN_SALT',   'OD:utKC<&vALYT~RG+&&<nESW@x]2 /O;+A,k4a(%)B8z=XrVM)%}?3qMug!.GT8' );
define( 'NONCE_SALT',       '2>Rc)%v]}A_3G{Ka`R<!Q;>S^@^4bFM7% Y9OK$tN. )0B|fvomHf9d+,yQlu|2#' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
