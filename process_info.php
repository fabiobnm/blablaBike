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
    $_POST['luogoNascita'], $_POST['sesso'],$_POST['residenza'], $_POST['esperienza'])){
    $nickname = strtoupper($_POST['nickname']);
    $nome = strtolower($_POST['nome']);
    $cognome=strtolower( $_POST['cognome']);
    $dataNascita = $_POST['dataNascita'];
    $luogoNascita = strtolower($_POST['luogoNascita']);
    $sesso = $_POST['sesso'];
    $residenza = strtolower($_POST['residenza']);
    $esperienza = $_POST['esperienza'];// Recupero la password criptata.

    echo "ok fino qui tutto bene";
    if(info($nickname,$nome,$cognome,$dataNascita,$luogoNascita,$sesso,$residenza,$esperienza,$mysqli) == true) {
        // Login eseguito
        header("location: /utente.php?messaggio=hai inserito le tue info");
        echo 'Hai inserito i tuoi dati!';
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