<?php
include 'header.php';
include 'db_connect.php';
include 'functions.php';

sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];

    ?>

    <form action="process_info.php" method="post">
        cerca utente:<input type="text"  name="nickname"><br>

        <input type="submit">
    </form>


    <?php
// Inserisci qui il contenuto delle tue pagine!

} else {


}