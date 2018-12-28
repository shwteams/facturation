<?php

require_once dirname(__FILE__).'/services/php_to_pdf/vendor/autoload.php';
include_once 'services/lib.php';
include_once 'services/parameters.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_GET["task"])) {
    $task = $_GET["task"];
	$lg_FACTURE_ID = htmlentities(trim($_GET["lg_FACTURE_ID"]));
    $lg_CLIENT_ID = htmlentities(trim($_GET["lg_CLIENT_ID"]));
	$str_BRANCHE_ID = htmlentities(trim($_GET["str_BRANCHE_ID"]));
	//$str_PHASE_ID = htmlentities(trim($_GET["str_PHASE_ID"]));
	$str_DATE_DEBUT = htmlentities(trim($_GET["str_DATE_DEBUT"]));
	$str_DATE_FIN = htmlentities(trim($_GET["str_DATE_FIN"]));
	if(isset($_GET["str_TYPE"]) && !empty($_GET["str_TYPE"]))
	    $str_TYPE = htmlentities(trim($_GET["str_TYPE"]));
}
switch ($task) {
    case 'printf':
        $db = DoConnexion(HOST, USER, PWD, DBNAME);
        //echo printCourriers($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, 'sansentete', $db);
        echo printCourriers($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, 'sansentete', $db);
        $file_name = 'Extraction-du-'.date("d-m-Y");
        //createZipFile($file_name);
        break;
	case 'printfAll':
        $db = DoConnexion(HOST, USER, PWD, DBNAME);
        //echo printCourriersAll($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, '', $db);
        echo printCourriersAll($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, '', $db);
        $file_name = 'Extraction-du-'.date("d-m-Y");
        //createZipFile($file_name);
        break;
	case 'printfAllSansEntete':
        $db = DoConnexion(HOST, USER, PWD, DBNAME);
        //echo printCourriersAll($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, 'sansentete', $db);
        echo printCourriersAll($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, 'sansentete', $db);
        $file_name = 'Extraction-du-'.date("d-m-Y");
        //createZipFile($file_name);
        break;
	default:
		$db = DoConnexion(HOST, USER, PWD, DBNAME);
        //echo printCourriers($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, '', $db);
        echo printCourriers($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, '', $db);
		break;
}

//function printCourriers($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $str_TYPE, $db){
function printCourriers($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $str_TYPE, $db){

    set_time_limit(0);
    $dt_UPDATED = $db->quote(gmdate("Y-m-d, H:i:s"));
    $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
    $str_POLICE = "";
    $cpt = 0;
    $file_name = 'courriers-du-'.date("d-m-Y");
    $arrayJson = array();
    $arraySql = array();
    $code_statut = "0";
    $str_STATUT = "delete";
    $intResult = 0;
    $interval = 0;
    if ($lg_FACTURE_ID == "" || $lg_FACTURE_ID == null) {
        $interval = 1;
        $lg_FACTURE_ID = "%%";
    }
    $lg_FACTURE_ID = $db -> quote($lg_FACTURE_ID);
    if ($lg_CLIENT_ID == "" || $lg_CLIENT_ID == null) {
        $lg_CLIENT_ID = "%%";
    }
    if ($str_BRANCHE_ID == "" || $str_BRANCHE_ID == null) {
        $str_BRANCHE_ID = "%%";
    }
    if ($str_POLICE == "" || $str_POLICE == null) {
        $str_POLICE = "%%";
    }
    $lg_CLIENT_ID = $db->quote($lg_CLIENT_ID);
    $str_BRANCHE_ID = $db->quote($str_BRANCHE_ID);
    $str_POLICE = $db->quote($str_POLICE);

    $message = "Impossible de générer les courriers";
    $i = 0;

    if( ($str_DATE_DEBUT<>'' or $str_DATE_DEBUT<>null) and ($str_DATE_FIN<>'' or $str_DATE_FIN<> null)){
        $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);
        $str_DATE_FIN = $db->quote($str_DATE_FIN);
        if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
            $str_DATE_DEBUT = "%%";
        }
        if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
            $str_DATE_FIN = "%%";
        }
        $sql = "SELECT t_facture.*, str_NAME, str_LIBELLE, str_TEL, str_BP "
            ."FROM t_facture "
            ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
            ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
            ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE between $str_DATE_DEBUT AND $str_DATE_FIN AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID  AND str_POLICE LIKE $str_POLICE AND lg_FACTURE_ID LIKE $lg_FACTURE_ID ";
    }
    else{
        if($str_DATE_DEBUT<>''){
            if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
                $str_DATE_DEBUT = "%%";
            }
            $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);

            $sql = "SELECT t_facture.*, str_NAME, str_LIBELLE, str_TEL, str_BP "
                ."FROM t_facture "
                ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
                ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
                ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE LIKE $str_DATE_DEBUT AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID  AND str_POLICE LIKE $str_POLICE AND lg_FACTURE_ID LIKE $lg_FACTURE_ID ";
        }
        else{
            if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
                $str_DATE_FIN = "%%";
            }
            $str_DATE_FIN = $db->quote($str_DATE_FIN);

            $sql = "SELECT t_facture.*, str_NAME, str_LIBELLE, str_TEL, str_BP "
                ."FROM t_facture "
                ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
                ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
                ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE LIKE $str_DATE_FIN AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID  AND str_POLICE LIKE $str_POLICE AND lg_FACTURE_ID LIKE $lg_FACTURE_ID ";
        }
    }
    //echo $sql;
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $item_result) {
        $str_DIRECTORY_NAME = $item_result['str_LIBELLE'];
        $str_DIRECTORY_NAME = str_replace(' ', '_', $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace('.', '', $str_DIRECTORY_NAME);

        $structure = "courriers_avec".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/". $i++ . "_" . $str_DIRECTORY_NAME."/";
        if($str_TYPE == 'sansentete')
            $structure = "courriers_sans".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/". $i++ . "_" . $str_DIRECTORY_NAME."/";

        $intResult++;
        $code_statut = "1";
        $cpt++;

        $cli = str_replace(" ","_", $item_result['str_NAME']);
        $cli = str_replace("/", "-", $cli);
        $cli = str_replace("*", "", $cli);
        $cli = str_replace("\\", "", $cli);
        $cli = str_replace("#", "", $cli);
        $cli = str_replace("?", "", $cli);

        $link_file = $cli.'-'.$item_result['str_POLICE'] . '.pdf';
        //if($item_result['str_INTERMEDIAIRE_ID'] == 'j80zs5b9f806d96cae') echo $link_file;
        $str_EXTRACTION_ID = addHash($structure . $link_file, $item_result['str_LIBELLE'], $item_result['str_NAME'], $file_name . '.zip', $item_result['lg_BRANCHE_ID'], $item_result['lg_FACTURE_ID'], $item_result['str_POLICE'], $item_result['dt_EFFET'].' - '.$item_result['dt_ECHEANCE'], $item_result['int_ACCESSOIRE'], $db);

        ob_start();

        if($str_TYPE == 'sansentete')
        {
            include dirname(__FILE__) . '/composant/com_pdf/facture.php';
        }
        else
        {
            include dirname(__FILE__) . '/composant/com_pdf_entete/facture.php';
        }
        $content = ob_get_clean();

        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        $code_statut  = 1;

        //echo $structure."\n";
        if(!mkdir($structure, 0, true)) {//0777
            $code_statut = 0;
            $message = "Le dossier " . $structure . " à déjà été créé aujourd'hui.";
        }
        //echo $structure .$link_file;
        $html2pdf->output($structure .$link_file , 'F'); //D pour forcer le téléchargement, F pour sauvegarder sur le serveur
        //echo $data = $structure .$link_file;
        //header("location:".basename($structure .$link_file));
    }

    /**
     * Si la variable $structure est modifié alors il doit etre aussi modifié dans le function
     */

    if($interval == 1 AND !createZipFile($file_name, $str_TYPE)){
        //$code_statut = 0;
        $message = "Le fichier zip n'a pas pu être créé.";
    }

    $arrayJson["results"] = $message;
    $arrayJson["nbr_courrier_genere"] = $cpt;
    $arrayJson["link_file"] = $structure.$link_file;
    $arrayJson["code_statut"] = $code_statut;
    $arrayJson["desc_statut"] = $db->errorInfo();
    echo "[" . json_encode($arrayJson) . "]";
}
//function printCourriersAll($lg_FACTURE_ID, $str_INTERMEDIAIRE_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $str_TYPE, $db){
function printCourriersAll($lg_FACTURE_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $str_TYPE,  $db){

    set_time_limit(0);
    $dt_UPDATED = $db->quote(gmdate("Y-m-d, H:i:s"));
    $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
    $lg_SERVICE_ID = $db->quote($_SESSION['lg_SERVICE_ID']);
    //$str_POLICE = "";
    $cpt = 0;
    $file_name = $_SESSION['nom'].'-courriers-du-'.date("d-m-Y");
    $arrayJson = array();
    $arraySql = array();
    $code_statut = "0";
    $str_STATUT = "delete";
    $intResult = 0;
    $interval = 0;
    if ($lg_FACTURE_ID == "" || $lg_FACTURE_ID == null) {
        $interval = 1;
        $lg_FACTURE_ID = "%%";
    }
    $lg_FACTURE_ID = $db -> quote($lg_FACTURE_ID);
    if ($lg_CLIENT_ID == "" || $lg_CLIENT_ID == null) {
        $lg_CLIENT_ID = "%%";
    }
    if ($str_BRANCHE_ID == "" || $str_BRANCHE_ID == null) {
        $str_BRANCHE_ID = "%%";
    }/*
    if ($str_PHASE_ID == "" || $str_PHASE_ID == null) {
        $str_PHASE_ID = "%%";
    }*/
    $lg_CLIENT_ID = $db->quote($lg_CLIENT_ID);
    $str_BRANCHE_ID = $db->quote($str_BRANCHE_ID);
    //$str_PHASE_ID = $db->quote($str_PHASE_ID);

    $message = "Impossible de générer les courriers";
    $i = 0;

    if( ($str_DATE_DEBUT<>'' or $str_DATE_DEBUT<>null) and ($str_DATE_FIN<>'' or $str_DATE_FIN<> null)){
        $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);
        $str_DATE_FIN = $db->quote($str_DATE_FIN);
        if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
            $str_DATE_DEBUT = "%%";
        }
        if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
            $str_DATE_FIN = "%%";
        }
        $sql = "SELECT t_facture.*, str_NAME, t_branche.str_LIBELLE, str_TEL, str_BP "
            ."FROM t_facture "
            ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
            ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
            . "JOIN t_security ON t_client.str_CREATED_BY = t_security.str_SECURITY_ID "
            ."JOIN t_service ON t_service.lg_SERVICE_ID = t_security.lg_SERVICE_ID "
            ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE between $str_DATE_DEBUT AND $str_DATE_FIN AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID  AND lg_FACTURE_ID LIKE $lg_FACTURE_ID AND t_service.lg_SERVICE_ID LIKE $lg_SERVICE_ID";
    }
    else{
        if($str_DATE_DEBUT<>''){
            if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
                $str_DATE_DEBUT = "%%";
            }
            $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);

            $sql = "SELECT t_facture.*, str_NAME, t_branche.str_LIBELLE, str_TEL, str_BP "
                ."FROM t_facture "
                ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
                ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
                . "JOIN t_security ON t_client.str_CREATED_BY = t_security.str_SECURITY_ID "
                ."JOIN t_service ON t_service.lg_SERVICE_ID = t_security.lg_SERVICE_ID "
                ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE LIKE $str_DATE_DEBUT AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID AND lg_FACTURE_ID LIKE $lg_FACTURE_ID AND t_service.lg_SERVICE_ID LIKE $lg_SERVICE_ID";
        }
        else{
            if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
                $str_DATE_FIN = "%%";
            }
            $str_DATE_FIN = $db->quote($str_DATE_FIN);

            $sql = "SELECT t_facture.*, str_NAME, t_branche.str_LIBELLE, str_TEL, str_BP "
                ."FROM t_facture "
                ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
                ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
                . "JOIN t_security ON t_client.str_CREATED_BY = t_security.str_SECURITY_ID "
                ."JOIN t_service ON t_service.lg_SERVICE_ID = t_security.lg_SERVICE_ID "
                ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE LIKE $str_DATE_FIN AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID AND lg_FACTURE_ID LIKE $lg_FACTURE_ID AND t_service.lg_SERVICE_ID LIKE $lg_SERVICE_ID";
        }
    }
    //echo $sql;
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $item_result) {
        $str_DIRECTORY_NAME = $item_result['str_NAME'];
        $str_DIRECTORY_NAME = str_replace(' ', '_', $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace('.', '', $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace("/", "-", $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace("*", "", $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace("\\", "", $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace("#", "", $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace("?", "", $str_DIRECTORY_NAME);

        $structure = "courriers_avec".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/". $str_DIRECTORY_NAME."/";
        if($str_TYPE == 'sansentete')
            $structure = "courriers_sans".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/". $str_DIRECTORY_NAME."/";

        $intResult++;
        $code_statut = "1";
        $cpt++;

        $cli = str_replace(" ","_", $item_result['str_NAME']);
        $cli = str_replace("/", "-", $cli);
        $cli = str_replace("*", "", $cli);
        $cli = str_replace("\\", "", $cli);
        $cli = str_replace("#", "", $cli);
        $cli = str_replace("?", "", $cli);
        //var_dump($cli);
        $link_file = $cli.'-'.$item_result['str_POLICE'] .'-'.$item_result['int_NUMFACT'].'_'.$item_result['dt_DATE']. '.pdf';
        $str_EXTRACTION_ID = addHash($structure . $link_file, $item_result['str_LIBELLE'], $item_result['str_NAME'], $file_name . '.zip', $item_result['lg_BRANCHE_ID'], $item_result['lg_FACTURE_ID'], $item_result['str_POLICE'], $item_result['dt_EFFET'].' - '.$item_result['dt_ECHEANCE'], $item_result['int_ACCESSOIRE'], $db);

        ob_start();
        //echo $str_TYPE;
        if($str_TYPE == 'sansentete')
        {
            include dirname(__FILE__) . '/composant/com_pdf/facture.php';
        }
        else
        {
            include dirname(__FILE__) . '/composant/com_pdf_entete/facture.php';
        }
        $content = ob_get_clean();

        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        $code_statut  = 1;
        if(!mkdir($structure, 0, true)) {//0777
            $code_statut = 0;
            $message = "Le dossier " . $structure . " à déjà été créé aujourd'hui.";
        }
        /*$sql2 = "UPDATE t_courrier "
            . "SET str_STATUT = 'printf', str_UPDATED_BY = $str_UPDATED_BY, dt_UPDATED = $dt_UPDATED  "
            . "WHERE int_COURRIER_ID = ".$item_result['int_COURRIER_ID'];

        $db->exec($sql2);*/
        //echo $structure .$link_file;
        $html2pdf->output($structure .$link_file , 'F'); //D pour forcer le téléchargement, F pour sauvegarder sur le serveur
        //echo $data = $structure .$link_file;
        //header("location:".basename($structure .$link_file));
    }

    /**
     * Si la variable $structure est modifié alors il doit etre aussi modifié dans le function
     */

    if($interval == 1 AND !createZipFile($file_name, $str_TYPE)){
        //$code_statut = 0;
        $message = "Le fichier zip n'a pas pu être créé.";
    }

    $arrayJson["results"] = $message;
    $arrayJson["nbr_courrier_genere"] = $cpt;
    $arrayJson["link_file"] = $file_name.'.zip';
    $arrayJson["code_statut"] = $code_statut;
    $arrayJson["desc_statut"] = $db->errorInfo();
    echo "[" . json_encode($arrayJson) . "]";
}
function printCourriersAllSans($lg_FACTURE_ID, $str_INTERMEDIAIRE_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $str_TYPE, $db)
{

    set_time_limit(0);
    $dt_UPDATED = $db->quote(gmdate("Y-m-d, H:i:s"));
    $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
    $str_POLICE = "";
    $cpt = 0;
    $file_name = 'courriers-du-' . date("d-m-Y");
    $arrayJson = array();
    $arraySql = array();
    $code_statut = "0";
    $str_STATUT = "delete";
    $intResult = 0;
    $interval = 0;
    if ($lg_FACTURE_ID == "" || $lg_FACTURE_ID == null) {
        $interval = 1;
        $lg_FACTURE_ID = "%%";
    }
    $lg_FACTURE_ID = $db->quote($lg_FACTURE_ID);
    if ($str_INTERMEDIAIRE_ID == "" || $str_INTERMEDIAIRE_ID == null) {
        $str_INTERMEDIAIRE_ID = "%%";
    }
    if ($str_BRANCHE_ID == "" || $str_BRANCHE_ID == null) {
        $str_BRANCHE_ID = "%%";
    }
    if ($str_PHASE_ID == "" || $str_PHASE_ID == null) {
        $str_PHASE_ID = "%%";
    }
    $str_INTERMEDIAIRE_ID = $db->quote($str_INTERMEDIAIRE_ID);
    $str_BRANCHE_ID = $db->quote($str_BRANCHE_ID);
    $str_PHASE_ID = $db->quote($str_PHASE_ID);

    $message = "Impossible de générer les courriers";
    $i = 0;

    if (($str_DATE_DEBUT <> '' or $str_DATE_DEBUT <> null) and ($str_DATE_FIN <> '' or $str_DATE_FIN <> null)) {
        /*$str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);
        $str_DATE_FIN = $db->quote($str_DATE_FIN);*/
        if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
            $str_DATE_DEBUT = "%%";
        }
        if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
            $str_DATE_FIN = "%%";
        }

        $sql = "SELECT * "
            . " FROM v_courriers "
            . " WHERE str_INTERMEDIAIRE_ID LIKE $str_INTERMEDIAIRE_ID AND str_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_FIN_GARANTIE between '$str_DATE_DEBUT' AND '$str_DATE_FIN' AND str_PHASE_ID LIKE $str_PHASE_ID AND str_STATUT <> '$str_STATUT' AND str_COURRIER_ID LIKE $lg_FACTURE_ID ";

    } else {
        if ($str_DATE_DEBUT <> '') {
            if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
                $str_DATE_DEBUT = "%%";
            }
            $sql = "SELECT * "
                . " FROM v_courriers "
                . " WHERE str_INTERMEDIAIRE_ID LIKE $str_INTERMEDIAIRE_ID AND str_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_FIN_GARANTIE LIKE '$str_DATE_DEBUT' AND str_PHASE_ID LIKE $str_PHASE_ID AND str_STATUT <> '$str_STATUT'  AND str_COURRIER_ID LIKE $lg_FACTURE_ID ";

        } else {
            if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
                $str_DATE_FIN = "%%";
            }
            $sql = "SELECT * "
                . " FROM v_courriers "
                . " WHERE str_INTERMEDIAIRE_ID LIKE $str_INTERMEDIAIRE_ID AND str_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_FIN_GARANTIE LIKE '$str_DATE_FIN' AND str_PHASE_ID LIKE $str_PHASE_ID AND str_STATUT <> '$str_STATUT'  AND str_COURRIER_ID LIKE $lg_FACTURE_ID ";
        }
    }
    //echo $sql;
    $stmt = $db->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $item_result) {
        $str_DIRECTORY_NAME = $item_result['str_CODE_INTERMEDIAIRE'];
        $str_DIRECTORY_NAME = str_replace(' ', '_', $str_DIRECTORY_NAME);
        $str_DIRECTORY_NAME = str_replace('.', '', $str_DIRECTORY_NAME);

        $structure = "courriers_avec" . date('Y') . "/" . str_replace(' ', '_', strtolower($_SESSION['nom'])) . "/" . date('d-m-Y') . "/" . $str_DIRECTORY_NAME . "/";
        if ($str_TYPE == 'sansentete')
            $structure = "courriers_sans" . date('Y') . "/" . str_replace(' ', '_', strtolower($_SESSION['nom'])) . "/" . date('d-m-Y') . "/" . $str_DIRECTORY_NAME . "/";

        $intResult++;
        $code_statut = "1";
        $cpt++;

        $cli = str_replace(" ", "_", $item_result['str_CLIENT']);
        $cli = str_replace("/", "-", $cli);
        $cli = str_replace("*", "", $cli);
        $cli = str_replace("\\", "", $cli);
        $cli = str_replace("#", "", $cli);
        $cli = str_replace("?", "", $cli);

        $link_file = $cli . '-' . $item_result['str_POLICE'] . '.pdf';
        //if($item_result['str_INTERMEDIAIRE_ID'] == 'j80zs5b9f806d96cae') echo $link_file;
        //$str_EXTRACTION_ID = addHash($structure . $link_file, $item_result['str_CODE_INTERMEDIAIRE'], $item_result['str_CLIENT'], $file_name . '.zip', $item_result['str_INTERMEDIAIRE_ID'], $item_result['int_COURRIER_ID'], $db);

        $str_EXTRACTION_ID = addHash($structure . $link_file, $item_result['str_CODE_INTERMEDIAIRE'], $item_result['str_CLIENT'], $file_name . '.zip', $item_result['str_INTERMEDIAIRE_ID'], $item_result['int_COURRIER_ID'], $item_result['str_POLICE'], $item_result['dt_DATE_EFFET'] . ' - ' . $item_result['dt_FIN_GARANTIE'], $item_result['int_ACCESSOIRE'], $db);
        ob_start();
        //echo $str_TYPE;
        switch (strtolower($item_result['str_DECISION_FINAL'])) {
            case 'renouveler':
                if ($str_TYPE == 'sansentete') {
                    include dirname(__FILE__) . '/composant/com_pdf/renouveler.php';
                } else {
                    include dirname(__FILE__) . '/composant/com_pdf_entete/renouveler.php';
                }
                break;
            case 'Resilier':
                if ($str_TYPE == 'sansentete') {
                    include dirname(__FILE__) . '/composant/com_pdf/resilier.php';
                } else {
                    include dirname(__FILE__) . '/composant/com_pdf_entete/renouveler.php';
                }
                break;
            case 'ajuster':
                if ($str_TYPE == 'sansentete') {
                    include dirname(__FILE__) . '/composant/com_pdf/ajuster.php';
                } else {
                    include dirname(__FILE__) . '/composant/com_pdf_entete/ajuster.php';
                }
                break;
        }
        $content = ob_get_clean();

        $html2pdf = new Html2Pdf('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        $code_statut = 1;
        if (!mkdir($structure, 0, true)) {//0777
            $code_statut = 0;
            $message = "Le dossier " . $structure . " à déjà été créé aujourd'hui.";
        }
        //echo $structure .$link_file;
        $html2pdf->output($structure . $link_file, 'F'); //D pour forcer le téléchargement, F pour sauvegarder sur le serveur
        //echo $data = $structure .$link_file;
        //header("location:".basename($structure .$link_file));
    }

    /**
     * Si la variable $structure est modifié alors il doit etre aussi modifié dans le function
     */

    if ($interval == 1 AND !createZipFile($file_name, $str_TYPE)) {
        //$code_statut = 0;
        $message = "Le fichier zip n'a pas pu être créé.";
    }

    $arrayJson["results"] = $message;
    $arrayJson["nbr_courrier_genere"] = $cpt;
    $arrayJson["link_file"] = $file_name . '.zip';
    $arrayJson["code_statut"] = $code_statut;
    $arrayJson["desc_statut"] = $db->errorInfo();
    echo "[" . json_encode($arrayJson) . "]";
}