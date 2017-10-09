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
    $titolo = ($_POST['titolo']);
    $distanza= $_POST['distanza'];
    $dislivello = $_POST['dislivello'];
    $durata=$_POST['durata'];
    $tipologia = $_POST['tipologia'];
    $difficolta = $_POST['difficolta'];
    $note = $_POST['note'];
    $luogo = strtoupper($_POST['luogo']);
    $dataIncontro=$_POST['dataIncontro'];
    $oraIncontro= $_POST['oraIncontro'];
    $visibile = $_POST['visibile'];

    $testo="titolo=$titolo&distanza=$distanza&dislivello=$dislivello&durata=$durata&note=$note&luogo=$luogo&data=$dataIncontro&ora=$oraIncontro";

    if (empty($_POST['organizzatore']) or (!trim($_POST['organizzatore']))){
        header("location: ./creauscita.php?$testo&messaggio0=inserisci organizzatore");
    }else{
        if (empty($_POST['titolo']) or (!trim($_POST['titolo']))){
            header("location: ./creauscita.php?$testo&messaggio1=inserisci titolo");
        }else{if (empty($_POST['distanza'])or(!is_numeric($_POST['distanza']))){
            header("location: ./creauscita.php?$testo&messaggio2=inserisci distanza");
        }else{if (empty($_POST['durata'])or ($_POST['durata'])>8){
            header("location: ./creauscita.php?$testo&messaggio11=inserisci durata");
        }else
            if (empty($_POST['difficolta'])){
                    header("location: ./creauscita.php?$testo&messaggio4=inserisci difficolta");
                }else{if (empty($_POST['note'])){
                    header("location: ./creauscita.php?$testo&messaggio5=inserisci note");
                }else{if (empty($_POST['luogo']) or (!trim($_POST['luogo']))){
                    header("location: ./creauscita.php?$testo&messaggio6=inserisci luogo");
                }else{if (empty($_POST['dataIncontro'])){
                    header("location: ./creauscita.php?$testo&messaggio7=inserisci data");
                }else{
                    if (empty($_POST['oraIncontro'])){
                        header("location: ./creauscita.php?$testo&messaggio8=inserisci orario");
                    }else{if (empty($_POST['dislivello'])or($_POST['dislivello'])>99 ){
                        header("location: ./creauscita.php?$testo&messaggio10=inserisci dislivello <99m");
                    }else


    echo "Problemi con il data base";
    if(creauscita($organizzatore,$titolo,$distanza,$dislivello,$durata,$tipologia,$difficolta,$note,$luogo,$dataIncontro,$oraIncontro,
            $visibile,$mysqli) == true) {

        $iduscita="SELECT ID from uscita WHERE organizzatore='$organizzatore' AND titolo='$titolo' AND
          distanza=$distanza AND dislivello=$dislivello";
        $mysqli->query($iduscita)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $risultatouscita=mysqli_query($mysqli, $iduscita);
        $uscitaID=mysqli_fetch_array($risultatouscita,MYSQLI_ASSOC);
        $ID=$uscitaID['ID'];

        header("location: ./tappe.php?uscita=$ID");
    } else {
        echo 'errore uscita non creata';


        // Login fallito
        //header('Location: ./login.php?error=1');
    }
}}}}}}}}} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}