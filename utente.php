<?php
include 'header.php';

?>
<?php
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];

    ?>
    <h1 class="center t70">Home Page</h1>


    <?php
   ?>  <div class="thumbnail testFlo marginBox gold">
    <form action="ricercautenti.php" method="post">
        <h6 class="center mar11">Cerca Utente:<input type="text" class="rad30" name="ricercautente" placeholder=" nickname">
            <input class="rad30" type="submit" value="invia"></h6>
    </form>
        <form action="trovautenti.php" method="post">
        <h6 class="center">Trova Utente:<input type="text" class="rad30" name="trovautente" placeholder="citta">
            <input class="rad30" type="submit" value="invia"></h6>
    </form></div>
<div class="thumbnail testFlo marginBox orange">
    <a href="garage.php"><h3 class="cenmar40">Vai al tuo Garage</h3></a></div>
    <div class="thumbnail testFlo marginBox blu">
        <a href="creauscita.php"><h3 class="cenmar40">Crea una nuova Uscita!!</h3></a></div>
       <div class="thumbnail testFlo marginBox darkv">
           <a href="usciteACuiPartecipi.php"><h3 class="cenmar40">Le tue Uscite</h3></a></div>
      <div class="thumbnail testFlo marginBox lime">
          <a href="visualizzaUscite.php"><h3 class="cenmar40">visualizza tutte le Uscite!!</h3></a></div>
        <div class="thumbnail testFlo marginBox bleu">
     <?php
     $conto = "SELECT count(*) as totale FROM informazioni WHERE nickname='$nickname'";
     $mysqli->query($conto)
     or die("Impossibile eseguire query. <br> Codice errore ". $mysqli->errno .": ". $mysqli->error ."<br>");
     $info = mysqli_query($mysqli, $conto);
     $stampa = mysqli_fetch_array($info, MYSQLI_ASSOC);

     if($stampa['totale']==1){
     ?>
         <a href="info.php"><h3 class="cenmar40">Modifica le tue informazioni</h3></a>
     <?php } else {
         ?>
         <a href="info.php"><h3 class="cenmar40">Inserisci le tue informazioni</h3></a>
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

    echo "accedi";?>  <a href="login.php">Login</a><?php
}?>
</div>
</body>
</html>

