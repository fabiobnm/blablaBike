<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {

// Inserisci qui il contenuto delle tue pagine!
    echo 'sei dentro';

} else {

    ?>


        <a href="index.php">


            <img src="img/blablacar-ridesharing-logo-1.svg" alt="carhhgddf" style="width:254px;height:228px;"></a>



        <form action="processSingProva.php" method="post">

            <label>Nickname</label><br><input type="text" name="nickname" ><br>
            <label>Indirizzo e-mail</label><br> <input type="text" name="email"><br>
            <label>Password</label> <br> <input type="password" name="password"><br>
            <br>
    <input style="background: lemonchiffon" type="submit"value="ISCRIVITI">

            <?php  if(isset($_GET['error'])) {
                $errore = $_GET['error'];
                echo " <h1>$errore</h1>" ;
            }?>
</form>




<?php
}