<?php
/**
* Book
*
* PHP version 7
*
* @category Book
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/
require 'config.php';


//$nbr_of_users = getNbrOfUsers(); //Total users in database
$nbr_of_users = $sql->getNbrOfUsers();

// I session set = user logged in
if (!isset($_SESSION['sess_user'])) {
    header('Location: index.php');
    exit;
}
// If 1-15, change attending status
/*
for ($i = 1; $i <= $nbr_of_users; $i++) {
    if (isset($_POST[$i])) {
        $query = sprintf(
            'UPDATE users SET attend = IF(attend=1, 0, 1) WHERE id =%d', $i
        );
        $mysqli->query($query);
    }
}
// If 101-115, change attending guests
for ($j = 101; $j <= (101 + $nbr_of_users); $j++) {
    if (isset($_POST[$j])) {
        $clean = new Functions();
        $t     = $clean->singleInt($_POST[$j]);
        $query = sprintf(
            'UPDATE users SET guests = %d WHERE id=%d', $t, ($j-100)
        );
        $mysqli->query($query);
    }
}
// If 1001-1015, change coop status
for ($k = 1001; $k <= (1001 + $nbr_of_users); $k++) {
    if (isset($_POST[$k])) {
        if ($_POST[$k] == 'Kör Själv') {
            $query = sprintf(
                'UPDATE users SET coop = 0 WHERE id =%d', ($k-1000)
            );
            $mysqli->query($query);
        } else if ($_POST[$k] == 'Vill Åka ') {
            $query = sprintf(
                'UPDATE users SET coop = 1 WHERE id =%d', ($k-1000)
            );
            $mysqli->query($query);
        } else {
            $query = sprintf(
                'UPDATE users SET coop = 2 WHERE id =%d', ($k-1000)
            );
            $mysqli->query($query);
        }
    }
}
*/
$currentdate         = $sql->getCalenderInfo('date'); // This week's date
$currentweek         = $sql->getCalenderInfo('week'); //This week's week nbr
$nbr_of_attends      = $sql->getNbrOfAttends('1'); //Nbr of attends for this week
$nbr_of_not_attends  = $sql->getNbrOfAttends('0'); //Nbr of not attending for this week
$nbr_of_not_answered = $sql->getNbrOfAttends('2'); //Nbr of not answered for this week
$enable_guests       = $sql->getIsGuestsEnabled(); //Is guests enabled?
$nbr_of_guests       = $sql->getNbrOfGuests(); //Nbr of guests for this week
$total               = $nbr_of_guests + $nbr_of_attends; //Total nbr of attendees
$sess_id             = $_SESSION['sess_id']; //Session-ID
?>

<!DOCTYPE html>
<html lang="sv">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Innebandybokning</title>

<!-- Bootstrap core CSS -->
<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/custom_style.css" rel="stylesheet">

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
echo'<div class="alert alert-warning" role="alert">';
echo '<strong>Info!</strong> Hela sidan är ombyggd från grunden, ';
echo 'både front- och backend. Om den uppför sig konstigt, hör av er!</div>';
$result = $db->executeQuery('SELECT * FROM users ORDER BY id ASC');
$i      = 1;
$j      = 101;
$k      = 1001;
echo '<table class="table table-striped"><thead><tr><th>ID</th><th>Namn</th><th>';
echo 'Kommer?</th><th>&Auml;ndra</th><th>G&auml;ster</th>';
echo '<th>Sam&aring;kning</th></tr></thead><tbody>';
foreach ($result as $key => $value) {
    echo '<tr><td>' . $value->id . '</td><td>' . $value->name . '</td><td>';
    if ($value->attend == 1) {
        echo '<span class="label label-success">Kommer</span>';
    } else if ($value->attend == 2) {
        echo '<span class="label label-warning">Ej Svarat</span>';
    } else {
        echo '<span class="label label-danger">Kommer Ej</span>';
    }
    echo '</td><td><form name="form" method="post">';
    echo '<input class="btn btn-default btn-sm" type="submit"';
    echo 'name="' . $i . '" value="&Auml;ndra" /></form></td>';
    if (($enable_guests == 1) && ($nbr_of_attends < 8 )) {
        echo '<td><form name="form" class="input-sm" ';
        echo 'method="post"><input type="text" ';
        echo 'class="input-span1" name="' . $j . '" value="';
        echo $value->guests . '"/></form></td>';
    } else {
        echo '<td><form name="form" class="input-sm" ';
        echo 'method="post"><input type="text" ';
        echo 'class="input-span1" name="' . $j . '" value="';
        echo $value->guests . '" disabled/></form></td>';
    }
    if ($value->coop == 1) {
        echo '<td><form name="form" method="post">';
        echo '<input class="btn btn-success btn-sm" type="submit"';
        echo 'name="' . $k . '" value="Kör Andra" /></form></td>';
    } else if ($value->coop == 2) {
        echo '<td><form name="form" method="post">';
        echo '<input class="btn btn-primary btn-sm" type="submit"';
        echo 'name="' . $k . '" value="Kör Själv" /></form></td>';
    } else {
        echo '<td><form name="form" method="post">';
        echo '<input class="btn btn-info btn-sm" type="submit"';
        echo 'name="' . $k . '" value="Vill Åka " /></form></td>';
    }
    echo '</tr>';
    $i++;
    $j++;
    $k++;
}
echo '</tbody></table>';
echo '<span class="label label-success">Kommer</span>';
echo ' :  ' . $nbr_of_attends . '<br>';
echo '<span class="label label-danger">Kommer Ej</span>';
echo ' :  ' . $nbr_of_not_attends . '<br>';
echo '<span class="label label-warning">Ej Svarat</span>';
echo ' :  ' . $nbr_of_not_answered . '<br>';
echo '<span class="label label-info">G&auml;ster</span>';
echo ' :  ' . $nbr_of_guests . '<br>';
echo '<h2><span class="label label-success">Totalt</span>';
echo ' :  ' . $total . '</h2>';
?>
</div> <!-- /container -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/custom_js.js"></script>
</body>
</html>