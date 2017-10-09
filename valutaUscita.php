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
if(isset($_POST['uscita'], $_POST['valutazione'])) {
    $utente=$_SESSION['nikname'];
    $valutazione = $_POST['valutazione'];
    $usicta = $_POST['uscita'];// Recupero la password criptata.

    if (empty($_POST['valutazione'])or($_POST['valutazione']<1)or ($_POST['valutazione']>10)){
        header("location: ./usciteACuiPartecipi.php?messaggio0=inserisci valutazione");
    }else{
        if (empty($_POST['uscita'])){
            header("location: ./creauscita.php?messaggio1=numero uscita non presente");
        }else


    echo "ok fino qui tutto bene";

    if(valutaUscita($usicta,$utente,$valutazione,$mysqli) == true) {
        // Login eseguito
        header("location: ./utente.php?messaggio=hai inserito valutazione");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
}} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}