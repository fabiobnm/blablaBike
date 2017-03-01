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
if(isset($_POST['nickname'], $_POST['nome'],$_POST['cognome'], $_POST['dataNascita'],
    $_POST['luogoNascita'], $_POST['sesso'],$_POST['residenza'], $_POST['esperienza'])) {
    $nickname = $_POST['nickname'];
    $nome = $_POST['nome'];
    $cognome= $_POST['cognome'];
    $dataNascita = $_POST['dataNascita'];
    $luogoNascita = $_POST['luogoNascita'];
    $sesso = $_POST['sesso'];
    $residenza = $_POST['residenza'];
    $esperienza = $_POST['esperienza'];// Recupero la password criptata.

    echo "ok fino qui tutto bene";
    if(updateinfo($nickname,$nome,$cognome,$dataNascita,$luogoNascita,$sesso,$residenza,$esperienza,$mysqli) == true)  {
        // Login eseguito
        echo 'Hai modificato i tuoi dati!';
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}