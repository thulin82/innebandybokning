<?php
/**
* SqlFunctions
*
* PHP version 7
*
* @category SqlFunctions
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
class SqlFunctions
{

    private $dbase = null;

    public function __construct($dbase)
    {
        $this->dbase = $dbase;
    }
    
    
    
    
        /**
        * PrintTable
        *
        * @param string $head1 The First header
        * @param string $head2 The Second header
        * @param array  $data  The Array containg the data to be printed
        *
        * @return void
        */
    public function printTable($head1, $head2, $data)
    {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>' . $head1 . '</th><th>' . $head2;
        echo '</th></tr></thead><tbody>';
        foreach ($data as $key => $value) {
            echo '<tr><td>' . $value[0];
            echo '</td><td>' . $value[1];
            if ($value[2] == 1) {
                echo ' <span class="label label-success">Leader</span>';
                echo '</td></tr>';
            }
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
    public function showStatsForSeason($season)
    {
        include 'connect.php';
        $query  = sprintf(
            'SELECT `name`, `%s` FROM `stats` WHERE `%s`!=0 ORDER BY `%s` DESC',
            $mysqli->real_escape_string($season),
            $mysqli->real_escape_string($season),
            $mysqli->real_escape_string($season)
        );
        $result = $mysqli->query($query);
        $row    = $result->fetch_all(MYSQLI_NUM);
        printTable('Namn', 'Antal', $row);
    }

        /**
        * ShowStatsTopTenTotal
        *
        * @return void
        */
    public function showStatsTopTenTotal()
    {
        include 'connect.php';
        $result = $mysqli->query(
            'SELECT `name`, `aut2012`+`spring2013`+`aut2013`+`spring2014`+`aut2014`+
            `spring2015`+`aut2015`+`spring2016`, `total_leader` FROM `stats`
            ORDER BY `aut2012`+`spring2013`+`aut2013`+`spring2014`+`aut2014`+
            `spring2015`+`aut2015`+`spring2016` DESC LIMIT 10'
        );
        $row    = $result->fetch_all(MYSQLI_NUM);
        printTable('Namn', 'Totalt', $row);
    }

        /**
        * ShowStatsTopTenSeasons
        *
        * @return void
        */
    public function showStatsTopTenSeasons()
    {
        include 'connect.php';
        $result = $mysqli->query(
            'SELECT `name`, `nbr_seasons`, `season_leader` FROM `stats`
            ORDER BY `nbr_seasons` DESC LIMIT 10'
        );
        $row    = $result->fetch_all(MYSQLI_NUM);
        printTable('Namn', 'Antal S&auml;songer', $row);
    }

    /**
    * GetNbrOfAttends
    *
    * @param int $status The status integer
    *
    * @return int Number of attending/not attending/not answered
    */
    public function getNbrOfAttends($status)
    {
        $query  = 'SELECT COUNT(`attend`) AS Attending FROM `users` WHERE `attend`=?';
        $result = $this->dbase->executeQuery($query, array($status));

        return $result[0]->Attending;
    }

    /**
    * GetNbrOfGuests
    *
    * @return int Number of guests
    */
    public function getNbrOfGuests()
    {
        $query  = 'SELECT SUM( guests ) AS Guests FROM users';
        $result = $this->dbase->executeQuery($query);

        return $result[0]->Guests;
    }

    /**
    * GetIsGuestsEnabled
    *
    * @return int Guests enabled or not
    */
    public function getIsGuestsEnabled()
    {
        $query  = 'SELECT `value` FROM `variables` WHERE `name`="enable_guests"';
        $result = $this->dbase->executeQuery($query);

        return $result[0]->value;
    }

    /**
    * GetCalenderInfo
    *
    * @param string $calenderObject String with Calender Object
    *
    * @return int Guests enabled or not
    */
    public function getCalenderInfo($calenderObject)
    {
        $query  = 'SELECT * FROM `weekdata` WHERE `currentweek`=1';
        $result = $this->dbase->executeQuery($query);

        return $result[0]->$calenderObject;
    }

    /**
    * GetNbrOfUsers
    *
    * @return int Number of users
    */
    public function getNbrOfUsers()
    {
        $query  = 'SELECT COUNT(*) AS nbr FROM users';
        $result = $this->dbase->executeQuery($query);

        return $result[0]->nbr;
    }
}
