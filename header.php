
<?php
include 'db_connect.php';
include 'functions.php'
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link rel="stylesheet" type="text/css" href="/css/style.css">

<html><body >
<div class="container">



    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="login.php">
                    <img alt="Brand" src="img/blablacar-ridesharing-logo-1.svg">
                </a>
            </div>
         <?php
         sec_session_start();
         if(login_check($mysqli) == true) {                         ?>
            <a class="navbar-text navbar-right" href="singin.php">suca</a>
            <a class="navbar-text navbar-right" href="login.php">ciao</a>

<?php   }else{ ?>
            <a class="navbar-text navbar-right" href="singin.php">vuoi iscriverti? singin</a>
            <a class="navbar-text navbar-right" href="login.php">Login</a>
       <?php     }  ?>

        </div>
    </nav>