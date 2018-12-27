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
    else if ($task == "getAllService"){
        $str_PHASE_ID = "";
        if(isset($_GET['lg_SERVICE_ID']))
        {
            $str_PHASE_ID = htmlentities($_GET['lg_SERVICE_ID']);
        }
        getAllService($str_PHASE_ID, $db);
    } 
    else if ($task == "deleteService"){
        $lg_SERVICE_ID = $_GET["lg_SERVICE_ID"];
        deleteService($lg_SERVICE_ID, $db);
    }
} 
else if (isset($_POST['addService'])){
    $str_LIBELLE = htmlentities(trim($_POST['str_LIBELLE']));
    addService( $db, $str_LIBELLE);
}
else if (isset($_POST['editService'])) {
    $lg_SERVICE_ID = htmlentities(trim($_POST['lg_SERVICE_ID']));
    $str_LIBELLE = htmlentities(trim($_POST['str_LIBELLE_EDIT']));
    editService($lg_SERVICE_ID, $str_LIBELLE, $db);
}