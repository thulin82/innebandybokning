<?php
/**
* Config
*
* PHP version 7
*
* @category Index
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
session_start();
 
require 'vendor/autoload.php';

// Connect to a MySQL database using PHP PDO
$options['database']['dsn']            = 'mysql:host=localhost;dbname=development_db';
$options['database']['username']       =
$options['database']['password']       =
$options['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
$db = new Connect($options['database']);
$sql = new SqlFunctions($db);
