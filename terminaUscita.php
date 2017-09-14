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
if(login_check($mysqli) == true) {
    $utente=$_SESSION['nikname'];
    $uscita = $_GET['uscita'];// Recupero la password criptata.



    echo "ok fino qui tutto bene";

    if(fineUscita($uscita,$utente,$mysqli) == true) {
        // Login eseguito
        header("location: /utente.php?messaggio=uscita terminata");
    }  } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
