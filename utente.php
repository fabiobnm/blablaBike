<?php
include 'header.php';

?>  <body style="background:bisque">

</body>
<?php
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];

    ?>
    <h1 style="text-align: center">Utente</h1>


    <?php
   ?>  <div class="thumbnail testFlo" style="border-radius: 50px; background-color: gold; width: 50%">
    <form action="ricercautenti.php" method="post">
        <h3 style="text-align: center;margin-top: 11px">Cerca Utente:<input type="text" style="border-radius: 30px" name="ricercautente" placeholder=" nickname">
            <input style="border-radius: 30px" type="submit" value="invia"></h3>
    </form>
        <form action="trovautenti.php" method="post">
        <h3 style="text-align: center;">Trova Utente:<input type="text" style="border-radius: 30px" name="trovautente" placeholder=" città">
            <input style="border-radius: 30px" type="submit" value="invia"></h3>
    </form></div>
<div class="thumbnail testFlo" style="border-radius: 50px; background-color: orangered; width: 50%">
    <a href="garage.php"><h3 style="text-align: center;margin-top: 40px">Vai al tuo Garage</h3></a></div>
    <div class="thumbnail testFlo" style="border-radius: 50px; background-color: deepskyblue; width: 50%">
        <a href="creauscita.php"><h3 style="text-align: center;margin-top: 40px">Crea una nuova Uscita!!</h3></a></div>
       <div class="thumbnail testFlo" style="border-radius: 50px; background-color: darkviolet; width: 50%">
           <a href="usciteACuiPartecipi.php"><h3 style="text-align: center;margin-top: 40px">Le tue Uscite</h3></a></div>
      <div class="thumbnail testFlo" style="border-radius: 50px; background-color: limegreen; width: 50%">
          <a href="visualizzaUscite.php"><h3 style="text-align: center;margin-top: 40px">visualizza tutte le Uscite!!</h3></a></div>
        <div class="thumbnail testFlo" style="border-radius: 50px; background-color: blue; width: 50%">
     <?php
     $conto = "SELECT count(*) as totale FROM informazioni WHERE nickname='$nickname'";
     $info = mysqli_query($mysqli, $conto);
     $stampa = mysqli_fetch_array($info, MYSQLI_ASSOC);

     if($stampa['totale']==1){
     ?>
         <a href="info.php"><h3 style="text-align: center;margin-top: 40px">Modifica le tue informazioni</h3></a>
     <?php } else {
         ?>
         <a href="info.php"><h3 style="text-align: center;margin-top: 40px">Inserisci le tue informazioni</h3></a>
     <?php }
     ?></div>





    <?php  if(isset($_GET['error'])) {
        $errore = $_GET['error'];
        echo " <h1>$errore</h1>" ;
    }?>
    <?php  if(isset($_GET['messaggio'])) {
        $messaggio = $_GET['messaggio'];
        echo " <h1 style='text-align: center'>$messaggio</h1>" ;
    }?>
<?php

} else {

    echo accedi;?>  <a href="login.php">Login</a><?php
}