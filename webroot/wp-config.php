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
/*
 The customized section below allows for easy switching between multiple server
 * environments. The file ../config/active-env contains a string indicating which
 * file to read database and other site configuration options from.
 */
$file_active_env = realpath(dirname(__FILE__) . '/../config/active-env');
if (! file_exists($file_active_env)) {
    die('<html><head><title>Cannot find active-env</title></head><body><h1>Cannot find active-env</h1></body></html>');
}
$str_active_env   = trim(file_get_contents($file_active_env));
$file_current_env = realpath(dirname(__FILE__) . '/../config/' . $str_active_env . '.php');
if (! file_exists($file_active_env)) {
    die('<html><head><title>Cannot use environment ' . $str_active_env . '</title></head><body><h1>Cannot use environment ' . $str_active_env . '</h1></body></html>');
}
require_once $file_current_env;
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
require_once realpath(dirname(__FILE__) . '/../config/defaults.php');
/**#@-*/
/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
        define('ABSPATH', dirname(__FILE__) . '/');
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
