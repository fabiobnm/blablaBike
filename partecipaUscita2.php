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

         $bicicletta=$_GET['bike'];
         $uscita=$_GET['ID'];
         $partecipante=$_SESSION['nikname'];
        $_SESSION["IDuscita"]=null;
        $_SESSION["tipoUscita"]=null;

echo $partecipante,$bicicletta,$uscita;
    if(partecipaUscita($partecipante,$bicicletta,$uscita,$mysqli) == true) {
        // Login eseguito
        header("location: ./usciteACuiPartecipi.php?messaggio=ti sei iscritto all'uscita");
        echo $partecipante,$bicicletta,$uscita;
    } else {
        echo 'errore inserimento';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
