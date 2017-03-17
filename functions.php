<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:08
 */

function sec_session_start() {
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
    $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
    $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
    ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
    $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
    session_start(); // Avvia la sessione php.
    session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}
function singin($email, $password, $nickname, $mysqli) {

    $stmt = $mysqli->prepare("INSERT INTO utente (nickname,email,password)VALUES(?,?,?)");
    $stmt->bind_param('sss',$nickname,$email, $password);

    $stmt->execute();
    $stmt->close();

    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

    //$user_id = preg_replace("/[^0-9]+/", "", $nikname); // ci proteggiamo da un attacco XSS
    $_SESSION['nikname'] = $nickname;
    //$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
    $_SESSION['email'] = $email;
    $_SESSION['login_string'] =  $password.$user_browser;
    //$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
    // Login eseguito con successo.

    return true;


}
function eliminaBike($utente,$bike,$mysqli){

    $stmt = $mysqli->prepare("DELETE FROM  bicicletta WHERE proprietario='$utente' && ID='$bike' ");
    $stmt->execute();
    $stmt->close();
    return true;


}

function accettaRichiesta($utente,$seguitoDa,$mysqli){

    $stmt = $mysqli->prepare("UPDATE segue SET approvato = 1
     
    WHERE utente='$seguitoDa' && seguitoDa='$utente'");
    //$stmt->bind_param('s', $_SESSION['nickname']);

    $stmt->execute();
    $stmt->close();
    return true;




}


function updateinfo($nickname,$nome,$cognome,$dataNascita,$luogoNascita,$sesso,$residenza,$esperienza,$mysqli){

    echo "<br>";
    echo $nickname;
    echo "<br>";

    $stmt = $mysqli->prepare("UPDATE informazioni SET nome='$nome',cognome='$cognome',dataNascita='$dataNascita',
    luogoNascita='$luogoNascita',sesso='$sesso',residenza='$residenza',esperienza='$esperienza'
     
    WHERE nickname='$nickname'");
    //$stmt->bind_param('s', $_SESSION['nickname']);

    $stmt->execute();
    $stmt->close();
    return true;

}
function inserisciCommento($testo,$nickname,$annuncio,$mysqli){

    $stmt = $mysqli->prepare("INSERT INTO commento (testo,utente,annuncio)VALUES(?,?,?)");
    $stmt->bind_param('ssi',$testo,$nickname,$annuncio);

    $stmt->execute();
    $stmt->close();
    return true;




}
function creaAnnuncio($titolo,$bicicletta,$venditore,$prezzo,$descrizione,$mysqli){


    $stmt = $mysqli->prepare("INSERT INTO annuncio (titolo,bicicletta,venditore,prezzo,descrizione)
VALUES(?,?,?,?,?)");
    $stmt->bind_param('sisis',$titolo,$bicicletta, $venditore,$prezzo,$descrizione);

    $stmt->execute();
    $stmt->close();
    return true;

}



function insertbike($proprietario,$nome,$tipo,$marca,$modello,$peso,$ruote,$annoFab,$annoAcq,$colore,$mysqli){

    $stmt = $mysqli->prepare("INSERT INTO bicicletta (proprietario,nome,tipo,marca,modello,peso,ruote,annoFab,annoAcq,
     colore)VALUES(?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssissiisss',$proprietario,$nome, $tipo,$marca,$modello,$peso,$ruote,$annoFab,$annoAcq,$colore);

    $stmt->execute();
    $stmt->close();
    return true;

}
function follow($utente,$seguitoDa,$mysqli){

    $stmt = $mysqli->prepare("INSERT INTO segue (utente,seguitoDa)VALUES(?,?)");
    $stmt->bind_param('ss',$utente,$seguitoDa);

    $stmt->execute();
    $stmt->close();
    return true;

}

function creauscita($organizzatore,$titolo,$distanza,$dislivello,$tipologia,$difficolta,$note,$luogo,$dataIncontro,$oraIncontro,$visibile,$mysqli){

    $stmt = $mysqli->prepare("INSERT INTO uscita (organizzatore,titolo,distanza,dislivello,tipologia,
      difficolta,note,luogo,dataIncontro,oraIncontro,visibile)VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('ssiiiissssi',$organizzatore,$titolo, $distanza,$dislivello,$tipologia,
        $difficolta,$note,$luogo,$dataIncontro,$oraIncontro,$visibile);

    $stmt->execute();
    $stmt->close();
    return true;

}

function info($nickname,$nome,$cognome,$dataNascita,$luogoNascita,$sesso,$residenza,$esperienza,$mysqli){

    $stmt = $mysqli->prepare("INSERT INTO informazioni (nickname,nome,cognome,dataNascita,luogoNascita,sesso,
     residenza,esperienza)VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssisi',$nickname,$nome, $cognome,$dataNascita,$luogoNascita, $sesso,$residenza,$esperienza);

    $stmt->execute();
    $stmt->close();
 return true;

}

function nickEsiste($nickname,$mysqli){

    $stmt = $mysqli->prepare("SELECT nickname FROM utente WHERE nickname = ? LIMIT 1");
    $stmt->bind_param('s',$nickname);

    $stmt->execute();
    $stmt->store_result();
    $stmt->fetch();

    if($stmt->num_rows == 1){


        return true;}


}

function emailEsiste($email,$mysqli){

    $stmt = $mysqli->prepare("SELECT email FROM utente WHERE email = ? LIMIT 1 ");
    $stmt->bind_param('s',$email);

    $stmt->execute();
    $stmt->store_result();
    $stmt->fetch();

    if($stmt->num_rows == 1){


    return true;}

}


function square($ricercautente,$mysqli)
{

        //$stmt->bind_param('s', $ricercautente);
         // recupera il risultato della query e lo memorizza nelle relative variabili.
        $stmt = $mysqli->prepare("SELECT email FROM utente WHERE nickname = 'lullo' LIMIT 1");

        $stmt->execute();
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $json=json_encode($results);

        return $json;



}

function ricercautente($ricercautente,$mysqli){
    if($stmt = $mysqli->prepare("SELECT email FROM utente WHERE nickname LIKE '%arotin%'")){
        //$stmt->bind_param('s', $ricercautente);
        $stmt->execute();
        $stmt->store_result();
        //$stmt->bind_result($email); // recupera il risultato della query e lo memorizza nelle relative variabili.
        $stmt->fetch();

        if($stmt->num_rows != 0){
            $json = array();
            while($row =mysqli_fetch_assoc($stmt))
            {
                $emparray[] = $row;
            }
           return json_encode($emparray);
        } else
            { return false;}


    }


}

function login($email, $password, $mysqli) {
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
    if ($stmt = $mysqli->prepare("SELECT nickname,email,password FROM utente WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
        $stmt->execute(); // esegue la query appena creata.
        $stmt->store_result();
        $stmt->bind_result($nikname, $email2, $db_password); // recupera il risultato della query e lo memorizza nelle relative variabili.
        $stmt->fetch();

        $password =  $password; // proceso di cript.
        if($stmt->num_rows == 1) { // se l'utente esiste
            if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                    // Password corretta!
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                    //$user_id = preg_replace("/[^0-9]+/", "", $nikname); // ci proteggiamo da un attacco XSS
                    $_SESSION['nikname'] = $nikname;
                    //$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
                    $_SESSION['email'] = $email2;
                    $_SESSION['login_string'] =  $password.$user_browser;
                    //$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                    // Login eseguito con successo.
                    return true;
                }
            }
        } else {
            // L'utente inserito non esiste.
            return false;
        }

};//non uso nickname come parametro perchè è gia in SESSION
function trova_info($mysqli){
    if(isset($_SESSION['nikname'])){
        $nickname=$_SESSION['nikname'];
        if($stmt=$mysqli->prepare("SELECT * FROM informazioni WHERE nickname = ? LIMIT 1")){
            $stmt->bind_param('s',$nickname);
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();

            if($stmt->num_rows == 1){
                $stmt->bind_result($nickname,$nome, $cognome,$dataNascita,$luogoNascita, $sesso,$residenza,$esperienza);
                $stmt->fetch();


            }


        }

    }



}
function login_check($mysqli) {
    // Verifica che tutte le variabili di sessione siano impostate correttamente
    if(isset($_SESSION['nikname'], $_SESSION['email'], $_SESSION['login_string'])) {
        $nik = $_SESSION['nikname'];
        $login_string = $_SESSION['login_string'];
        $email = $_SESSION['email'];
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
        if ($stmt = $mysqli->prepare("SELECT password FROM utente WHERE nickname = ? LIMIT 1")) {
            $stmt->bind_param('s', $nik); // esegue il bind del parametro '$user_id'.
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();

            if($stmt->num_rows == 1) { // se l'utente esiste
                $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
                $stmt->fetch();
                $login_check =  $password.$user_browser;
                if($login_check == $login_string) {
                    // Login eseguito!!!!
                    return true;
                } else {
                    //  Login non eseguito
                    return false;
                }
            } else {
                // Login non eseguito
                return false;
            }
        } else {
            // Login non eseguito
            return false;
        }
    } else {
        // Login non eseguito
        return false;
    }
}