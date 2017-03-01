<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:46
 */
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_POST['nickname'])) {
    $ricerca = $_POST['nickname'];


    if(ricercautenti($nickname, $mysqli) == true) {
        // Login eseguito
        echo 'Success: sei loggato!';
        ?>
        <a href="info.php">inserisci info</a>

        <?php
    } else {
        echo 'non sei ancora registrato';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}