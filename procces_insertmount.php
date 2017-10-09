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
if(isset($_POST['proprietario'], $_POST['nome'],$_POST['tipo'],$_POST['marca'],$_POST['newmarca'],$_POST['modello'],
    $_POST['annoFab'], $_POST['annoAcq'],$_POST['colore'])) {

    $proprietario = strtoupper($_POST['proprietario']);

    $nome = strtoupper($_POST['nome']);
    $tipo= 0;
    if($_POST['newmarca']!=''){
        $marca =strtoupper($_POST['newmarca']);
    }else{
        $marca = $_POST['marca'];}

    $modello = strtoupper($_POST['modello']);

    $peso=0;
    $ruote = $_POST['ruote'];

    $annoFab = $_POST['annoFab'];

    $annoAcq = $_POST['annoAcq'];

    $colore = $_POST['colore'];// Recupero la password criptata.

    $testo="nome=$nome&modello=$modello&marca=$marca&annoFab=$annoFab&annoAcq=$annoAcq&colore=$colore";

    if (empty($_POST['nome']) or (!trim($_POST['nome']))){
        header("location: ./insertBikeMount.php?$testo&messaggio1=inserisci nome");
    }else{
        if (empty($_POST['modello']) or (!trim($_POST['modello']))){
            header("location: ./insertBikeMount.php?$testo&messaggio3=inserisci modello");

        }else{if (empty($_POST['ruote'])){
            header("location: ./insertBikeMount.php?$testo&messaggio4=inserisci ruote");
        }else{
            if((empty($_POST['marca'])or (!trim($_POST['marca'])) ) and (empty($_POST['newmarca'])or (!trim($_POST['newmarca'])))){
                header("location: ./insertBikeMount.php?$testo&messaggio7=inserisci marca");
            }else
                if (empty($_POST['annoFab'])or ($_POST['annoFab']<1900) or ($_POST['annoFab']>2017)or(!is_numeric($_POST['annoFab']))){
                    header("location: ./insertBikeMount.php?$testo&messaggio5=inserisci anno");
                }else{if (empty($_POST['annoAcq'])or ($_POST['annoFab']>2017)or(!is_numeric($_POST['annoAcq']))){
                    header("location: ./insertBikeMount.php?$testo&messaggio6=inserisci anno");
                }else{if($annoAcq<$annoFab){
                    header("location: ./insertBikeMount.php?$testo&messaggio2=anno acquisto deve essere minore dell'anno di produzione");
                } else{if (empty($_POST['colore']) or (!trim($_POST['colore']))){
                    header("location: ./insertBikeMount.php?$testo&messaggio12=inserisci colore");
                }else

                    $query="INSERT INTO bicicletta (proprietario,nome,tipo,marca,modello,peso,ruote,annoFab,annoAcq,
     colore)VALUES('$proprietario','$nome',$tipo,'$marca','$modello',$peso,$ruote,'$annoFab','$annoAcq','$colore')";

                    $mysqli->query($query)
                    or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                    header("location: ./garage.php?messaggio=hai inserito una bike");

                   /* if(insertbike($proprietario,$nome,$tipo,$marca,$modello,$peso,$ruote,$annoFab,$annoAcq,$colore,$mysqli) == true) {
                        // Login eseguito
                        header("location: ./garage.php?messaggio=hai inserito una bike");
                    } else {

                        echo 'errore inserimento';


                        // Login fallito
                        //header('Location: ./login.php?error=1');
                    }*/
                }}}}}}}else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
    echo 'Invalid Request';
}