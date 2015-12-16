<?php
/**
* _Reboot
*
* PHP version 5
*
* @category Reboot
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
session_start();
 
require 'connect.php';

// ADD 1 to nbr_of_attends 
$result = $mysqli->query('SELECT name FROM users WHERE attend="1" ORDER BY id ASC');
$row    = $result->fetch_all(MYSQLI_ASSOC);
foreach ($row as $key => $value) {
    $query  = sprintf(
        'UPDATE users SET nbr_of_attends = nbr_of_attends + 1
        WHERE name = "%s"',$value['name']
    );
    $mysqli->query($query);
}

// RESET ATTENDS, RESET GUESTS and DISABLE GUESTS
$mysqli->query('UPDATE users SET attend = 2'); //2 = Not answered
$mysqli->query('UPDATE users SET guests = 0');
$mysqli->query('UPDATE variables SET value = 0 WHERE name="enable_guests"');

// STEP TO NEXT WEEK
$result      = $mysqli->query('SELECT week FROM weekdata WHERE currentweek="1"');
$row         = $result->fetch_all(MYSQLI_ASSOC);
$currentweek = $row[0]['week'];
$nextweek    = $currentweek + 1;
$mysqli->query('UPDATE weekdata SET currentweek = 0');
$query  = sprintf('UPDATE weekdata SET currentweek = 1 WHERE week=%s',$nextweek);
$mysqli->query($query);