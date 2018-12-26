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
    else if ($task == "getAllExtraction"){
        $str_PHASE_ID = "";
        if(isset($_GET['str_EXTRACTION_ID']))
        {
            $str_PHASE_ID = htmlentities($_GET['str_EXTRACTION_ID']);
        }
        $index = $_GET["index"];
        getAllExtraction($str_EXTRACTION_ID, $db,$index);
    }
    else if ($task == "countData"){

        countData($db);
    }

}