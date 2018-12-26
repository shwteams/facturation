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
    else if ($task == "getAllClient"){
        $lg_CLIENT_ID = "";
        if(isset($_GET['lg_CLIENT_ID']))
        {
            $lg_CLIENT_ID = htmlentities($_GET['lg_CLIENT_ID']);
        }
        getAllClient($lg_CLIENT_ID, $db);
    } 
    else if ($task == "deletePhase"){
        $lg_BRANCHE_ID = $_GET["lg_CLIENT_ID"];
        deleteClient($lg_BRANCHE_ID, $db);
    }
} 
else if (isset($_POST['addClient'])){
    $str_LIBELLE = htmlentities(trim($_POST['str_LIBELLE']));
    $str_TEL = htmlentities(trim($_POST['str_TEL']));
    $str_BP = htmlentities(trim($_POST['str_BP']));
    addClient( $db, $str_LIBELLE,$str_BP, $str_TEL);
}
else if (isset($_POST['editClient'])) {
    $lg_CLIENT_ID = htmlentities(trim($_POST['lg_CLIENT_ID']));
    $str_LIBELLE = htmlentities(trim($_POST['str_LIBELLE_EDIT']));
    $str_TEL = htmlentities(trim($_POST['str_TEL_EDIT']));
    $str_BP = htmlentities(trim($_POST['str_BP_EDIT']));
    editClient($lg_CLIENT_ID, $str_LIBELLE,$str_BP, $str_TEL, $db);
}