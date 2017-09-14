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
    $risultatoconto=mysqli_query($mysqli, $conto);
    $contodef=mysqli_fetch_array($risultatoconto,MYSQLI_ASSOC);
    $numeroTappa=$contodef['conto'];
    $numero=$numeroTappa+1;
    $nome = strtoupper($_POST['nome']);
    $tipo= $_POST['tipo'];
    $luogo = strtoupper($_POST['Luogo']);
    $lunghezza = $_POST['Lunghezza'];



    echo "ok fino qui tutto bene";

    if(creaTappa($numero,$uscita,$nome,$luogo,$lunghezza,$tipo,$mysqli) == true) {
        // Login eseguito
        header("location: /tappe.php?uscita=$uscita&messaggio=hai inserito tappa");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'ciaoooo';
    echo $uscita;
    echo $nome;
    echo $tipo;
    echo $luogo;
    echo $lunghezza;
}