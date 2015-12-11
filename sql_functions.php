<?php
/**
* SQL Functions
*
* PHP version 5
*
* @category SQL_Functions
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/

    /**
    * ShowStatsForSeason
    *
    * @param string $season The season you want to get stats for
    *
    * @return void
    */
function showStatsForSeason($season)
{
    include 'connect.php';
    $mysqli->set_charset('utf8');

    $query  = sprintf(
        "SELECT `name`, `%s` FROM `stats` WHERE `%s`!=0 ORDER BY `%s` DESC", 
        $mysqli->real_escape_string($season), $mysqli->real_escape_string($season), 
        $mysqli->real_escape_string($season)
    );
    $result = $mysqli->query($query);
    $row    = $result->fetch_all(MYSQLI_NUM);

    echo '<table class="table table-striped">';
    echo '<thead><tr><th>Namn</th><th>Antal</th></tr></thead><tbody>';
    foreach ($row as $key => $value) {
        echo '<tr><td>' . $value[0] . '</td><td>' . $value[1] . '</td></tr>';
    }
    echo '</tbody></table>';  
}
?>