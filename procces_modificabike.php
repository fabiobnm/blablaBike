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
if(isset($_POST['ID'],$_POST['proprietario'], $_POST['nome'],$_POST['tipo'],$_POST['marca'],$_POST['modello'],
    $_POST['ruote'],$_POST['annoFab'], $_POST['annoAcq'],$_POST['colore'])) {
    $proprietario = strtoupper($_POST['proprietario']);
    $nome = strtoupper($_POST['nome']);
    $tipo= $_POST['tipo'];
    $marca = strtoupper($_POST['marca']);
    $modello = strtoupper($_POST['modello']);
    $ruote = $_POST['ruote'];
    $annoFab = $_POST['annoFab'];
    $annoAcq = $_POST['annoAcq'];
    $colore = $_POST['colore'];
    $ID=$_POST['ID'];

    if (empty($_POST['nome']) or (!trim($_POST['nome']))){
        header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio1=inserisci nome");
    }else{
        if (empty($_POST['modello'])){
            header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio3=inserisci modello");

        }else{if (empty($_POST['ruote'])){
            header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio4=inserisci ruote");
        }else{
            if((empty($_POST['marca']))){
                header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio7=inserisci marca");
            }else
                if (empty($_POST['annoFab'])or ($_POST['annoFab']<1900) or ($_POST['annoFab']>2017)){
                    header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio5=inserisci anno");
                }else{if (empty($_POST['annoAcq'])){
                    header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio6=inserisci anno");
                }else{if($annoAcq<$annoFab){
                    header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio2=anno acquisto deve essere minore dell'anno di produzione");
                } else{if (empty($_POST['colore']) or (!trim($_POST['colore']))){
                    header("location: ./newmodificabike.php?ID=$ID&tipo=0&messaggio12=inserisci colore");
                }else
                    echo "ok fino qui tutto bene";

    if(updatebike($proprietario,$nome,$tipo,$marca,$modello,$ruote,$annoFab,$annoAcq,$colore,$mysqli) == true) {
        // Login eseguito
        header("location: ./garage.php?messaggio=hai modificato una bike");
    } else {
        echo 'errore modifica';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
}}}}}}} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.

    echo $_POST['ID'];
    echo 'Invalid Requesteeeee';
}