<?php
/**
* Index
*
* PHP version 7
*
* @category Index
* @package  Innebandybokning
* @author   Markus Thulin <macky_b@hotmail.com>
* @license  http://www.opensource.org/licenses/mit-license.php MIT
* @link     https://github.com/thulin82/innebandybokning
*/

require 'config.php';

//Login
if (isset($_POST['submit'])) {
    $clean  = new Functions();
    $_POST  = $clean->sanitize($_POST);
    $passwd = filter_var($_POST['passwd'], FILTER_SANITIZE_STRING);
    $user   = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
    $query  = 'SELECT id, password_hash FROM password WHERE user=?';
    $result = $db->executeQuery($query, array($user));
 
    // Password check
    if (password_verify($passwd, $result[0]->password_hash)) {
        $_SESSION['sess_id']   = $row['id'];
        $_SESSION['sess_user'] = $user;
        header('Location: book.php');
        exit;
    } else {
        header('Location: index.php?badlogin=');
        exit;
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
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
<link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/signin.css" rel="stylesheet">

<!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
<!--WARNING: Respond.js doesn't work if you view the page via file://-->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="container">
<?php
// If session not set show login form
if (!isset($_SESSION['sess_user'])) {
    // Show error message when bad login occurs
    if (isset($_GET['badlogin'])) {
        echo "Wrong username & password<br>\n";
        echo "Please try again!\n";
    }
    ?>

<form class="form-signin">
<h2 class="logo-login">Innebandy</h2>
</form>
<form action="index.php" class="form-signin" method="post">
<div class="form-group">
<input type="text" value="user" class="form-control"
       name="user" placeholder="User">
</div>
<div class="form-group">
<input type="password" class="form-control" name="passwd"
       placeholder="Password" autofocus>
</div>
<input type="submit" class="btn btn-lg btn-primary btn-block"
       name="submit" value="Logga in">
</form>

    <?php
} else {
    ?>
<form class="form-signin">
<input type="button" value="Logga ut"
       class="btn btn-lg btn-primary btn-block btn-danger"
       name="logout" onclick="location.href='index.php?logout='">
</form>
<br>
<div class="back-to-book-button">
<a href="book.php" class="btn btn-lg btn-primary btn-block"
   role="button">Tillbaka till Bokning</a>
</div>
    <?php
}
?> 

</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>