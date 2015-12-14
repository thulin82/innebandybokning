<?php
/**
* Book
*
* PHP version 5
*
* @category Book
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
// This week's date
$currentdate = getCalenderInfo('date');
//This week's week nbr
$currentweek = getCalenderInfo('week');
//Nbr of attends for this week
$nbr_of_attends = getNbrOfAttends('1');
//Nbr of not attending for this week
$nbr_of_not_attends = getNbrOfAttends('0');
//Nbr of not answered for this week
$nbr_of_not_answered = getNbrOfAttends('2');
//Is guests enabled?
$enable_guests  = getIsGuestsEnabled();
//Nbr of guests for this week
$nbr_of_guests = getNbrOfGuests();
//Total nbr of attendees for this week (attends+guest)
$total = $nbr_of_guests + $nbr_of_attends;
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
<li class="active"><a href="book.php">
    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Boka</a>
</li>
<li><a href="stats.php">
    <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Statistik</a>
</li>
<li><a href="about.php">
    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Om...</a>
</li>
<?php
$sess_id     = $_SESSION['sess_id'];
if ($sess_id == 2) {
    echo '<li><a href="admin.php">';
    echo '<span class="glyphicon glyphicon-lock" aria-hidden="true">';
    echo '</span> Admin</a></li>';
}
?>
</ul></div></div></div>

<div class="container">
<?php
echo '<h1>Bokningsschema för måndag ' . $currentdate . ' (w' . $currentweek .')';
echo '</h1><br>';
$result = $mysqli->query('SELECT * FROM users ORDER BY id ASC');
$row    = $result->fetch_all(MYSQLI_ASSOC);
$i      = 1;
$j      = 101;
echo '<table class="table table-striped"><thead><tr><th>ID</th><th>Namn</th><th>';
echo 'Kommer?</th><th>&Auml;ndra</th><th>G&auml;ster</th></tr></thead><tbody>';
foreach ($row as $key => $value) {
    echo '<tr><td>' . $value['id'] . '</td><td>' . $value['name'] . '</td><td>';
    if ($value['attend'] == 1) {
        echo '<span class="label label-success">Kommer</span>';
    } else if ($value['attend'] == 2) {
        echo '<span class="label label-warning">Ej Svarat</span>';
    } else {
        echo '<span class="label label-danger">Kommer Ej</span>';
    }
    echo '</td><td><form name="form" method="post"><input type="submit"';
    echo 'name="' . $i . '" value="&Auml;ndra" /></form></td>';
    if (($enable_guests == 1) && ($nbr_of_attends < 8 )) {
        echo '<td><form name="form" method="post"><input type="text" ';
        echo 'class="input-span1" name="' . $j . '" value="';
        echo $value['guests'] . '"/></form></td>';
    } else {
        echo '<td><form name="form" method="post"><input type="text" ';
        echo 'class="input-span1" name="' . $j . '" value="';
        echo $value['guests'] . '" disabled/></form></td>';
    }
    echo '</tr>';
    $i++;
    $j++;
}
echo '</tbody></table>';
?>

<?php

echo '<span class="label label-success">Kommer</span>';
echo ' :  ' . $nbr_of_attends . '<br>';

echo '<span class="label label-danger">Kommer Ej</span>';
echo ' :  ' . $nbr_of_not_attends . '<br>';

echo '<span class="label label-warning">Ej Svarat</span>';
echo ' :  ' . $nbr_of_not_answered . '<br>';

echo '<span class="label label-success">G&auml;ster</span>';
echo ' :  ' . $nbr_of_guests . '<br>';

echo '<h2><span class="label label-success">Totalt</span>';
echo ' :  ' . $total . '</h2><br>';

?>
</div> <!-- /container -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>