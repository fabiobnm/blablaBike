<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {



    $nickname = $_SESSION['nikname'];
     $currentdate=date ('d/m/y');
    echo '<h1>crea uscita</h1>'
    ?>
    <form action="procces_creauscita.php" method="post">

        <label>organizzatore</label><br> <input type= "text" value="<?php echo $nickname ?>" name="organizzatore" required readonly><?php if (isset($_GET['messaggio0'])) {
            $messaggio0 = $_GET['messaggio0'];
            echo " <h1 class='erroreros' '>$messaggio0</h1>";
        }?><br>


    <?php if(isset($_GET['titolo'])) {
        $titolo=$_GET['titolo'];?>
        <label>titolo</label> <br><input type="text" name="titolo" value="<?php echo $titolo?>" ><?php if (isset($_GET['messaggio1'])) {
            $messaggio1 = $_GET['messaggio1'];
            echo " <h1 class='erroreros'>$messaggio1</h1>";
        }}else{?><label>titolo</label> <br><input type="text" name="titolo"  ><?php if (isset($_GET['messaggio1'])) {
        $messaggio1 = $_GET['messaggio1'];
        echo " <h1 class='erroreros'>$messaggio1</h1>";
    }}?><br>

    <?php if(isset($_GET['distanza'])) {
        $distanza=$_GET['distanza'];?>
        <label>distanza in km </label><br><input type="number" name="distanza" value="<?php echo $distanza?>" required><?php if (isset($_GET['messaggio2'])) {
            $messaggio2= $_GET['messaggio2'];
            echo " <h1 class='erroreros'>$messaggio2</h1>";
        }}else{?><label>distanza in km </label><br><input type="number" name="distanza" required><?php if (isset($_GET['messaggio2'])) {
        $messaggio2= $_GET['messaggio2'];
        echo " <h1 class='erroreros'>$messaggio2</h1>";
    }}?><br>

    <?php if(isset($_GET['dislivello'])) {
        $dislivello=$_GET['dislivello'];?>
        <label>dislivello in metri</label> <br><input type="number" name="dislivello" max="99" value="<?php echo $dislivello?>" required><?php if (isset($_GET['messaggio10'])) {
            $messaggio10= $_GET['messaggio10'];
            echo " <h1 class='erroreros'>$messaggio10</h1>";
        }}else{?><label>dislivello in metri</label> <br><input type="number" name="dislivello" max="99" required><?php if (isset($_GET['messaggio10'])) {
        $messaggio10= $_GET['messaggio10'];
        echo " <h1 class='erroreros'>$messaggio10</h1>";
    }}?><br>


    <?php if(isset($_GET['durata'])) {
        $durata=$_GET['durata'];?>
        <label>durata</label><br>
        <input type="time" name="durata" max="08:00:00" value="<?php echo $durata?>"><?php if (isset($_GET['messaggio11'])) {
            $messaggio11= $_GET['messaggio11'];
            echo " <h1 class='erroreros'>$messaggio11</h1>";
        }}else{?><label>durata</label><br>
        <input type="time" name="durata" max="08:00:00" ><?php if (isset($_GET['messaggio11'])) {
            $messaggio11= $_GET['messaggio11'];
            echo " <h1 class='erroreros'>$messaggio11</h1>";
        }}?>
        <br>


        <label>tipologia</label><br> <label class="radio-inline">
            <input type="radio" name="tipologia" id="inlineRadio1" value=1 checked> corsa
        </label>
        <label class="radio-inline">
            <input type="radio" name="tipologia" id="inlineRadio2" value=0> mountain
        </label><?php if (isset($_GET['messaggio3'])) {
            $messaggio3 = $_GET['messaggio3'];
            echo " <h1 class='erroreros'>$messaggio3</h1>";
        }?><br>


        <label>difficolta</label><br> <label class="radio-inline" style="color:#4CAF50; font-weight:bold">
            <input type="radio" name="difficolta" id="inlineRadio3" value=1 checked> facile
        </label>
        <label class="radio-inline" style="color:deepskyblue; font-weight: bold">
            <input type="radio" name="difficolta" id="inlineRadio4" value=2> media
        </label>
        <label class="radio-inline" style="color: red; font-weight: bold">
            <input type="radio" name="difficolta" id="inlineRadio5" value=3> difficile
        </label><?php if (isset($_GET['messaggio4'])) {
            $messaggio4 = $_GET['messaggio4'];
            echo " <h1 class='erroreros'>$messaggio4</h1>";
        }?><br>


    <?php if(isset($_GET['note'])) {
        $note=$_GET['note'];?>
        <label>note</label> <br><input type="text" name="note" value="<?php echo $note?>" required><?php if (isset($_GET['messaggio5'])) {
            $messaggio5 = $_GET['messaggio5'];
            echo " <h1 class='erroreros'>$messaggio5</h1>";
        }}else{?><label>note</label> <br><input type="text" name="note" required><?php if (isset($_GET['messaggio5'])) {
        $messaggio5 = $_GET['messaggio5'];
        echo " <h1 class='erroreros'>$messaggio5</h1>";
    }}?><br>


    <?php if(isset($_GET['data'])) {
        $data=$_GET['data'];?>
        <label>data incontrooo</label><br>
        <input type="date" name="dataIncontro" min="<?php echo $currentdate?>" value="<?php echo $data?>" required><?php if (isset($_GET['messaggio7'])) {
            $messaggio7 = $_GET['messaggio7'];
            echo " <h1 class='erroreros'>$messaggio7</h1>";
        }}else{?><label>data incontroo</label><br>
        <input type="date" name="dataIncontro" min="<?php echo $currentdate?>" required><?php if (isset($_GET['messaggio7'])) {
            $messaggio7 = $_GET['messaggio7'];
            echo " <h1 class='erroreros'>$messaggio7</h1>";
        }}?>
        <br>


    <?php if(isset($_GET['ora'])) {
        $ora=$_GET['ora'];?>
        <label>ora incontro</label> <br><input type="time" name="oraIncontro" value="<?php echo $ora?>" required><?php if (isset($_GET['messaggio8'])) {
            $messaggio8 = $_GET['messaggio8'];
            echo " <h1 class='erroreros'>$messaggio8</h1>";
        }}else{?><label>ora incontro</label> <br><input type="time" name="oraIncontro" required><?php if (isset($_GET['messaggio8'])) {
        $messaggio8 = $_GET['messaggio8'];
        echo " <h1 class='erroreros'>$messaggio8</h1>";
    }}?><br>


        <?php if(isset($_GET['luogo'])) {
            $luogo=$_GET['luogo'];?>
        <label>luogo</label><br><input type="text" name="luogo" value="<?php echo $luogo?>"><?php if (isset($_GET['messaggio6'])) {
            $messaggio6 = $_GET['messaggio6'];
            echo " <h1 class='erroreros'>$messaggio6</h1>";
        }}else{?><label>luogo</label> <br><input type="text" name="luogo" ><?php if (isset($_GET['messaggio6'])) {
        $messaggio6 = $_GET['messaggio6'];
        echo " <h1 class='erroreros'>$messaggio6</h1>";
    }}?><br>


        <label>visibilita</label><br>  <label class="radio-inline">
            <input type="radio" name="visibile" id="inlineRadio6" value=0 checked> visibile a tutti
        </label>
        <label class="radio-inline">
            <input type="radio" name="visibile" id="inlineRadio7" value=1> privata
        </label><?php if (isset($_GET['messaggio9'])) {
            $messaggio9 = $_GET['messaggio9'];
            echo " <h1 class='erroreros'>$messaggio9</h1>";
        }?><br>





        <br>
        <input class="sublog" type="submit" value="CREA USCITA">
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


