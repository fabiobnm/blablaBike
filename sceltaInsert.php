<?php
include 'header.php';

//sistemare problema di ruote e peso nullable
sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION['nikname'];

    echo '<h1 class="center">inserisci bike</h1>'
    ?>

    <div class="thumbnail testFlo marginBox orange">
        <a href="insertbike.php"><h3 class="pubuscita">Bike da Corsa</h3></a></div>
    <div class="thumbnail testFlo marginBox blu">
        <a href="insertBikeMount.php"><h3 class="pubuscita">Mountain Bike</h3></a></div>





    <?php









}

else{

    echo "accedi";
}
?>
</div>
</body>
</html>

