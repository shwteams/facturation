<?php
if(!isset($_SESSION))
    session_start();

include '../../services/lib.php';
include_once '../../services/parameters.php';
$db = DoConnexion(HOST, USER, PWD, DBNAME);
if (isset($_GET["task"])) {
    $task = $_GET["task"];
    //echo $task;
    if ($task == "") {
        echo 'Error';
    } 
    else if ($task == "getAllBranche"){
        $str_PHASE_ID = "";
        if(isset($_GET['lg_BRANCHE_ID']))
        {
            $str_PHASE_ID = htmlentities($_GET['lg_BRANCHE_ID']);
        }
        getAllBranche($str_PHASE_ID, $db);
    } 
    else if ($task == "deletePhase"){
        $lg_BRANCHE_ID = $_GET["lg_BRANCHE_ID"];
        deleteBranche($lg_BRANCHE_ID, $db);
    }
} 
else if (isset($_POST['addBranche'])){
    $str_LIBELLE = htmlentities(trim($_POST['str_LIBELLE']));
    addBranche( $db, $str_LIBELLE);
}
else if (isset($_POST['editBranche'])) {
    $str_PHASE_ID = htmlentities(trim($_POST['lg_BRANCHE_ID']));
    $str_LIBELLE = htmlentities(trim($_POST['str_LIBELLE_EDIT']));
    editBranche($str_PHASE_ID, $str_LIBELLE, $db);
}