<?php
/**
* Stats
*
* PHP version 5
*
* @category Stats
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
session_start();
 
require 'connect.php';
require 'src/Functions.php';
require 'sql_functions.php';
$mysqli->set_charset('utf8');

// I session set = user logged in
if (!isset($_SESSION['sess_user'])) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Innebandybokning</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="custom_style.css" rel="stylesheet">

<!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
<!--WARNING: Respond.js doesn't work if you view the page via file://-->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle"
        data-toggle="collapse" data-target=".navbar-collapse">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>

<a class="navbar-brand" href="#">Innebandybokning</a>
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="index.php">
    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logga Ut</a>
</li>
<li><a href="book.php">
    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Boka</a>
</li>
<li class="active"><a href="stats.php">
    <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Statistik</a>
</li>
<li><a href="about.php">
    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Om...</a>
</li>
<?php
$sess_id = $_SESSION['sess_id'];
if ($sess_id == 2) {
    echo '<li><a href="admin.php">';
    echo '<span class="glyphicon glyphicon-lock" aria-hidden="true">';
    echo '</span> Admin</a></li>';
}
?>
</ul></div></div></div>

<div class="container">

<h1>Statistik</h1>

<br>
<div class="row">
<div class="col-md-6">
<h3>Topp-10 Medverkan (totalt)</h3>
<?php
//Get name and nbr of attends for those on the top ten list
$result = $mysqli->query(
    'SELECT `name`, `aut2012`+`spring2013`+`aut2013`+`spring2014`+`aut2014`+
    `spring2015`+`aut2015` FROM `stats` ORDER BY `aut2012`+`spring2013`+
    `aut2013`+`spring2014`+`aut2014`+`spring2015`+`aut2015` DESC LIMIT 10'
);
$row    = $result->fetch_all(MYSQLI_NUM);
echo '<table class="table table-striped">';
echo '<thead><tr><th>Namn</th><th>Totalt</th></tr></thead><tbody>';
foreach ($row as $key => $value) {
    echo '<tr><td>' . $value[0] . '</td><td>' . $value[1] . '</td></tr>';
}
echo '</tbody></table>';
?>
</div>
<div class="col-md-6">
<h3>Topp-10 Medverkan (antal säsonger)</h3>
<?php
//Get name and nbr of seasons for those on the top ten list
$result = $mysqli->query(
    'SELECT `name`, `nbr_seasons` FROM `stats` ORDER BY `nbr_seasons`
    DESC LIMIT 10'
);
$row    = $result->fetch_all(MYSQLI_NUM);
echo '<table class="table table-striped">';
echo '<thead><tr><th>Namn</th><th>Antal Säsonger</th></tr></thead><tbody>';
foreach ($row as $key => $value) {
    echo '<tr><td>' . $value[0] . '</td><td>' . $value[1] . '</td></tr>';
}
echo '</tbody></table>';
?>
</div></div>
<br>
<div class="row">
<div class="col-md-3">
<h3>Hösten 2012</h3>
<?php
//Get name and attends for all involved autumn 2012
showStatsForSeason('aut2012');
?>
</div>
<div class="col-md-3">
<h3>Våren 2013</h3>
<?php
//Get name and attends for all involved spring 2013
showStatsForSeason('spring2013');
?>
</div>
<div class="col-md-3">
<h3>Hösten 2013</h3>
<?php
//Get name and attends for all involved autumn 2013
showStatsForSeason('aut2013');
?>
</div>
<div class="col-md-3">
<h3>Våren 2014</h3>
<?php
//Get name and attends for all involved spring 2014
showStatsForSeason('spring2014');
?>
</div>
</div>
<div class="row">
<div class="col-md-3">
<h3>Hösten 2014</h3>
<?php
//Get name and attends for all involved autumn 2014
showStatsForSeason('aut2014');
?>
</div>
<div class="col-md-3">
<h3>Våren 2015</h3>
<?php
//Get name and attends for all involved spring 2015
showStatsForSeason('spring2015');
?>
</div>
<div class="col-md-3">
<h3>Hösten 2015</h3>
<?php
//Get name and attends for all involved autumn 2015
showStatsForSeason('aut2015');
?>
</div></div>
</div> <!-- /container -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>