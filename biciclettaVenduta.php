<?php
include 'header.php';

?>
    <body style="background: gold"></body>
<?php

sec_session_start();
if(login_check($mysqli) == true) {

    if(isset($_GET['ID'])){
        $ID=$_GET['ID'];
        $proprietario=$_SESSION['nikname'];

        $query="SELECT * from bicicletta WHERE ID=$ID AND proprietario='$proprietario'";
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

        if(bikeVenduta($proprietario,$ID,$nome,$tipo,$marca,$modello,$peso,$ruote,$annoFab,$annoAcq,$colore,$mysqli) == true) {

            header("location: /eliminaBike.php?ID=$ID");

        } else {
            echo 'pollo';


            // Login fallito
            //header('Location: ./login.php?error=1');
        }
    } else {
        // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
        echo 'Invalid Request';
    }}else 'accedi';