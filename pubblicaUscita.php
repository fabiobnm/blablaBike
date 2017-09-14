<?php

include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura


$nickname=$_SESSION['nikname'];
$uscita=$_GET['uscita'];


if(pubblicaUscita($nickname,$uscita,$mysqli) == true) {
    // Login eseguito
    header("location: /visualizzaUscite.php?messaggio=nuova uscita creata");

} else {
    echo 'pollo';


    // Login fallito
    //header('Location: ./login.php?error=1');
}
