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
                      <h1>sei gia informatizato</h1>
                     <form action="process_updateinfo.php" method="post">
                         nickname:<input type="text" value="<?php echo $nickname ?>" name="nickname" readonly><br>
                         nome: <input type="text" value="<?php echo $nome ?>" name="nome"><br>
                         cognome: <input type="text"value="<?php echo $cognome ?>"  name="cognome"><br>
                         dataNascita: <input type="date" value="<?php echo $dataNascita ?>"name="dataNascita"><br>
                         luogoNascita: <input type="text" value="<?php echo $luogoNascita ?>"name="luogoNascita"><br>
                         sesso: <label class="radio-inline">
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
                                 </label><br>


                                 <?php

                                  }
                                 ?>
                         residenza: <input type="text" value="<?php echo $residenza ?>"name="residenza"><br>
                         esperienza: <label class="radio-inline">
                             <?php if($esperienza == 1){
                             ?>
                             <input type="radio" name="esperienza" id="inlineRadio1" value=1 checked> PRINCIPIANTE
                         </label>
                         <label class="radio-inline">
                             <input type="radio" name="esperienza" id="inlineRadio2" value=0> ESPERTO
                         </label><br>


                                      <?php

                                    }else{
                                                               ?>
                                                     <input type="radio" name="esperienza" id="inlineRadio1" value=1 > PRINCIPIANTE
                                                 </label>
                                                 <label class="radio-inline">
                                                     <input type="radio" name="esperienza" id="inlineRadio2" value=0 checked> ESPERTO
                                                 </label><br>


                                             <?php

                                    }
                                    ?>
                  <input type="submit" value="MODIFICA">
                          </form>
                    <?php
             }else{
                         ?>
                          <h1>non hai inserito info</h1>
                         <form action="process_info.php" method="post">
                             nickname:<input type= "text" value="<?php echo $nickname ?>" name="nickname" readonly><br>
                         nome: <input type="text" value="<?php echo $nome ?>"name="nome"><br>
                         cognome: <input type="text"  value="<?php echo $cognome ?>" name="cognome"><br>
                             dataNascita: <input type="date" name="dataNascita"><br>
                             luogoNascita: <input type="text" name="luogoNascita"><br>
                             sesso: <label class="radio-inline">
                                     <input type="radio" name="sesso" id="inlineRadio1" value=1> UOMO
                                 </label>
                                 <label class="radio-inline">
                                     <input type="radio" name="sesso" id="inlineRadio2" value=0> DONNA
                                 </label><br>
                                 residenza: <input type="text" name="residenza"><br>
                             esperienza: <label class="radio-inline">
                                     <input type="radio" name="esperienza" id="inlineRadio1" value=1> PRINCIPIANTE
                                 </label>
                                 <label class="radio-inline">
                                     <input type="radio" name="esperienza" id="inlineRadio2" value=0> ESPERTO
                                 </label><br>
                             <input type="submit" value="INSERISCI">
                             </form>
             <?php

                }


            }

        }
// Inserisci qui il contenuto delle tue pagine!

} else {

       echo suca;
}