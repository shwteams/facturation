<?php

//session_start();
include_once("php_to_pdf/vendor/autoload.php");
include_once 'parameters.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

if (isset($_GET["task"])) {
    $task = $_GET["task"];
}
switch ($task) {
    case 'printf':
        echo printCourriers($str_COURRIER_ID, $str_INTERMEDIAIRE_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $db);
        break;
}

	function printCourriers($str_COURRIER_ID, $str_INTERMEDIAIRE_ID, $str_BRANCHE_ID, $str_PHASE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $db){


        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;
        if ($str_COURRIER_ID == "" || $str_COURRIER_ID == null) {
            $str_COURRIER_ID = "%%";
        }
        $str_COURRIER_ID = $db -> quote($str_COURRIER_ID);
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

        if( ($str_DATE_DEBUT<>'' or $str_DATE_DEBUT<>null) and ($str_DATE_FIN<>'' or $str_DATE_FIN<> null)){
            $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);
            $str_DATE_FIN = $db->quote($str_DATE_FIN);
            if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
                $str_DATE_DEBUT = "%%";
            }
            if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
                $str_DATE_FIN = "%%";
            }
            $sql = "SELECT * "
                ."FROM v_courriers "
                ."WHERE str_INTERMEDIAIRE_ID LIKE $str_INTERMEDIAIRE_ID AND str_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_FIN_GARANTIE between $str_DATE_DEBUT AND $str_DATE_FIN AND str_PHASE_ID LIKE $str_PHASE_ID ";

        }
        else{
            if($str_DATE_DEBUT<>''){
                if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
                    $str_DATE_DEBUT = "%%";
                }
                $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);

                $sql = "SELECT * "
                    ."FROM v_courriers "
                    ."WHERE str_INTERMEDIAIRE_ID LIKE $str_INTERMEDIAIRE_ID AND str_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_FIN_GARANTIE LIKE $str_DATE_DEBUT AND str_PHASE_ID LIKE $str_PHASE_ID ";

            }
            else{
                if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
                    $str_DATE_FIN = "%%";
                }
                $str_DATE_FIN = $db->quote($str_DATE_FIN);

                $sql = "SELECT * "
                    ."FROM v_courriers "
                    ."WHERE str_INTERMEDIAIRE_ID LIKE $str_INTERMEDIAIRE_ID AND str_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_FIN_GARANTIE LIKE $str_DATE_FIN AND str_PHASE_ID LIKE $str_PHASE_ID ";

            }
        }
        //echo $sql;
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
			try {
				$html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
				$html2pdf->pdf->SetDisplayMode('fullpage');
					
				$task = $item_result['str_DECISION_FINAL'];
				switch($task){
					case 'renouveler':
					break;
					case '':
					break;
					case '':
					break;
					default:
						echo "Type de données imprévue";
					break;
				}
				ob_start();
				include dirname(__FILE__).'/res/about.php';
				$content = ob_get_clean();

				$html2pdf->writeHTML($content);
				$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2);
				$html2pdf->output('about.pdf');
			} catch (Html2PdfException $e) {
				$formatter = new ExceptionFormatter($e);
				echo $formatter->getHtmlMessage();
			}

        }

        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
	