<?php
/**
* Admin
*
* PHP version 5
*
* @category Admin
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
session_start();
 
require 'connect.php';
require 'src/Functions.php';

// I session set = user logged in
if ((!isset($_SESSION['sess_user'])) || ($_SESSION['sess_id'] == 1)) {
    header('Location: index.php');
    exit;
}
// Reset attendees
if (isset($_POST['reset'])) {
    $mysqli->query('UPDATE users SET attend = 2');
}
//Toggle enable_guests
if (isset($_POST['guests'])) {
    $mysqli->query(
        'UPDATE variables SET value = IF(value=1, 0, 1)
        WHERE name="enable_guests"'
    );
}
// Reset coop
if (isset($_POST['coop'])) {
    $mysqli->query('UPDATE users SET coop = 2');
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

<a class="navbar-brand">Innebandybokning</a>
</div>
<div class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="index.php?logout=">
    <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logga Ut</a>
</li>
<li><a href="book.php">
    <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Boka</a>
</li>
<li><a href="stats.php">
    <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Statistik</a>
</li>
<li><a href="about.php">
    <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Om...</a>
</li>
<?php
$sess_id = $_SESSION['sess_id'];
if ($sess_id == 2) {
    echo '<li class="active"><a href="admin.php">';
    echo '<span class="glyphicon glyphicon-lock" aria-hidden="true">';
    echo '</span> Admin</a></li>';
}
?>
</ul></div></div></div>

<div class="container">

<h1>Admin</h1>

<?php
$sess_id = $_SESSION['sess_id'];
if ($sess_id == 2) {
    echo 'Du är inloggad som admin<br>';
    echo '<div class="row">';
    echo '<div class="col-md-4">';
    echo '<h3>Ej svarat denna vecka:</h3>';
    $result = $mysqli->query(
        'SELECT DISTINCT name, mail
        FROM users WHERE attend="2" ORDER BY id ASC'
    );
    $row    = $result->fetch_all(MYSQLI_ASSOC);
    foreach ($row as $key => $value) {
        echo $value['name'] . ' (' . $value['mail'] . ')' . '<br>';
    }
    echo '</div><div class="col-md-4">';
    echo '<h3>Gäster:</h3>';
    $result = $mysqli->query(
        'SELECT value FROM variables WHERE name="enable_guests"'
    );
    $row    = $result->fetch_all(MYSQLI_ASSOC);
    if (($row[0]['value']) == 0 ) {
        echo 'Ej tillgängligt: <span class="glyphicon glyphicon-remove" ';
        echo 'aria-hidden="true"></span>';
    } else {
        echo 'Tillgängligt: <span class="glyphicon glyphicon-ok" ';
        echo 'aria-hidden="true"></span>';
    }
    echo '</div><div class="col-md-4">';
    echo '<h3>Admin-verktyg:</h3>';
    echo '<form name="form" method="post">';
    echo '<input class="btn btn-danger" type="submit"';
    echo 'name="reset" value="Reset Attendees" /></form><br>';
    echo '<form name="form" method="post">';
    echo '<input class="btn btn-warning" type="submit"';
    echo 'name="guests" value="Toggle Guests" /></form><br>';
    echo '<form name="form" method="post">';
    echo '<input class="btn btn-info" type="submit"';
    echo 'name="coop" value="Reset Coop" /></form>';
    echo '</div></div>';
}
?>

</div> <!-- /container -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>