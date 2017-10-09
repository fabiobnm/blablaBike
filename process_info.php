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
    $_POST['luogoNascita'],$_POST['residenza'])){
    $nickname = strtoupper($_POST['nickname']);
    $nome = strtolower($_POST['nome']);
    $cognome=strtolower( $_POST['cognome']);
    $dataNascita = $_POST['dataNascita'];
    $luogoNascita = strtolower($_POST['luogoNascita']);
    $sesso = $_POST['sesso'];
    $residenza = strtolower($_POST['residenza']);
    $esperienza = $_POST['esperienza'];// Recupero la password criptata.

    $testo="nome=$nome&cognome=$cognome&data=$dataNascita&luogo=$luogoNascita&residenza=$residenza";

    if (empty($_POST['nome'])or (!trim($_POST['nome']))){
        header("location: ./info.php?$testo&messaggio0=inserisci nome");
    }else{if (empty($_POST['cognome']) or (!trim($_POST['cognome']))){
        header("location: ./info.php?$testo&messaggio1=inserisci cognome");
    }else{if (empty($_POST['dataNascita'])or (!trim($_POST['dataNascita']))){
        header("location: ./info.php?$testo&messaggio2=inserisci data");
    }else{if (empty($_POST['luogoNascita']) or (!trim($_POST['luogoNascita']))){
        header("location: ./info.php?$testo&messaggio3=inserisci luogo");
    }else{if (empty($_POST['residenza']) or (!trim($_POST['residenza']))){
        header("location: ./info.php?$testo&messaggio4=inserisci residenza");
    }else{if (empty($_POST['sesso'])){
        header("location: ./info.php?$testo&messaggio5=inserisci sesso");
    }else{if (empty($_POST['esperienza'])){
        header("location: ./info.php?$testo&messaggio6=inserisci esperienza");
    }else
    echo "ok fino qui tutto bene";
    if(info($nickname,$nome,$cognome,$dataNascita,$luogoNascita,$sesso,$residenza,$esperienza,$mysqli) == true) {
        // Login eseguito
        header("location: ./utente.php?messaggio=hai inserito le tue info");
        echo 'Hai inserito i tuoi dati!';
    } else {
        echo 'errore inserimento';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
}}}}}}} else {
    // L variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'errore al database ho errore di inserimento torna alla pagina precedente
    ';
}