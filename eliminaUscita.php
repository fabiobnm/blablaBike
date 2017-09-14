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
if(isset($_SESSION['nikname'],$_GET['ID'])) {
    $utente = $_SESSION['nikname'];
    $uscita=$_GET['ID'];

    echo "ok fino qui tutto benerererere";
    if(eliminaUSCITA($utente,$uscita,$mysqli) == true) {
        // Login eseguito
        header("location: /profilo.php?messaggio=hai cancellato un'Uscita");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}