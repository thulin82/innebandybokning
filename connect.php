<?php
/**
* Connect
*
* PHP version 5
*
* @category Connect
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
$mysql_server = "SERVER_NAME";
$mysql_user = "USER_NAME";
$mysql_password = "USER_PASSWORD";
$mysql_database = "DATABASE_NAME";

$mysqli = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_database);

if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
