<?php
/**
 * Created by PhpStorm.
 * User: BNM
 * Date: 24/02/17
 * Time: 17:46
 */
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura

$nickname = $_SESSION['nikname'];
if(isset($_GET['tipologia'])){
    $tipologiaS=$_GET['tipologia'];
    $Qtipologia=' tipologia='.$tipologiaS.' AND ';
    if($tipologiaS==0){
    $testotipologia='tipologia=MOUNTAIN, ';}
    else{$testotipologia='tipologia=CORSA, ';}
}
if(isset($_GET['difficolta'])){
    $difficoltaS=$_GET['difficolta'];
    $Qdifficolta=' difficolta='.$difficoltaS.' AND ';
    if($difficoltaS==1){
    $testodifficolta='difficolta=FACILE, ';}
    else if($difficoltaS==2){
        $testodifficolta='difficolta=MEDIA, ';
    }else{
        $testodifficolta='difficolta=DIFFICILE, ';
    }
}
if(isset($_GET['distanza'])){
    $distanzaS=$_GET['distanza'];
    $Qdistanza=' distanza<= '.$distanzaS.' AND ';
    $testodistanza='distanza max '.$distanzaS.', ';
}


$filtroQuery= "$Qtipologia $Qdifficolta $Qdistanza " ;
$testofiltro="$testotipologia $testodifficolta $testodistanza";

if(inserisciFiltroUscite($nickname,$filtroQuery,$testofiltro,$mysqli)==true){

    header("location: ./visualizzaUscite.php");
}else{
    echo 'errore';
}