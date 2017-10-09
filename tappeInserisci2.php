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
if(isset($_POST['uscita'], $_POST['nome'],$_POST['tipo'],$_POST['Lunghezza'],$_POST['Luogo'])) {
    $uscita = ($_POST['uscita']);

    $conto="select COUNT(*) as conto from tappa where uscita=$uscita";
    $mysqli->query($conto)
    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
    $risultatoconto=mysqli_query($mysqli, $conto);
    $contodef=mysqli_fetch_array($risultatoconto,MYSQLI_ASSOC);
    $numeroTappa=$contodef['conto'];
    $numero=$numeroTappa+1;
    $nome = strtoupper($_POST['nome']);
    $tipo= $_POST['tipo'];
    $luogo = strtoupper($_POST['Luogo']);
    $lunghezza = $_POST['Lunghezza'];

    $testo="nome=$nome&Lunghezza=$lunghezza&Luogo=$luogo";

    if (empty($_POST['Lunghezza'])or($_POST['Lunghezza']<0)){
        header("location: ./tappe.php?$testo&uscita=$uscita&messaggio2=inserisci lunghezza positiva");
    }else{

    if (empty($_POST['nome'])or (!trim($_POST['nome']))){
        header("location: ./tappe.php?$testo&uscita=$uscita&messaggio0=inserisci nome");
    }else{if (empty($_POST['tipo'])){
        header("location: ./tappe.php?$testo&uscita=$uscita&messaggio1=inserisci tipo");
    }else{if (empty($_POST['Luogo'])){
        header("location: ./tappe.php?$testo&uscita=$uscita&messaggio2=inserisci luogo");

    }else{if (empty($_POST['Lunghezza'])or($_POST['Lunghezza']<0)){
        header("location: ./tappe.php?$testo&uscita=$uscita&messaggio2=inserisci lunghezza positiva");
    }else



    echo "ok fino qui tutto bene";

    if(creaTappa($numero,$uscita,$nome,$luogo,$lunghezza,$tipo,$mysqli) == true) {
        // Login eseguito
        header("location: ./tappe.php?uscita=$uscita&messaggio=hai inserito tappa");
    } else {
        echo 'problemi database';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
}}}}}else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'errore inserimento tipologia o errore del database torna indietro';
    echo $uscita;
    echo $nome;
    echo $tipo;
    echo $luogo;
    echo $lunghezza;
}