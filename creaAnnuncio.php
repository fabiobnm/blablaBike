<?php

include 'header.php';


sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(login_check($mysqli) == true) {

    $utente = $_SESSION['nikname'];
    $bike = $_GET['ID'];

    echo '<h1>vendi bike</h1>'
    ?>
    <form action="process_annuncio.php" method="post" style="align-content: center">
        <input type="hidden" value="<?php echo $bike ?>" name="bicicletta" readonly>

        <label>Titolo Annuncio</label> <br><input type="text" name="titolo" value="" required><br>
        <label>prezzo</label> <br><input type="number" name="prezzo" min="1" required> <label>€</label> <br>
        <label>Descizione</label> <br><input type="text" name="descrizione" ><br>


        <br>
        <input style="background: lemonchiffon" type="submit" value="VENDI">
    </form>


    <?php


}

else{

    echo "accedi";
}

