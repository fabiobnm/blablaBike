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
if(isset($_POST['uscita'], $_POST['visibile'])){
    $uscita = $_POST['uscita'];
    $visibile= $_POST['visibile'];
    $organizzatore= $_SESSION['nikname'];

    echo "ok fino qui tutto bene";
    if(modificaVisibilita($uscita,$visibile,$organizzatore,$mysqli) == true) {

        header("location: /profilo.php?messaggio=hai modificato un'usicta");

    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo $_POST['nickname'],$_POST['nome'],$_POST['cognome'],$_POST['dataNascita'],$_POST['luogoNascita'],$_POST['sesso'],
    $_POST['residenza'],$_POST['esperienza'];
}