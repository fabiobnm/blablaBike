
<?php
include 'db_connect.php';
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

<html><body  >
<div class="container">



    <nav class="navbar navbar-default" >
        <div class="container-fluid" style="margin-top: 29px">
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
             $amicizia = mysqli_query($mysqli, $amici);
             $follow = mysqli_fetch_array($amicizia, MYSQLI_ASSOC);
             //controllo se ci sono richieste in mercatino
             $richiestaAcq="SELECT count(*) as conto from richiestaacquisto WHERE  annuncio in (
              SELECT IDannuncio FROM annuncio where venduto!= 1 AND venditore='$utente')";
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
             <a class="navbar-text navbar-right" style="color: gold; font: bold"  href="mercatino.php">MERCATINO</a>
       <?php
    }  ?>

        </div>
    </nav>