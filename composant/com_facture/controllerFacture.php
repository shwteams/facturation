<?php
if(!isset($_SESSION))
    session_start();
include_once '../../services/lib.php';
include_once '../../services/parameters.php';
$db = DoConnexion(HOST, USER, PWD, DBNAME);
if (isset($_GET["task"])) {
    $task = $_GET["task"];
    //echo $task;
    if ($task == "") {
        echo 'Error';
    }
    else if($task == "getAlphabetiqueWord"){
        getAlphabetiqueWord();
    }
    else if($task == "getAllClient"){
        $lg_CLIENT_ID = "";
        if(isset($_GET['lg_CLIENT_ID']))
        {
            $lg_CLIENT_ID = htmlentities($_GET['lg_CLIENT_ID']);
        }
        getAllClient($lg_CLIENT_ID, $db);
    }
    else if($task == "getAllBranche"){
        $str_BRANCHE_ID = "";
        if(isset($_GET['str_BRANCHE_ID']))
        {
            $str_BRANCHE_ID= htmlentities($_GET['str_BRANCHE_ID']);
        }
        getAllBranche($str_BRANCHE_ID, $db);
    }

    else if($task == "getAllFacture"){
        $str_COURRIER_ID = "";
        if(isset($_GET['str_COURRIER_ID']))
        {
            $str_COURRIER_ID= htmlentities($_GET['str_COURRIER_ID']);
        }
        $str_INTERMEDIAIRE_ID = "";
        if(isset($_GET['lg_CLIENT_ID']))
        {
            $lg_CLIENT_ID= htmlentities($_GET['lg_CLIENT_ID']);
        }
        $str_BRANCHE_ID = "";
        if(isset($_GET['str_BRANCHE_ID']))
        {
            $str_BRANCHE_ID= htmlentities($_GET['str_BRANCHE_ID']);
        }
        $str_PHASE_ID = "";
        if(isset($_GET['str_PHASE_ID']))
        {
            $str_PHASE_ID= htmlentities($_GET['str_PHASE_ID']);
        }
        $str_DATE_FIN = "";
        if(isset($_GET['str_DATE_FIN']))
        {
            $str_DATE_FIN= htmlentities($_GET['str_DATE_FIN']);
        }
        $str_DATE_DEBUT = "";
        if(isset($_GET['str_DATE_DEBUT']))
        {
            $str_DATE_DEBUT= htmlentities($_GET['str_DATE_DEBUT']);
        }
        $str_POLICE = "";
        if(isset($_GET['str_POLICE']))
        {
            $str_POLICE= htmlentities($_GET['str_POLICE']);
        }

        getAllFacture($str_COURRIER_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $str_POLICE, $db);
    }
    else if($task == "printCourriers"){
        printCourriers($str_COURRIER_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $db);
    }
}
else if (isset($_POST['addFacture'])) {
    $str_NUMERO_POLICE = htmlentities(trim($_POST['str_NUMERO_POLICE']));
    $dt_EFFET = htmlentities(trim($_POST['dt_EFFET']));
    $dt_ECHEANCE = htmlentities(trim($_POST['dt_ECHEANCE']));
    $int_ACCESSOIRE = htmlentities(trim($_POST['int_ACCESSOIRE']));
    $int_TAXE = htmlentities(trim($_POST['int_TAXE']));
    $int_PRIME_NETTE = htmlentities(trim($_POST['int_PRIME_NETTE']));
    $str_BRANCHE_ID =  htmlentities(trim($_POST['str_BRANCHE_ID']));
    $lg_CLIENT_ID = htmlentities(trim($_POST['lg_CLIENT_ID']));
    /*
    $str_BP = htmlentities(trim($_POST['str_BP']));
    $str_TEL = htmlentities(trim($_POST['str_TEL']));*/

    addFacture($db, $str_NUMERO_POLICE, $dt_EFFET, $dt_ECHEANCE, $int_ACCESSOIRE, $int_TAXE, $int_PRIME_NETTE, $lg_CLIENT_ID, $str_BRANCHE_ID);
}
else if (isset($_POST['addFactureFile'])) {
    $str_BRANCHE_FILE = htmlentities(trim($_POST['str_BRANCHE_FILE']));
    $str_CLIENT_FILE = htmlentities(trim($_POST['str_CLIENT_FILE']));
    $str_NUMERO_POLICE_FILE = htmlentities(trim($_POST['str_NUMERO_POLICE_FILE']));
    $str_DATE_EFFET_FILE = htmlentities(trim($_POST['str_DATE_EFFET_FILE']));
    $str_DATE_ECHEANCE_FILE = htmlentities(trim($_POST['str_DATE_ECHEANCE_FILE']));
    $str_ACCESSOIRE_FILE = htmlentities(trim($_POST['str_ACCESSOIRE_FILE']));
    $int_TAXE_FILE =  htmlentities(trim($_POST['int_TAXE_FILE']));
    $int_PRIMENETTE_FILE = htmlentities(trim($_POST['int_PRIMENETTE_FILE']));
    $str_BP_FILE = htmlentities(trim($_POST['str_BP_FILE']));
    $str_TEL_FILE = htmlentities(trim($_POST['str_TEL_FILE']));

    addFileFacture($db, $str_BRANCHE_FILE, $str_CLIENT_FILE, $str_NUMERO_POLICE_FILE, $str_DATE_EFFET_FILE, $str_DATE_ECHEANCE_FILE, $str_ACCESSOIRE_FILE, $int_TAXE_FILE, $int_PRIMENETTE_FILE, $str_BP_FILE, $str_TEL_FILE);
}
else if(isset($_POST['extractXSLData'])){

    $str_GESTIONNAIRE = htmlentities($_POST['str_GESTIONNAIRE']);
    $str_DATE_DEBUT = htmlentities($_POST['str_DATE_DEBUT']);
    $str_DATE_FIN = htmlentities($_POST['str_DATE_FIN']);
    $str_ETAT_ID = htmlentities($_POST['str_ETAT_ID']);
    $str_FILE_NAME = htmlentities($_POST['str_FILE_NAME']);
    ExtractSinistre($str_GESTIONNAIRE,$str_DATE_DEBUT, $str_DATE_FIN, $str_ETAT_ID, $str_FILE_NAME, $db);
}