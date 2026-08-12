<?php
/**
 * Config
 *
 * PHP version 7
 *
 * @category Config
 * @package  Innebandybokning
 * @author   Markus Thulin <macky_b@hotmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php MIT
 * @link     https://github.com/thulin82/innebandybokning
 */

// Set the error reporting.
// Report all type of errors.
error_reporting(-1);
// Display all errors.
ini_set('display_errors', 1);
// Do not buffer outputs, write directly.
ini_set('output_buffering', 0);

// Start the session.
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();

// Settings for the database.
define('DB_HOST', 'db');
define('DB_USER', 'db_user');
define('DB_PASS', 'my_pw');
define('DB_NAME', 'my_db');

// App Root.
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root.
define('URLROOT', 'http://localhost:8000');
// Application Name.
define('APPNAME', 'Innebandybokning');
