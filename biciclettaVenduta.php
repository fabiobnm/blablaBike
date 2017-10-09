<?php
include 'header.php';

sec_session_start();
if(login_check($mysqli) == true) {

    if(isset($_GET['ID'],$_GET['ACQ'],$_GET['PREZ'],$_GET['annuncio'])){
        $ID=$_GET['ID'];
        $ACQ=$_GET['ACQ'];
        $PREZ=$_GET['PREZ'];
        $annuncio=$_GET['annuncio'];
        $proprietario=$_SESSION['nikname'];

        $query="SELECT * from bicicletta WHERE ID=$ID AND proprietario='$proprietario'";
        $mysqli->query($query)
        or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
        $result=mysqli_query($mysqli,$query);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $nome=$row['nome'];
        $tipo=$row['tipo'];
        $marca=$row['marca'];
        $modello=$row['modello'];
        $peso=$row['peso'];
        $ruote=$row['ruote'];
        $annoFab=$row['annoFab'];
        $annoAcq=$row['annoAcq'];
        $colore=$row['colore'];

        if(bikeVenduta($proprietario,$ID,$nome,$tipo,$marca,$modello,$peso,$ruote,$annoFab,$annoAcq,$colore,$ACQ,$PREZ,$mysqli) == true) {
            if(cancellaAnnuncio($annuncio,$mysqli)==true){
                if(cancellapartecipa($ID,$mysqli)==true){

            header("location:./cambioproprietario.php?ID=$ID&ACQ=$ACQ");

        }}} else {
            echo 'errore inserimento';


            // Login fallito
            //header('Location: ./login.php?error=1');
        }
    } else {
        // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
        echo 'Invalid Request';
    }}else 'accedi';