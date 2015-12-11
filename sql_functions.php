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
    * PrintTable
    *
    * @param string $head1 The First header
    * @param string $head2 The Second header
    * @param array $data The Array containg the data to be printed
    *
    * @return void
    */
function printTable($head1, $head2, $data)
{
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>' . $head1 . '</th><th>' . $head2 . '</th></tr></thead><tbody>';
    foreach ($data as $key => $value) {
        echo '<tr><td>' . $value[0] . '</td><td>' . $value[1] . '</td></tr>';
    }
    echo '</tbody></table>';
}

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
        'SELECT `name`, `%s` FROM `stats` WHERE `%s`!=0 ORDER BY `%s` DESC',
        $mysqli->real_escape_string($season), $mysqli->real_escape_string($season),
        $mysqli->real_escape_string($season)
    );
    $result = $mysqli->query($query);
    $row    = $result->fetch_all(MYSQLI_NUM);

    printTable("Namn", "Antal", $row);
}

    /**
    * ShowStatsTopTenTotal
    *
    * @return void
    */
function showStatsTopTenTotal()
{
    include 'connect.php';
    $mysqli->set_charset('utf8');

    $result = $mysqli->query(
        'SELECT `name`, `aut2012`+`spring2013`+`aut2013`+`spring2014`+`aut2014`+
        `spring2015`+`aut2015` FROM `stats` ORDER BY `aut2012`+`spring2013`+
        `aut2013`+`spring2014`+`aut2014`+`spring2015`+`aut2015` DESC LIMIT 10'
    );
    $row    = $result->fetch_all(MYSQLI_NUM);

    printTable("Namn", "Totalt", $row);
}

    /**
    * ShowStatsTopTenSeasons
    *
    * @return void
    */
function showStatsTopTenSeasons()
{
    include 'connect.php';
    $mysqli->set_charset('utf8');

    $result = $mysqli->query(
        'SELECT `name`, `nbr_seasons` FROM `stats` ORDER BY `nbr_seasons`
        DESC LIMIT 10'
    );
    $row    = $result->fetch_all(MYSQLI_NUM);

    printTable("Namn", "Antal S&auml;songer", $row);
}