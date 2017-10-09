<?php
include 'header.php';


sec_session_start();
if(login_check($mysqli) == true) {


    $nickname = $_SESSION["nikname"];

    if(isset($_SESSION['nikname'])){
            $nickname=$_SESSION['nikname'];
            if($stmt=$mysqli->prepare("SELECT * FROM informazioni WHERE nickname = ? LIMIT 1")){
                $stmt->bind_param('s',$nickname);
                $stmt->execute(); // Esegue la query creata.
                $stmt->store_result();

                if($stmt->num_rows == 1){
                    $stmt->bind_result($nickname,$nome, $cognome,$dataNascita,$luogoNascita, $sesso,$residenza,$esperienza);
                    $stmt->fetch();
                     ?>
                      <h1><?php echo $nickname?> Modifica le tue informazioni</h1>
                    <div class=" ">
                    <div class="col-sm-6 col-md-4">
                    <div class="thumbnail rad30">
                     <form action="process_updateinfo.php" method="post" class="marg66">
                         <input type="hidden" value="<?php echo $nickname ?>" name="nickname" readonly>


                         nome<br> <input type="text" value="<?php echo $nome ?>" name="nome"><?php if (isset($_GET['messaggio0'])) {
                             $messaggio0 = $_GET['messaggio0'];
                             echo " <h1 class='erroreros'>$messaggio0</h1>";
                         }?><br>


                         cognome<br> <input type="text" value="<?php echo $cognome ?>"  name="cognome" required><?php if (isset($_GET['messaggio1'])) {
                             $messaggio1 = $_GET['messaggio1'];
                             echo " <h1 class='erroreros'>$messaggio1</h1>";
                         }?><br>


                         dataNascita<br> <input type="date" value="<?php echo $dataNascita ?>" name="dataNascita" max="2010-01-01" required><?php if (isset($_GET['messaggio2'])) {
                             $messaggio2 = $_GET['messaggio2'];
                             echo " <h1 class='erroreros'>$messaggio2</h1>";
                         }?><br>


                         luogoNascita<br> <input type="text" value="<?php echo $luogoNascita ?>" name="luogoNascita" required><?php if (isset($_GET['messaggio3'])) {
                             $messaggio3 = $_GET['messaggio3'];
                             echo " <h1 class='erroreros'>$messaggio3</h1>";
                         }?><br>


                         sesso<br> <label class="radio-inline">
                             <?php if($sesso == true){
                             ?>
                                 <input type="radio" name="sesso" id="inlineRadio1" value=1 checked> UOMO
                             </label>
                             <label class="radio-inline">
                                 <input type="radio" name="sesso" id="inlineRadio2" value=0> DONNA
                             </label><br>
                             <?php

                                  }else{
                                 ?>
                                 <input type="radio" name="sesso" id="inlineRadio1" value=1 > UOMO
                                 </label>
                                 <label class="radio-inline">
                                     <input type="radio" name="sesso" id="inlineRadio2" value=0 checked> DONNA
                                 </label><?php if (isset($_GET['messaggio5'])) {
                                     $messaggio5 = $_GET['messaggio5'];
                                     echo " <h1 class='erroreros'>$messaggio5</h1>";
                                 }?><br>


                                 <?php

                                  }
                                 ?>


                         residenza<br> <input type="text" value="<?php echo $residenza ?>" name="residenza" ><?php if (isset($_GET['messaggio4'])) {
                             $messaggio4 = $_GET['messaggio4'];
                             echo " <h1 class='erroreros'>$messaggio4</h1>";
                         }?><br>


                         esperienza<br> <label class="radio-inline">
                             <?php if($esperienza == 1){
                             ?>
                             <input type="radio" name="esperienza" id="inlineRadio8" value=1 checked> PRINCIPIANTE
                         </label>
                         <label class="radio-inline">
                             <input type="radio" name="esperienza" id="inlineRadio9" value=0> ESPERTO
                         </label><br>


                                      <?php

                                    }else{
                                                               ?>
                                                     <input type="radio" name="esperienza" id="inlineRadio10" value=1 > PRINCIPIANTE
                                                 </label>
                                                 <label class="radio-inline">
                                                     <input type="radio" name="esperienza" id="inlineRadio11" value=0 checked> ESPERTO
                                                 </label><?php if (isset($_GET['messaggio6'])) {
                                              $messaggio6 = $_GET['messaggio6'];
                                              echo " <h1 class='erroreros'>$messaggio6</h1>";
                                          }?><br>


                                             <?php

                                    }
                                    ?>
                  <input type="submit" value="MODIFICA">
                          </form>
                    </div>
                    </div>
                    </div>

                    <?php
             }else{
                         ?>
                          <h1><?php echo $nickname?> Inserisci le tue informazioni</h1>
                    <div class=" ">
                    <div class="col-sm-6 col-md-4">
                    <div class="thumbnail rad30">
                         <form action="process_info.php" method="post" class="marg66">
                             <input type= "hidden" value="<?php echo $nickname ?>" name="nickname" readonly>


                    <?php if(isset($_GET['nome'])) {
                        $nome=$_GET['nome'];?>
                             nome<br><input type="text" name="nome" value="<?php echo $nome?>"><?php if (isset($_GET['messaggio0'])) {
                                 $messaggio0 = $_GET['messaggio0'];
                                 echo " <h1 class='erroreros'>$messaggio0</h1>";
                             }}else{?>nome<br><input type="text" name="nome" ><?php if (isset($_GET['messaggio0'])) {
                        $messaggio0 = $_GET['messaggio0'];
                        echo " <h1 class='erroreros'>$messaggio0</h1>";
                    }}?><br>


                    <?php if(isset($_GET['cognome'])) {
                        $cognome=$_GET['cognome'];?>
                             cognome<br> <input type="text" value="<?php echo $cognome?>" name="cognome" required><?php if (isset($_GET['messaggio1'])) {
                                 $messaggio1 = $_GET['messaggio1'];
                                 echo " <h1 class='erroreros'>$messaggio1</h1>";
                             }}else{?>cognome<br> <input type="text" name="cognome" required><?php if (isset($_GET['messaggio1'])) {
                        $messaggio1 = $_GET['messaggio1'];
                        echo " <h1 class='erroreros'>$messaggio1</h1>";
                    }}?><br>


                    <?php if(isset($_GET['data'])) {
                        $data=$_GET['data'];?>
                             dataNascita<br> <input type="date" value="<?php echo $data?>"  max="2010-01-01" name="dataNascita"><?php if (isset($_GET['messaggio2'])) {
                                 $messaggio2 = $_GET['messaggio2'];
                                 echo " <h1 class='erroreros'>$messaggio2</h1>";
                             }}else{?>dataNascita<br> <input type="date"  max="2010-01-01" name="dataNascita"><?php if (isset($_GET['messaggio2'])) {
                        $messaggio2 = $_GET['messaggio2'];
                        echo " <h1 class='erroreros'>$messaggio2</h1>";
                    }}?><br>


                    <?php if(isset($_GET['luogo'])) {
                        $luogo=$_GET['luogo'];?>
                             luogoNascita<br> <input type="text" value="<?php echo $luogo?>" name="luogoNascita" required><?php if (isset($_GET['messaggio3'])) {
                                 $messaggio3 = $_GET['messaggio3'];
                                 echo " <h1 class='erroreros'>$messaggio3</h1>";
                             }}else{?>luogoNascita<br> <input type="text" name="luogoNascita" required><?php if (isset($_GET['messaggio3'])) {
                        $messaggio3 = $_GET['messaggio3'];
                        echo " <h1 class='erroreros'>$messaggio3</h1>";
                    }}?><br>


                             sesso<br> <label class="radio-inline">
                                     <input type="radio" name="sesso" id="inlineRadio1" checked value=1> UOMO
                                 </label>
                                 <label class="radio-inline">
                                     <input type="radio" name="sesso" id="inlineRadio2" value=0> DONNA
                                 </label><?php if (isset($_GET['messaggio5'])) {
                                 $messaggio5 = $_GET['messaggio5'];
                                 echo " <h1 class='erroreros'>$messaggio5</h1>";
                             }?><br>


                    <?php if(isset($_GET['residenza'])) {
                        $residenza=$_GET['residenza'];?>
                             residenza<br> <input type="text" value="<?php echo $residenza?>" name="residenza" required><?php if (isset($_GET['messaggio4'])) {
                                 $messaggio4 = $_GET['messaggio4'];
                                 echo " <h1 class='erroreros'>$messaggio4</h1>";
                             }}else{?>residenza<br> <input type="text" name="residenza" required><?php if (isset($_GET['messaggio4'])) {
                        $messaggio4 = $_GET['messaggio4'];
                        echo " <h1 class='erroreros'>$messaggio4</h1>";
                    }}?><br>


                             esperienza<br> <label class="radio-inline">
                                     <input type="radio" name="esperienza" id="inlineRadio3"  value=1 checked> PRINCIPIANTE
                                 </label>
                                 <label class="radio-inline">
                                     <input type="radio" name="esperienza" id="inlineRadio4" value=0> ESPERTO
                                 </label><?php if (isset($_GET['messaggio6'])) {
                                 $messaggio6 = $_GET['messaggio6'];
                                 echo " <h1 class='erroreros'>$messaggio6</h1>";
                             }?><br>
                             <input type="submit" value="INSERISCI">
                             </form>
                      </div>
                    </div>
                </div>


             <?php

                }


            }

        }
// Inserisci qui il contenuto delle tue pagine!

} else {

       echo 'invalid';


}
?>
</div>
</body>
</html>
