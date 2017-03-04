<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];

    ?>
    <h1>GARAGE</h1>

    <a href="insertbike.php">Inserisci una nuova Bike in Garage</a>
    <?php


// Inserisci qui il contenuto delle tue pagine!

} else {

    echo accedicazzo;?>  <a href="login.php">Login</a><?php
}