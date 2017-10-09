<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:04
 */

define("HOST", "localhost"); // E' il server a cui ti vuoi connettere.
define("USER", "root"); // E' l'utente con cui ti collegherai al DB.
define("PASSWORD", "nonlaso"); // Password di accesso al DB.
define("DATABASE", "blablabike"); // Nome del database.
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

if($mysqli->connect_errno){?>
<!doctype html>
<html lang="it">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>BlaBlaBike</title>
</head>
<body>



<?php
include 'functions.php'
?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/css/style.css">

<link href="https://fonts.googleapis.com/css?family=Libre+Barcode+39+Text" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ultra" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">



<div class="container">



    <nav class="navbar navbar-default header">
        <div class="container-fluid marg">
            <div class="navbar-header">
                <?php
                sec_session_start();
                if(login_check($mysqli) == true) {     ?>


                    <a class="navbar-brand" href="utente.php">
                        <img alt="Brand" src="img/blablacar-ridesharing-logo-1.svg">
                    </a>

                <?php  }  else {  ?>
                    <a class="navbar-brand" href="index.php">
                        <img alt="Brand" src="img/blablacar-ridesharing-logo-1.svg">
                    </a>


                <?php  } ?>
            </div>
            <?php
            sec_session_start();
            //controllo se sono loggato
            if(login_check($mysqli) == true)
            {

                // controllo se ci sono richieste di amicizie in sospeso
                $utente=$_SESSION['nikname'];
                $amici="SELECT approvato as amici FROM segue WHERE seguitoDa='$utente' && approvato=0 ";
                $mysqli->query($amici)
                or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                $resultS = mysqli_query($mysqli, $queryS);
                $amicizia = mysqli_query($mysqli, $amici);
                $follow = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);
                //controllo se ci sono richieste in mercatino
                $richiestaAcq="SELECT count(*) as conto from richiestaacquisto WHERE  annuncio in (
              SELECT IDannuncio FROM annuncio where venduto!= 1 AND venditore='$utente')";
                $mysqli->query($richiestaAcq)
                or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
                $resultS = mysqli_query($mysqli, $queryS);
                $ric=mysqli_query($mysqli, $richiestaAcq);
                $acquisto = mysqli_fetch_array($ric, MYSQLI_ASSOC);





                ?>
                <a class="navbar-text navbar-right" href="logout.php">Logout</a>
                <a class="navbar-text navbar-right" style="color: dodgerblue" href="profilo.php"><?php echo 'Profilo ',$_SESSION['nikname'];?></a>
                <a class="navbar-text navbar-right" style="color: gold" href="mercatino.php">MERCATINO</a>
                <a class="navbar-text navbar-right" style="color: limegreen" href="visualizzaUscite.php">USCITE</a>

                <?php if(isset($follow['amici'])==true && $follow['amici']==0)
            {//stampo richiesta di amicizia
                ?>  <a class="navbar-text navbar-right" href="visualizzaRichieste.php" style="color: red">RICHIESTA</a>

            <?php } if(isset($acquisto['conto']) ==true && $acquisto['conto']>=1 )
            {  //stampo richiesta mercatino
                ?>

                <a class="navbar-text navbar-right" href="visualAcquRic.php" style="color: red"><?php echo $acquisto['conto'];?>
                    RICHIESTE in mercatino </a>


            <?php         }
            }else
            {    //sezione se non sei loggato
                ?>

                <a class="navbar-text navbar-right" href="signin.php">vuoi iscriverti? Signin</a>
                <a class="navbar-text navbar-right" href="login.php">Login</a>
                <?php
            }  ?>

        </div>
    </nav>
   <?php die("database non risponde connection failed : " .$mysqli->connect_errno );

   echo 'errore 2002: data base disconnesso';
}



// Se ti stai connettendo usando il protocollo TCP/IP, invece di usare un socket UNIX, ricordati di aggiungere il parametro corrispondente al numero di porta.