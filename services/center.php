<?php
/**
Dans ce fichier il faut ajouter la liste des fichiers du composant/com_
et lancer leurs methode
*/

include_once '../composant/com_user/user.php';
include_once '../composant/com_phase/phase.php';
include_once '../composant/com_facture/facture.php';
include_once '../composant/com_client/client.php';
include_once '../composant/com_extraction/extraction.php';


if (isset($_GET["task"])) {
    $task = $_GET["task"];
}
switch ($task) {
    case 'showClient':
        echo showClient();
        break;
    case 'showUser':
        echo showUser();
        break;
    case 'showListe':
        echo showListe();
        break;
    case 'showPhase':
        echo showPhase();
        break;
    case 'showExtractFile':
        echo showExtractFile();
        break;
    default:
        echo showHomeAdminPage();
        break;
}

function showExtractFile(){
    Extraction::showAllExtraction();
}
function showListe(){
    Facture::showAllFacture();
}
function showPhase()
{
    Phase::showAllPhase();
}
function showHomeAdminPage(){
    //Dashbord::showHomeAdminPage();
    Facture::showAllFacture();
}
function showUser(){
    User::showAllUser();
}
function showClient(){
    Client::showAllClient();
}