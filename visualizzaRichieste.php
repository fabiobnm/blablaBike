<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {

    $nickname=$_SESSION['nikname'];
    $query="SELECT utente FROM segue WHERE seguitoDa = '$nickname'&& approvato=0";
    $result=mysqli_query($mysqli,$query);

    echo 'richieste amicizia';
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    echo 'peneeeeeeee';
        ?> <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">

                    <img src="img/richiesta.svg"  alt="vvvv">
                    <div class="caption">
                        <h3><?php echo $row["utente"]; ?></h3>
                        <p>vuole essere tuo amico</p>
                        <p><a href="accettaRichiesta.php?profilo=<?php echo $row['utente'];?>" class="btn btn-primary" role="button">Accetta</a> <a href="utente.php" class="btn btn-default" role="button">visualizza profilo</a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}