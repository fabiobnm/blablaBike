<?php

include 'header.php';


sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(login_check($mysqli) == true) {

    $utente = $_SESSION['nikname'];
    $bike = $_GET['ID'];

    echo '<h1>vendi bike</h1>'
    ?>
    <form action="process_annuncio.php" method="post">
        <input type="hidden" value="<?php echo $bike ?>" name="bicicletta">

        <?php if(isset($_GET['titolo'])) {
        $titolo=$_GET['titolo'];?>
        <label>Titolo Annuncio</label> <br><input type="text" name="titolo" value="<?php echo $titolo?>" ><?php if (isset($_GET['messaggio1'])) {
            $messaggio1 = $_GET['messaggio1'];
            echo " <h1 class='erroreros'>$messaggio1</h1>";
        }}else{?><label>Titolo Annuncio</label> <br><input type="text" name="titolo"><?php if (isset($_GET['messaggio1'])) {
            $messaggio1 = $_GET['messaggio1'];
            echo " <h1 class='erroreros'>$messaggio1</h1>";
        }}?><br>

        <?php if(isset($_GET['prezzo'])) {
        $prezzo=$_GET['prezzo'];?>
        <label>prezzo</label> <br><input type="number" name="prezzo" min="1" value="<?php echo $prezzo?>" required> <label>€</label><?php if (isset($_GET['messaggio2'])) {
            $messaggio2 = $_GET['messaggio2'];
            echo " <h1 class='erroreros'>$messaggio2</h1>";
        }}else{?><label>prezzo</label> <br><input type="number" name="prezzo" min="1" required> <label>€</label><?php if (isset($_GET['messaggio2'])) {
            $messaggio2 = $_GET['messaggio2'];
            echo " <h1 class='erroreros'>$messaggio2</h1>";
        }}?><br>

        <?php if(isset($_GET['descrizione'])) {
        $descrizione=$_GET['descrizione'];?>
        <label>Descizione</label> <br><input type="text" name="descrizione" value="<?php echo $descrizione?>" required><?php if (isset($_GET['messaggio3'])) {
            $messaggio3 = $_GET['messaggio3'];
            echo " <h1 class='erroreros'>$messaggio3</h1>";
        }}else{?><label>Descizione</label> <br><input type="text" name="descrizione" required><?php if (isset($_GET['messaggio3'])) {
            $messaggio3 = $_GET['messaggio3'];
            echo " <h1 class='erroreros'>$messaggio3</h1>";
        }}?><br>


        <br>
        <input class="sublog" type="submit" value="VENDI">
    </form>


    <?php


}

else{

    echo "accedi";
}
?>
</div>
</body>
</html>
