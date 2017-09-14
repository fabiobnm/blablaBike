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
if(isset($_POST['organizzatore'], $_POST['titolo'],$_POST['distanza'], $_POST['dislivello'],$_POST['durata'],
    $_POST['tipologia'],$_POST['difficolta'],$_POST['note'], $_POST['luogo'], $_POST['dataIncontro'], $_POST['oraIncontro'],$_POST['visibile'])) {
    $organizzatore = strtoupper($_POST['organizzatore']);
    $titolo = strtoupper($_POST['titolo']);
    $distanza= $_POST['distanza'];
    $dislivello = $_POST['dislivello'];
    $durata=$_POST['durata'];
    $tipologia = $_POST['tipologia'];
    $difficolta = $_POST['difficolta'];
    $note = $_POST['note'];
    $luogo = strtoupper($_POST['luogo']);
    $dataIncontro=$_POST['dataIncontro'];
    $oraIncontro= $_POST['oraIncontro'];
    $visibile = $_POST['visibile'];// Recupero la password criptata.


    echo "ok fino qui tutto bene";
    if(creauscita($organizzatore,$titolo,$distanza,$dislivello,$durata,$tipologia,$difficolta,$note,$luogo,$dataIncontro,$oraIncontro,
            $visibile,$mysqli) == true) {

        $iduscita="SELECT ID from uscita WHERE organizzatore='$organizzatore' AND titolo='$titolo' AND
          distanza=$distanza AND dislivello=$dislivello";
        $risultatouscita=mysqli_query($mysqli, $iduscita);
        $uscitaID=mysqli_fetch_array($risultatouscita,MYSQLI_ASSOC);
        $ID=$uscitaID['ID'];

        header("location: /tappe.php?uscita=$ID");
    } else {
        echo 'pollo';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}