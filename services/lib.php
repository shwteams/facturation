<?php
/**
CONTIENT TOUTES LES FONCTIONS DE MON APPLICATIONS
*/
    error_reporting(E_ALL ^ E_DEPRECATED);
    ini_set('display_errors', FALSE);
    ini_set('display_startup_errors', FALSE);
    //ini_set('session.gc_maxlifetime', 36000);
    //header('Access-Control-Allow-Origin: * '); a decommenter lorsque je vais la coupler avec une appli mobile
    //include 'SMSManager.php';

    include_once('classes/PHPExcel.php');
    include_once('classes/PHPExcel/Reader/Excel2007.php');

    if (!isset($_SESSION)) {
        session_start();
	}
    function DoConnexion($host, $SECURITY, $pass, $dbname) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        try {
            $db = new PDO($dsn, $SECURITY, $pass);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return $db;
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
    }
    function DoDeconnexion($db) {
        //echo "deconnexion";
        addActivity($db, "deconnexion");
        session_destroy();
        header("location:../../login.php");
    }
    function DoAutoDeconnexion(){
        $arrayJson["results"] = "Deconnexion auto";
        $arrayJson["total"] = 0;
        $arrayJson["desc_statut"] = "Une erreur c'est produite !";
        $arrayJson["code_statut"] = 0;
        if(empty($_SESSION['str_SECURITY_ID'])){
            //addActivity($db, "AutoDisconnect");
            $arrayJson["results"] = "Deconnexion auto";
            $arrayJson["total"] = 0;
            $arrayJson["desc_statut"] = "Une erreur c'est produite !";
            $arrayJson["code_statut"] = 1;
        }
        echo "[" . json_encode($arrayJson) . "]";
    }
    function generatePassword($algo, $pwd) {
        $data = array();
        $data["ALGO"] = $algo;
        $data["DATE"] = $pwd;
        ksort($data);
        $message = http_build_query($data);
        $cle_bin = pack("a", KEY_PASSWORD);
        return strtoupper(hash_hmac(strtolower($data["ALGO"]), $message, $cle_bin));
    }
    function generateCodeName($algo, $name) {
        $data = array();
        $data["ALGO"] = $algo;
        $data["DATE"] = $name;
        ksort($data);
        $message = http_build_query($data);
        $cle_bin = pack("a", KEY_NAME);
        return strtoupper(hash_hmac(strtolower($data["ALGO"]), $message, $cle_bin));
    }

    function RandomString() {
        $characters = "0123456789abcdefghijklmnopqrstxwz";
        $randstring = '';
        for ($i = 0; $i < 5; $i++) {
            $randstring = $randstring . $characters[rand(0, strlen($characters))];
        }
        $unique = uniqid($randstring, "");
        return $unique;
    }
    function setUpdatePassword($db)	{
        $str_SECURITY_ID = $_SESSION['str_SECURITY_ID'];
        $str_SECURITY_ID = $db -> quote($str_SECURITY_ID);
        $arrayJson = array();
        $sql = "UPDATE t_security "
                . "SET bl_IS_UPDATE = 0 "
                . "WHERE str_SECURITY_ID = $str_SECURITY_ID;";
    //    echo $sql;
        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Modification effectué avec succès.";
                $code_statut = "1";
                $_SESSION['bl_IS_UPDATE'] = 0;
            } else {
                $message = "Erreur lors de la prise en compte de la réclamation.";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
        header("location:../../index.php");
    }
    function getCountry($ip) {
        //$ip_data = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip);
        /*if($ip_data && $ip_data->geoplugin_countryName != null){
            return $ip_data->geoplugin_countryName.' ('.$ip_data->geoplugin_city.' '.$ip_data->geoplugin_countryCode.')';
        }*/
        return "http://www.geoplugin.net/json.gp?ip=".$ip;
    }

    function connexion($str_LOGIN, $str_PASSWORD, $str_ADRESSE_IP, $str_DETAILS, $db) {
        sleep(2);
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "enable";
        $intResult = 0;
        $str_LOGIN = $db -> quote(htmlentities(trim($str_LOGIN)));
        $str_PASSWORD = generatePassword(ALGO, $str_PASSWORD);
        $str_PASSWORD = $db -> quote(htmlentities(trim($str_PASSWORD)));
        //var_dump($arrayJson);
        $sql = "SELECT * FROM t_security WHERE str_LOGIN LIKE " . $str_LOGIN . " AND str_PASSWORD LIKE " . $str_PASSWORD . " AND str_STATUT LIKE '" . $str_STATUT . "'";
        
        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($result) > 0) {
            foreach ($result as $item_result) {
                //$date = gmdate("Y-m-d, H:i:s");
                //setSecuritydtLASTCONNECTIONDATE($item_result['str_SECURITY_ID'], $date, $db);
                $arraySql[] = $item_result;
                $intResult++;
                $code_statut = "1";
                $_SESSION['nom'] = $item_result['str_NOM']. ' ' .$item_result['str_PRENOM'];
                $_SESSION['email'] = $item_result['str_EMAIL'];
                $_SESSION['login'] = $item_result['str_LOGIN'];
                $_SESSION['str_SECURITY_ID'] = $item_result['str_SECURITY_ID'];
                $_SESSION['str_PRIV_ID'] = $item_result['str_PRIVILEGE'];
                $_SESSION['str_ADRESS_IP'] =  $str_ADRESSE_IP;
                $_SESSION['lg_SERVICE_ID'] =  $item_result['lg_SERVICE_ID'];
                $_SESSION['str_NAVIGATEUR'] = $str_DETAILS;
                addActivity($db, "connexion");
            }

            $arrayJson["results"] = "success";
            $arrayJson["total"] = $intResult;
            $arrayJson["desc_statut"] = "Connexion reussie";
            $arrayJson["code_statut"] = $code_statut;
        } else {
            $arrayJson["results"] = "le nom d'utilisateur ou le mot de passe est incorrect";
            $arrayJson["total"] = $intResult;
            $arrayJson["desc_statut"] = "Une erreur c'est produite !";
            $arrayJson["code_statut"] = $code_statut;
        }
        
        echo "[" . json_encode($arrayJson) . "]";
    }
    function addActivity($db, $str_STATUT){
        $str_ACTIVITY_ID = RandomString();
        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $payes = getCountry($_SERVER['REMOTE_ADDR']);

        $sql = "INSERT INTO t_activity(str_ACTIVITY_ID, str_LOGIN, str_NOM, str_PRIV,dt_CREATED, str_STATUT,str_SECURITY_ID, str_ADRESSE_IP,str_NAVIGATEUR,str_PAYS)"
            . "VALUES (:str_ACTIVITY_ID, :str_LOGIN, :str_NOM,:str_PRIV,$dt_CREATED,:str_STATUT,:str_SECURITY_ID,:str_ADRESSE_IP,:str_NAVIGATEUR,:str_PAYS)";
        try {
            $stmt = $db->prepare($sql);
            $stmt->BindParam(':str_ACTIVITY_ID', $str_ACTIVITY_ID);
            $stmt->BindParam(':str_LOGIN', $_SESSION['login']);
            $stmt->BindParam(':str_NOM', $_SESSION['nom']);
            $stmt->BindParam(':str_PRIV', $_SESSION['str_PRIV_ID']);
            $stmt->BindParam(':str_STATUT', $str_STATUT);
            $stmt->BindParam(':str_SECURITY_ID', $_SESSION['str_SECURITY_ID']);
            $stmt->BindParam(':str_ADRESSE_IP', $_SESSION['str_ADRESS_IP']);
            $stmt->BindParam(':str_NAVIGATEUR', $_SESSION['str_NAVIGATEUR']);
            $stmt->BindParam(':str_PAYS', $payes);
            //var_dump($stmt);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
    }
    function getAllSecurity( $str_SECURITY_ID, $db) {
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;
        if ($str_SECURITY_ID == "" || $str_SECURITY_ID == null) {
            $str_SECURITY_ID = "%%";
        }
        $str_SECURITY_ID = $db -> quote($str_SECURITY_ID);

        $sql = "SELECT t_security.*, t_service.lg_SERVICE_ID, t_service.str_LIBELLE FROM t_security "
                . " JOIN t_service ON t_service.lg_SERVICE_ID = t_security.lg_SERVICE_ID "
                . " WHERE str_SECURITY_ID LIKE " . $str_SECURITY_ID . " AND t_security.str_STATUT <> '".$str_STATUT."' "
                . " ORDER BY dt_CREATED DESC;";
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
        }

        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function isExistCodeSecurity($str_SECURITY_ID, $db) {
        $str_STATUT = 'delete';
        $str_SECURITY_ID = $db->quote($str_SECURITY_ID);
        $sql = "SELECT * FROM t_security WHERE str_SECURITY_ID LIKE " . $str_SECURITY_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($str_SECURITY_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }

    function is_existe_use($db, $login, $mode, $str_SECURITY_ID = ""){
        $str_STATUT = 'delete';
        $login = $db->quote($login);
        if($mode === "insert"){
            $sql = "SELECT * FROM t_security WHERE str_login LIKE " . $login . " AND str_STATUT <> '" . $str_STATUT . "'";
        }
        else{
            $sql = "SELECT * FROM t_security WHERE str_login LIKE " . $login . " AND str_STATUT <> '" . $str_STATUT . "' AND str_SECURITY_ID <> '".$str_SECURITY_ID."'";
        }

        try {
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) >= 1) {
                return false;
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
            return false;
        }
        return true;
    }
    function addSecurity($str_NAME, $str_LASTNAME, $str_EMAIL, $str_LOGIN, $str_PASSWORD, $str_PASSWORD_CONF, $str_PRIVILEGE, $lg_SERVICE_ID, $db) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";

        if(is_existe_use($db, $str_LOGIN, "insert")){
            if($str_PASSWORD == $str_PASSWORD_CONF) {
                $str_SECURITY_ID = RandomString();
                $str_PASSWORD = generatePassword(ALGO, $str_PASSWORD);
                //$str_PASSWORD = $db->quote($str_PASSWORD);
                $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
                $sql = "INSERT INTO t_security(str_SECURITY_ID, str_LOGIN, str_PASSWORD, str_NOM, str_PRENOM,str_EMAIL, str_PRIVILEGE, str_STATUT, dt_CREATED, str_CREATED_BY, lg_SERVICE_ID)"
                    . "VALUES (:str_SECURITY_ID,:str_LOGIN,:str_PASSWORD,:str_NOM,:str_PRENOM,:str_EMAIL,:str_PRIVILEGE, :str_STATUT,$dt_CREATED,:str_CREATED_BY, :lg_SERVICE_ID)";
                try {
                    if (!isExistCodeSecurity($str_SECURITY_ID, $db)) {

                        $stmt = $db->prepare($sql);
                        $str_STATUT = "enable";
                        $stmt->BindParam(':str_SECURITY_ID', $str_SECURITY_ID);
                        $stmt->BindParam(':str_LOGIN', $str_LOGIN);
                        $stmt->BindParam(':str_PASSWORD', $str_PASSWORD);
                        $stmt->BindParam(':str_NOM', $str_NAME);
                        $stmt->BindParam(':str_PRENOM', $str_LASTNAME);
                        $stmt->BindParam(':str_EMAIL', $str_EMAIL);
                        $stmt->BindParam(':str_PRIVILEGE', $str_PRIVILEGE);
                        $stmt->BindParam(':str_STATUT', $str_STATUT);
                        $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                        $stmt->BindParam(':lg_SERVICE_ID', $lg_SERVICE_ID);
                        //var_dump($stmt);
                        if ($stmt->execute()) {
                            $message = "Insertion effectué avec succès";
                            $code_statut = "1";
                        } else {
                            $message = "Erreur lors de l'insertion";
                            $code_statut = "0";
                        }
                    } else {
                        $message = "Ce Code  : \" " . $str_SECURITY_ID . " \" de table existe déja! \r\n";
                        $code_statut = "0";
                    }
                } catch (PDOException $e) {
                    die("Erreur ! : " . $e->getMessage());
                }
            } else {
                $message = "Les mots de passe sont identique.";
                $code_statut = "0";
            }
        }
        else{
            $message = "Ce nom d'utilisateur est déjà utilisé.";
            $code_statut = "0";
        }

        $arrayJson["results"] = $message;
        $arrayJson["code_statut"] = $code_statut;
        $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function deleteSecurity($str_SECURITY_ID, $db) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "delete";
        $str_SECURITY_ID = $db->quote($str_SECURITY_ID);
        $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
        $sql = "UPDATE t_security "
                . "SET str_STATUT = '$str_STATUT',"
                . "str_UPDATED_BY = $str_UPDATED_BY, "
                . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "' "
                . "WHERE str_SECURITY_ID = $str_SECURITY_ID";
        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Suppression effectuée avec succès";
                $code_statut = "1";
            } else {
                $message = "Erreur lors de la modification";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function editSecurity($str_SECURITY_ID, $str_NAME, $str_LASTNAME, $str_EMAIL, $str_LOGIN, $str_PASSWORD, $str_PASSWORD_CONF,$str_PRIVILEGE, $lg_SERVICE_ID, $db)
    {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        if(is_existe_use($db, $str_LOGIN, "edit", $str_SECURITY_ID)){
            $str_SECURITY_ID = $db->quote($str_SECURITY_ID);
            $str_NAME = $db->quote($str_NAME);
            $str_LASTNAME=$db->quote($str_LASTNAME);
            $str_LOGIN=$db->quote($str_LOGIN);
            $str_EMAIL=$db->quote($str_EMAIL);
            $lg_SERVICE_ID=$db->quote($lg_SERVICE_ID);
            $str_PRIVILEGE=$db->quote($str_PRIVILEGE);
            if ($str_PASSWORD_CONF === $str_PASSWORD){
                $str_PASSWORD = generatePassword(ALGO, $str_PASSWORD);
                $str_PASSWORD = $db->quote($str_PASSWORD);
                //$str_ILLUSTRATION = NULL;
                $sql = "UPDATE t_security "
                    . "SET str_NOM = $str_NAME,"
                    . "str_PRENOM = $str_LASTNAME,"
                    . "str_LOGIN = $str_LOGIN,"
                    . "str_PASSWORD = $str_PASSWORD,"
                    . "str_EMAIL = $str_EMAIL,"
                    . "str_UPDATED_BY = '" . $_SESSION['str_SECURITY_ID'] . "',"
                    . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "',"
                    . " str_PRIVILEGE = $str_PRIVILEGE, "
                    . " lg_SERVICE_ID = $lg_SERVICE_ID"
                    . " WHERE str_SECURITY_ID = $str_SECURITY_ID";

                try {
                    $sucess = $db->exec($sql);
                    if ($sucess > 0) {
                        $message = "Modification effectuée avec succès";
                        $code_statut = "1";
                    } else {
                        $message = "Erreur lors de la modification";
                        $code_statut = "0";
                    }
                } catch (PDOException $e) {
                    die("Erreur ! : " . $e->getMessage());
                }
            }
            else {
                $message = "Les mots de passe ne sont pas identique.";
                $code_statut = "0";
            }
        }
        else{
            $message = "Le login est déjà utilisé.";
            $code_statut = "0";
        }

        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
    //    $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function getAllBranche($str_BRANCHE_ID, $db){
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;
        if ($str_BRANCHE_ID == "" || $str_BRANCHE_ID == null) {
            $str_BRANCHE_ID = "%%";
        }
        $str_BRANCHE_ID = $db -> quote($str_BRANCHE_ID);

        $sql = "SELECT * FROM t_branche "
            . " WHERE lg_BRANCHE_ID LIKE " . $str_BRANCHE_ID . " AND str_STATUT <> '".$str_STATUT."' "
            . " ORDER BY dt_CREATED DESC;";
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
        }
        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function isExistCodePhase($str_PHASE_ID, $db) {
        $str_STATUT = 'delete';
        $str_PHASE_ID = $db->quote($str_PHASE_ID);
        $sql = "SELECT * FROM t_phase WHERE str_PHASE_ID LIKE " . $str_PHASE_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($str_PHASE_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function addPhase($db, $str_LIBELLE, $str_DATE_DEBUT, $str_DATE_FIN) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $str_PHASE_ID = RandomString();

        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_phase(str_PHASE_ID, str_LIBELLE, dt_DEBUT, dt_FIN, str_STATUT, dt_CREATED, str_CREATED_BY)"
            . "VALUES (:str_PHASE_ID, :str_LIBELLE, :dt_DEBUT, :dt_FIN, :str_STATUT,$dt_CREATED,:str_CREATED_BY)";
        try {
            if (!isExistCodePhase($str_PHASE_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':str_PHASE_ID', $str_PHASE_ID);
                $stmt->BindParam(':str_LIBELLE', $str_LIBELLE);
                $stmt->BindParam(':dt_DEBUT', $str_DATE_DEBUT);
                $stmt->BindParam(':dt_FIN', $str_DATE_FIN);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                //var_dump($stmt);
                if ($stmt->execute()) {
                    $message = "Insertion effectué avec succès";
                    $code_statut = "1";
                } else {
                    $message = "Erreur lors de l'insertion";
                    $code_statut = "0";
                }
            } else {
                $message = "Ce Code  : \" " . $str_PHASE_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

        $arrayJson["results"] = $message;
        $arrayJson["code_statut"] = $code_statut;
        $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function deleteBranche($lg_BRANCHE_ID, $db) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "delete";
        $lg_BRANCHE_ID = $db->quote($lg_BRANCHE_ID);
        $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
        $sql = "UPDATE t_branche "
            . "SET str_STATUT = '$str_STATUT',"
            . "str_UPDATED_BY = $str_UPDATED_BY, "
            . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "' "
            . "WHERE lg_BRANCHE_ID = $lg_BRANCHE_ID";
        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Suppression effectuée avec succès";
                $code_statut = "1";
            } else {
                $message = "Erreur lors de la modification";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function editBranche($lg_BRANCHE_ID, $str_LIBELLE, $db)
    {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        //ECHO $str_ETAT_ID;
        $str_LIBELLE = $db->quote($str_LIBELLE);
        $lg_BRANCHE_ID = $db->quote($lg_BRANCHE_ID);
        $sql = "UPDATE t_branche "
            . "SET str_LIBELLE = $str_LIBELLE, "
            . "str_UPDATED_BY = '" . $_SESSION['str_SECURITY_ID'] . "',"
            . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "'"
            . " WHERE lg_BRANCHE_ID = $lg_BRANCHE_ID";

        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Modification effectuée avec succès";
                $code_statut = "1";
            } else {
                $message = "Erreur lors de la modification";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
        //    $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }

    function isExistIdentifiant($str_IDENTIFIANT, $db) {
        $str_STATUT = 'delete';
        $str_IDENTIFIANT = $db->quote($str_IDENTIFIANT);
        $sql = "SELECT str_INDENTIFIANT FROM t_courrier WHERE str_INDENTIFIANT LIKE " . $str_IDENTIFIANT . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($str_IDENTIFIANT)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function getAllFacture($str_COURRIER_ID, $lg_CLIENT_ID, $str_BRANCHE_ID, $str_DATE_DEBUT, $str_DATE_FIN, $str_POLICE, $db){
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;
        if ($str_COURRIER_ID == "" || $str_COURRIER_ID == null) {
            $str_COURRIER_ID = "%%";
        }
        $str_COURRIER_ID = $db -> quote($str_COURRIER_ID);

        if ($str_BRANCHE_ID == "" || $str_BRANCHE_ID == null) {
            $str_BRANCHE_ID = "%%";
        }
        if ($lg_CLIENT_ID == "" || $lg_CLIENT_ID == null) {
            $lg_CLIENT_ID = "%%";
        }
        if ($str_POLICE == "" || $str_POLICE == null) {
            $str_POLICE = "%%";
        }
        $str_POLICE = $db -> quote($str_POLICE);

        $str_BRANCHE_ID = $db->quote($str_BRANCHE_ID);
        $lg_CLIENT_ID = $db->quote($lg_CLIENT_ID);
        $lg_SERVICE_ID = $db->quote($_SESSION['lg_SERVICE_ID']);

        if( ($str_DATE_DEBUT<>'' or $str_DATE_DEBUT<>null) and ($str_DATE_FIN<>'' or $str_DATE_FIN<> null)){
            $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);
            $str_DATE_FIN = $db->quote($str_DATE_FIN);
            if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
                $str_DATE_DEBUT = "%%";
            }
            if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
                $str_DATE_FIN = "%%";
            }
            $sql = "SELECT t_facture.*, str_NAME, str_LIBELLE "
                ."FROM t_facture "
                ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
                ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
                ."JOIN t_service ON t_service.lg_SERVICE_ID = $lg_SERVICE_ID "
                ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE between $str_DATE_DEBUT AND $str_DATE_FIN AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID  AND str_POLICE LIKE $str_POLICE AND t_facture.str_STATUT <> '$str_STATUT' ";
        }
        else{
            if($str_DATE_DEBUT<>''){
                if ($str_DATE_DEBUT == "" || $str_DATE_DEBUT == null) {
                    $str_DATE_DEBUT = "%%";
                }
                $str_DATE_DEBUT = $db->quote($str_DATE_DEBUT);

                $sql = "SELECT t_facture.*, str_NAME, str_LIBELLE "
                    ."FROM t_facture "
                    ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
                    ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
                    ."JOIN t_service ON t_service.lg_SERVICE_ID = $lg_SERVICE_ID "
                    ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE LIKE $str_DATE_DEBUT AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID  AND str_POLICE LIKE $str_POLICE AND t_facture.str_STATUT <> '$str_STATUT' ";
            }
            else{
                if ($str_DATE_FIN == "" || $str_DATE_FIN == null) {
                    $str_DATE_FIN = "%%";
                }
                $str_DATE_FIN = $db->quote($str_DATE_FIN);

                $sql = "SELECT t_facture.*, str_NAME, t_branche.str_LIBELLE "
                    ."FROM t_facture "
                    ."JOIN t_branche ON t_branche.lg_BRANCHE_ID = t_facture.lg_BRANCHE_ID "
                    ."JOIN t_client ON t_client.lg_CLIENT_ID = t_facture.lg_CLIENT_ID "
                    ."JOIN t_service ON t_service.lg_SERVICE_ID = $lg_SERVICE_ID "
                    ."WHERE t_facture.lg_BRANCHE_ID LIKE $str_BRANCHE_ID AND dt_ECHEANCE LIKE $str_DATE_FIN AND t_facture.lg_CLIENT_ID LIKE $lg_CLIENT_ID  AND str_POLICE LIKE $str_POLICE AND t_facture.str_STATUT <> '$str_STATUT' ";
            }
        }
        //echo $sql;
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
        }

        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function getIdPhase($str_PHASE_ID, $db){
        $str_STATUT = 'delete';
        $str_PHASE_ID = $db->quote($str_PHASE_ID);
        $sql = "SELECT * FROM t_phase WHERE str_PHASE_ID LIKE " . $str_PHASE_ID . " AND str_STATUT <> '" . $str_STATUT . "'";

        if(!empty($str_PHASE_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    foreach ($result as $item_result) {
                        return $item_result['str_PHASE_ID'];
                    }
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function getIdBranche($str_BRANCHE, $db){
        $str_STATUT = 'delete';
        $str_BRANCHE = $db->quote($str_BRANCHE);
        $sql = "SELECT * FROM t_branche WHERE str_LIBELLE LIKE " . $str_BRANCHE . " AND str_STATUT <> '" . $str_STATUT . "'";

        if(!empty($str_BRANCHE)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    foreach ($result as $item_result) {
                        return $item_result['lg_BRANCHE_ID'];
                    }
                }
                else{
                    $str_BRANCHE = str_replace("'", "", $str_BRANCHE);
                    return addBrancheInternal($db, $str_BRANCHE);
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function getIdClient($str_NAME, $str_BP, $str_TEL, $db){
        $str_STATUT = 'delete';
        $str_NAME = htmlentities(trim($str_NAME));
        $str_BP = htmlentities(trim($str_BP));
        $str_TEL = htmlentities(trim($str_TEL));

        $str_NAME = $db->quote($str_NAME);
        $str_BP = $db->quote($str_BP);
        $str_TEL = $db->quote($str_TEL);

        if($str_BP == "''" OR $str_TEL == "''")
        {
            $sql = "SELECT * FROM t_client WHERE str_NAME LIKE " . $str_NAME . " AND str_STATUT <> '" . $str_STATUT . "'";
        }
        else
        {
            $sql = "SELECT * FROM t_client WHERE str_BP LIKE " . $str_BP . " AND str_TEL LIKE " . $str_TEL . " AND str_STATUT <> '" . $str_STATUT . "'";
        }

        //echo $sql;
        if(!empty($str_NAME)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    foreach ($result as $item_result) {
                        return $item_result['lg_CLIENT_ID'];
                    }
                }
                else{
                    $str_NAME = stripslashes(str_replace("'", "", $str_NAME));
                    $str_BP = stripslashes(str_replace("'", "", $str_BP));
                    $str_TEL = stripslashes(str_replace("'", "", $str_TEL));
                    return addClientInternal( $db, $str_NAME, $str_BP, $str_TEL);
                    //exit();
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function addIntermediaire($db, $str_CODE, $str_LIBELLE) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $str_INTERMEDIAIRE_ID = RandomString();

        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_intermediaire(str_INTERMEDIAIRE_ID, str_CODE, str_LIBELLE,  str_STATUT, dt_CREATED, str_CREATED_BY)"
            . "VALUES (:str_INTERMEDIAIRE_ID, :str_CODE, :str_LIBELLE, :str_STATUT,$dt_CREATED,:str_CREATED_BY)";
        try {
            if (!isExistCodeIntermediaire($str_INTERMEDIAIRE_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':str_INTERMEDIAIRE_ID', $str_INTERMEDIAIRE_ID);
                $stmt->BindParam(':str_CODE', $str_CODE);
                $stmt->BindParam(':str_LIBELLE', $str_LIBELLE);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);

                if ($stmt->execute()) {
                    $message = "Insertion effectué avec succès";
                    $code_statut = "1";
                } else {
                    $message = "Erreur lors de l'insertion";
                    $code_statut = "0";
                }
            } else {
                $message = "Ce Code  : \" " . $str_INTERMEDIAIRE_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

        return $str_INTERMEDIAIRE_ID;
    }
    function isExistCodeIntermediaire($str_INTERMEDIAIRE_ID, $db) {
        $str_STATUT = 'delete';
        $str_INTERMEDIAIRE_ID = $db->quote($str_INTERMEDIAIRE_ID);
        $sql = "SELECT * FROM t_intermediaire WHERE str_INTERMEDIAIRE_ID LIKE " . $str_INTERMEDIAIRE_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($str_INTERMEDIAIRE_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function addBranche($db, $str_LIBELLE) {

        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $lg_BRANCHE_ID = RandomString();

        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_branche(lg_BRANCHE_ID, str_LIBELLE,  str_STATUT, dt_CREATED, str_CREATED_BY)"
            . "VALUES (:lg_BRANCHE_ID, :str_LIBELLE, :str_STATUT,$dt_CREATED,:str_CREATED_BY)";
        try {
            if (!isExistCodeBranche($lg_BRANCHE_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':lg_BRANCHE_ID', $lg_BRANCHE_ID);
                $stmt->BindParam(':str_LIBELLE', $str_LIBELLE);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                //var_dump($stmt);
                if ($stmt->execute()) {
                    $message = "Insertion effectué avec succès";
                    $code_statut = "1";
                } else {
                    $message = "Erreur lors de l'insertion";
                    $code_statut = "0";
                }
            } else {
                $message = "Ce Code  : \" " . $lg_BRANCHE_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
        $arrayJson["results"] = $message;
        $arrayJson["code_statut"] = $code_statut;
        $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function addBrancheInternal($db, $str_LIBELLE) {

        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $lg_BRANCHE_ID = RandomString();

        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_branche(lg_BRANCHE_ID, str_LIBELLE,  str_STATUT, dt_CREATED, str_CREATED_BY)"
            . "VALUES (:lg_BRANCHE_ID, :str_LIBELLE, :str_STATUT,$dt_CREATED,:str_CREATED_BY)";
        try {
            if (!isExistCodeBranche($lg_BRANCHE_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':lg_BRANCHE_ID', $lg_BRANCHE_ID);
                $stmt->BindParam(':str_LIBELLE', $str_LIBELLE);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                //var_dump($stmt);
                if ($stmt->execute()) {
                    return $lg_BRANCHE_ID;
                } else {
                    $message = "Erreur lors de l'insertion";
                    $code_statut = "0";
                }
            } else {
                $message = "Ce Code  : \" " . $lg_BRANCHE_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
    }
    function isExistCodeBranche($str_BRANCHE_ID, $db) {
        $str_STATUT = 'delete';
        $str_BRANCHE_ID = $db->quote($str_BRANCHE_ID);
        $sql = "SELECT * FROM t_branche WHERE lg_BRANCHE_ID LIKE " . $str_BRANCHE_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($str_BRANCHE_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }

    function addHash($str_FILE, $str_BRANCHE_NAME, $str_CLIENT_NAME, $str_FILE_RAR, $lg_BRANCHE_ID, $int_COURRIER_ID, $str_NUMERO_POLICE, $str_PERIODE, $int_PRIME_TTC, $db) {

        $int_NUMBER_EXTRACT = getNumberExtraction($int_COURRIER_ID, $db);

        if(!empty($int_NUMBER_EXTRACT) && $int_NUMBER_EXTRACT > 0)
        {
            $str_EXTRACTION_ID = RandomString();

            $str_PARAM = "Libelle branche : " .$str_BRANCHE_NAME." | client : ".$str_CLIENT_NAME." | numero de police : ".$str_NUMERO_POLICE." | Periode : ".$str_PERIODE." | Prime TTC : ".$int_PRIME_TTC;
            $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
            $sql = "INSERT INTO t_extraction(str_EXTRACTION_ID, str_FILE, str_PARAM, int_NUMBER_EXTRACT, str_RAR, str_STATUT, str_CREATED_BY, dt_CREATED, lg_BRANCHE_ID, pk_COURRIER_ID) "
                . "VALUES (:str_EXTRACTION_ID, :str_FILE, :str_PARAM, :int_NUMBER_EXTRACT, :str_RAR, :str_STATUT, :str_CREATED_BY, $dt_CREATED, :lg_BRANCHE_ID, :pk_COURRIER_ID)";

            try {
                if (!isExistCodeHash($str_EXTRACTION_ID, $db)) {

                    $stmt = $db->prepare($sql);
                    $str_STATUT = "enable";
                    $int_COURRIER_ID = str_replace("'", " ", $int_COURRIER_ID);
                    //var_dump($int_COURRIER_ID);
                    $stmt->BindParam(':str_EXTRACTION_ID', $str_EXTRACTION_ID);
                    $stmt->BindParam(':str_FILE', $str_FILE);
                    $stmt->BindParam(':str_PARAM', $str_PARAM);
                    $stmt->BindParam(':int_NUMBER_EXTRACT', $int_NUMBER_EXTRACT);
                    $stmt->BindParam(':str_RAR', $str_FILE_RAR);
                    $stmt->BindParam(':str_STATUT', $str_STATUT);
                    $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                    $stmt->BindParam(':lg_BRANCHE_ID', $lg_BRANCHE_ID);
                    $stmt->BindParam(':pk_COURRIER_ID', $int_COURRIER_ID);
                    //var_dump($stmt);
                    if ($stmt->execute()) {
                        return $str_EXTRACTION_ID;
                    } else {
                        return "Erreur HASH";
                    }
                } else {
                    $message = "Ce Code  : \" " . $str_EXTRACTION_ID . " \" de table existe déja! \r\n";
                    $code_statut = "0";
                }
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
            }

        }
    }
    function isExistCodeHash($str_EXTRACTION_ID, $db) {
        $str_STATUT = 'delete';
        $str_EXTRACTION_ID = $db->quote($str_EXTRACTION_ID);
        $sql = "SELECT * FROM t_extraction WHERE str_EXTRACTION_ID LIKE " . $str_EXTRACTION_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($str_EXTRACTION_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function getNumberExtraction($str_COURRIER_ID, $db){
        $str_STATUT = 'delete';
        $int_NUMBER_EXTRACT = 1;
        $dt_UPDATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
        $str_COURRIER_ID = $db->quote($str_COURRIER_ID);
        $sql = "SELECT * FROM t_extraction WHERE pk_COURRIER_ID LIKE " . $str_COURRIER_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($str_COURRIER_ID)){
            try {
                //echo $sql;
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    $int_NUMBER_EXTRACT = (int) count($result);
                    $int_NUMBER_EXTRACT++;
                }
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return $int_NUMBER_EXTRACT;
    }

    function createZipFile($file_name, $str_TYPE){

        switch ($str_TYPE){
            case 'pdf_courriersAll':
                $structure = "pdf_courriers".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/";
                break;
            case 'courriers_sansAll':
                $structure = "courriers_sans".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/";
                break;
            case 'sansentete':
                $structure = "courriers_sans".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/";
                break;
            default:
                $structure = "courriers_avec".date('Y')."/".str_replace(' ', '_',strtolower($_SESSION['nom'])) ."/". date('d-m-Y') . "/";
                break;

        }

        $zip = new ZipArchive;
        if ($zip->open("{$file_name}.zip", ZipArchive::CREATE) === TRUE) {
            if ($handle = opendir($structure)) {
                //ouverture du dossier racine
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $data = $structure . '/' . $entry;
                        $dir = scandir($data, 1);
                        if (is_dir($data)) {
                            if ($dh = opendir($data)) {
                                while (($file = readdir($dh)) !== false) {
                                    if ($file != "." && $file != "..") {
                                        //echo "filename:" . $file . "<br>";
                                        $zip->addFile($data .'/'.$file);
                                    }
                                }
                                closedir($dh);
                            }
                        }
                    }
                }
                closedir($handle);
            }
            $zip->close();
            return true;
        }
        return false;
    }

    function getAllClient($lg_CLIENT_ID, $db){
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;
        if ($lg_CLIENT_ID == "" || $lg_CLIENT_ID == null) {
            $lg_CLIENT_ID = "%%";
        }
        $lg_CLIENT_ID = $db -> quote($lg_CLIENT_ID);

        $sql = "SELECT * FROM t_client "
            . " WHERE lg_CLIENT_ID LIKE " . $lg_CLIENT_ID . " AND str_STATUT <> '".$str_STATUT."' "
            . " ORDER BY dt_CREATED DESC;";
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
        }
        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function isExistCodeClient($lg_CLIENT_ID, $db) {
        $str_STATUT = 'delete';
        $lg_CLIENT_ID = $db->quote($lg_CLIENT_ID);
        $sql = "SELECT * FROM t_client WHERE lg_CLIENT_ID LIKE " . $lg_CLIENT_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($lg_CLIENT_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function addClient( $db, $str_LIBELLE,$str_BP, $str_TEL) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $lg_CLIENT_ID = RandomString();

        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_client(lg_CLIENT_ID, str_NAME, str_BP, str_TEL, str_STATUT, str_CREATED_BY, dt_CREATED) "
            . "VALUES (:lg_CLIENT_ID, :str_NAME, :str_BP, :str_TEL, :str_STATUT, :str_CREATED_BY, $dt_CREATED)";
        try {
            if (!isExistCodeClient($lg_CLIENT_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':lg_CLIENT_ID', $lg_CLIENT_ID);
                $stmt->BindParam(':str_NAME', $str_LIBELLE);
                $stmt->BindParam(':str_BP', $str_BP);
                $stmt->BindParam(':str_TEL', $str_TEL);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                //var_dump($stmt);
                if ($stmt->execute()) {
                    $message = "Insertion effectué avec succès";
                    $code_statut = "1";
                } else {
                    $message = "Erreur lors de l'insertion";
                    $code_statut = "0";
                }
            } else {
                $message = "Ce Code  : \" " . $lg_CLIENT_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

        $arrayJson["results"] = $message;
        $arrayJson["code_statut"] = $code_statut;
        $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function deleteClient($lg_CLIENT_ID, $db) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "delete";
        $lg_CLIENT_ID = $db->quote($lg_CLIENT_ID);
        $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
        $sql = "UPDATE t_client "
            . "SET str_STATUT = '$str_STATUT',"
            . "str_UPDATED_BY = $str_UPDATED_BY, "
            . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "' "
            . "WHERE lg_CLIENT_ID = $lg_CLIENT_ID";
        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Suppression effectuée avec succès";
                $code_statut = "1";
            } else {
                $message = "Erreur lors de la modification";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function editClient($lg_CLIENT_ID, $str_LIBELLE,$str_BP, $str_TEL, $db)
    {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        //ECHO $str_ETAT_ID;
        $str_LIBELLE = $db->quote($str_LIBELLE);
        $lg_CLIENT_ID = $db->quote($lg_CLIENT_ID);
        $str_BP = $db->quote($str_BP);
        $str_TEL = $db->quote($str_TEL);
        $sql = "UPDATE t_client "
            . "SET str_NAME = $str_LIBELLE, "
            . "str_BP = $str_BP,"
            . "str_TEL = $str_TEL,"
            . "str_UPDATED_BY = '" . $_SESSION['str_SECURITY_ID'] . "',"
            . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "'"
            . " WHERE lg_CLIENT_ID = $lg_CLIENT_ID";

        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Modification effectuée avec succès";
                $code_statut = "1";
            } else {
                $message = "Erreur lors de la modification";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
        //    $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function addClientInternal( $db, $str_LIBELLE,$str_BP, $str_TEL) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $lg_CLIENT_ID = RandomString();

        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_client(lg_CLIENT_ID, str_NAME, str_BP, str_TEL, str_STATUT, str_CREATED_BY, dt_CREATED) "
            . "VALUES (:lg_CLIENT_ID, :str_NAME, :str_BP, :str_TEL, :str_STATUT, :str_CREATED_BY, $dt_CREATED)";
        try {
            if (!isExistCodeClient($lg_CLIENT_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':lg_CLIENT_ID', $lg_CLIENT_ID);
                $stmt->BindParam(':str_NAME', $str_LIBELLE);
                $stmt->BindParam(':str_BP', $str_BP);
                $stmt->BindParam(':str_TEL', $str_TEL);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                //var_dump($stmt);
                if ($stmt->execute()) {
                    return $lg_CLIENT_ID;
                } else {
                    return false;
                }
            } else {
                $message = "Ce Code  : \" " . $lg_CLIENT_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

    }

    function isExistCodeFacture($lg_FACTURE_ID, $db) {
        $str_STATUT = 'delete';
        $lg_FACTURE_ID = $db->quote($lg_FACTURE_ID);
        $sql = "SELECT * FROM t_facture WHERE lg_FACTURE_ID LIKE " . $lg_FACTURE_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($lg_FACTURE_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function getLastDate($db) {
        $str_STATUT = 'delete';
        $sql = "SELECT MAX(dt_DATE) as dt_DATE FROM t_facture WHERE str_STATUT <> '" . $str_STATUT . "'";

        try {
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                foreach ($result as $item_result) {
                    return $item_result['dt_DATE'];
                }
            }
            return false;
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
            return false;
        }
    }
    function getLastFactureNumber($lg_SERVICE_ID, $db) {
        $str_STATUT = 'delete';
        $lg_SERVICE_ID = $db->quote($lg_SERVICE_ID);
        //$sql = "SELECT MAX(int_NUMFACT) as int_NUMFACT FROM t_facture WHERE str_STATUT <> '" . $str_STATUT . "' AND lg_BRANCHE_ID LIKE $lg_BRANCHE_ID";
        $sql = "SELECT MAX(int_NUMFACT) as int_NUMFACT FROM t_facture "
                ." JOIN t_security ON t_security.str_SECURITY_ID = t_facture.str_CREATED_BY "
                ." JOIN t_service ON t_service.lg_SERVICE_ID = t_security.lg_SERVICE_ID "
                ." WHERE t_service.lg_SERVICE_ID  LIKE $lg_SERVICE_ID AND t_facture.str_STATUT <> '" . $str_STATUT . "' ";

        try {
            $stmt = $db->query($sql);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {

                if(getLastDate($db) == date('Y'))
                {
                    foreach ($result as $item_result) {

                        if($item_result['int_NUMFACT'] + 1 < 10)
                        {
                            $num_FACT = "0".$item_result['int_NUMFACT'] + 1;
                        }
                        else
                        {
                            $num_FACT = $item_result['int_NUMFACT'];
                        }
                        return $num_FACT;
                    }
                }
                else
                {
                    return 1;
                }
            }
            return false;
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
            return false;
        }
    }
    function addFacture($db, $str_POLICE, $dt_EFFET, $dt_ECHEANCE, $int_ACCESSOIRE, $int_TAXE, $int_PRIME_NETTE,  $lg_CLIENT_ID, $lg_BRANCHE_ID)
    {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $lg_FACTURE_ID = RandomString();
        $annee = date('Y');
        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_facture(lg_FACTURE_ID, int_NUMFACT, str_POLICE, dt_DATE, dt_EFFET, dt_ECHEANCE, int_ACCESSOIRE, int_TAXE, int_PRIME_NETTE,  str_STATUT, str_CREATED_BY, dt_CREATED, lg_CLIENT_ID, lg_BRANCHE_ID) "
            . "VALUES (:lg_FACTURE_ID, :int_NUMFACT, :str_POLICE, :dt_DATE, :dt_EFFET, :dt_ECHEANCE, :int_ACCESSOIRE, :int_TAXE, :int_PRIME_NETTE, :str_STATUT, :str_CREATED_BY, $dt_CREATED, :lg_CLIENT_ID, :lg_BRANCHE_ID )";
        $int_NUMFACT = getLastFactureNumber($_SESSION['lg_SERVICE_ID'], $db);
        //exit();
        try {
            if (!isExistCodeFacture($lg_FACTURE_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':lg_FACTURE_ID', $lg_FACTURE_ID);
                $stmt->BindParam(':int_NUMFACT', $int_NUMFACT);
                $stmt->BindParam(':str_POLICE', $str_POLICE);
                $stmt->BindParam(':dt_DATE', $annee);
                $stmt->BindParam(':dt_EFFET', $dt_EFFET);
                $stmt->BindParam(':dt_ECHEANCE', $dt_ECHEANCE);
                $stmt->BindParam(':int_ACCESSOIRE', $int_ACCESSOIRE);
                $stmt->BindParam(':int_TAXE', $int_TAXE);
                $stmt->BindParam(':int_PRIME_NETTE', $int_PRIME_NETTE);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                $stmt->BindParam(':lg_CLIENT_ID', $lg_CLIENT_ID);
                $stmt->BindParam(':lg_BRANCHE_ID', $lg_BRANCHE_ID);
                //var_dump($stmt);
                if ($stmt->execute()) {
                    $message = "Insertion effectué avec succès";
                    $code_statut = "1";
                } else {
                    $message = "Erreur lors de l'insertion";
                    $code_statut = "0";
                }
            } else {
                $message = "Ce Code  : \" " . $lg_CLIENT_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

        $arrayJson["results"] = $message;
        $arrayJson["code_statut"] = $code_statut;
        $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function addFileFacture($db, $str_BRANCHE_FILE, $str_CLIENT_FILE, $str_NUMERO_POLICE_FILE, $str_DATE_EFFET_FILE, $str_DATE_ECHEANCE_FILE, $str_ACCESSOIRE_FILE, $int_TAXE_FILE, $int_PRIMENETTE_FILE, $str_BP_FILE, $str_TEL_FILE)
    {
        $current_ok = " \r\n ";
        $current_ok .= "branche  \t Client \t numéro de police \t date effet \t date echeance \t accessoire \t taxe \t prime nette \t boite postal \t téléphone  \r\n";
        $current_ok .= "{$str_BRANCHE_FILE} \t {$str_CLIENT_FILE} \t  {$str_NUMERO_POLICE_FILE} \t {$str_DATE_EFFET_FILE} \t {$str_DATE_ECHEANCE_FILE} \t {$str_ACCESSOIRE_FILE} \t {$int_TAXE_FILE} \t {$int_PRIMENETTE_FILE} \t {$str_BP_FILE} \t {$str_TEL_FILE} \r\n";

        $db->beginTransaction();
        set_time_limit(0);
        $cpt_erreur = 0;
        $cpt = 0;
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        if (isset($_FILES['str_ILLUSTRATION']) && $_FILES['str_ILLUSTRATION']['error'] == 0)
        {
            //Testons la taille des fichiers par rapport à 2Mo = 2000000 octets
            if ($_FILES['str_ILLUSTRATION']['size'] <= 100000000) {
                $str_ILLUSTRATION = basename($_FILES['str_ILLUSTRATION']['name']);
                $extention = strtolower(substr(strrchr($_FILES['str_ILLUSTRATION']['name'], '.'), 1));
                $nom_crypter = sha1($str_ILLUSTRATION);
                $str_ILLUSTRATION = "documents/" . $nom_crypter . "." . $extention;
                $Resultmove = move_uploaded_file($_FILES['str_ILLUSTRATION']['tmp_name'], $str_ILLUSTRATION);
                $fileErreur = "documents/".$nom_crypter."-".date("Y-m-d")."-2-{$_SESSION['str_SECURITY_ID']}.err";
                $fichiers = fopen($fileErreur, "w");
                $fileSucces = "documents/".$nom_crypter."-".date("Y-m-d")."-2-{$_SESSION['str_SECURITY_ID']}.log";
                $fichiersSucces = fopen($fileSucces, "w");
                if($fichiers==false)
                    die ("Impossible de creer le fichier");
                if($fichiersSucces==false)
                    die ("Impossible de creer le fichier");

                if (/*$extention === "xls" || */ $extention === "xlsx") {
                    $file = $str_ILLUSTRATION;
                    $XLSXDocument = new PHPExcel_Reader_Excel2007();
                    //exit();
                    $objPHPExcel = $XLSXDocument->load($file);

                    $lastRow = $objPHPExcel->getActiveSheet()->getHighestRow();
                    $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
                    $i =0;
                    $mt_pnette = 0;

                    foreach ($rowIterator as $row) {
                        $rowIndex = $row->getRowIndex();
                        $str_FACTURE_ID = RandomString();
                        $annee = date('Y');
                        $str_BRANCHE_FILES = ($str_BRANCHE_FILE<>""?htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_BRANCHE_FILE}".$rowIndex)->getValue())):0);

                        $str_CLIENT_FILES = ($str_CLIENT_FILE<>""?htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_CLIENT_FILE}".$rowIndex)->getValue())):"");
                        $str_NUMERO_POLICE_FILES = ($str_NUMERO_POLICE_FILE<>""?htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_NUMERO_POLICE_FILE}".$rowIndex)->getValue())):"");

                        $str_ACCESSOIRE_FILES = ($str_ACCESSOIRE_FILE==""?"":htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_ACCESSOIRE_FILE}".$rowIndex)->getValue())));
                        $int_TAXE_FILES = ($int_TAXE_FILE==""?"":htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$int_TAXE_FILE}".$rowIndex)->getValue())));
                        $int_PRIMENETTE_FILES = ($int_PRIMENETTE_FILE==""?"":htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$int_PRIMENETTE_FILE}".$rowIndex)->getValue())));
                        $str_BP_FILES = ($str_BP_FILE==""?"":htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_BP_FILE}".$rowIndex)->getValue())));
                        $str_TEL_FILES = ($str_TEL_FILE==""?"":htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_TEL_FILE}".$rowIndex)->getValue())));

                        $dt_DATE_EFFET = ($str_DATE_EFFET_FILE<>""?htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_DATE_EFFET_FILE}".$rowIndex)->getValue())):"");
                        $dt_FIN_GARANTIE = ($str_DATE_ECHEANCE_FILE<>""?htmlspecialchars(trim($objPHPExcel->getActiveSheet()->getCell("{$str_DATE_ECHEANCE_FILE}".$rowIndex)->getValue())):"");

                        if($i>0) {
                            $cell = $objPHPExcel->getActiveSheet()->getCell("{$str_DATE_EFFET_FILE}" . $rowIndex);
                            $InvDate = $cell->getValue();
                            if (PHPExcel_Shared_Date::isDateTime($cell)) {
                                $dt_DATE_EFFETS = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate));
                            }
                            $cell = $objPHPExcel->getActiveSheet()->getCell("{$str_DATE_ECHEANCE_FILE}" . $rowIndex);
                            $InvDate = $cell->getValue();
                            if (PHPExcel_Shared_Date::isDateTime($cell)) {
                                $dt_FIN_GARANTIES = date($format = "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($InvDate));
                            }
                        }

                        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));

                        $sql = "INSERT INTO t_facture(lg_FACTURE_ID, int_NUMFACT, str_POLICE, dt_DATE, dt_EFFET, dt_ECHEANCE, int_ACCESSOIRE, int_TAXE, int_PRIME_NETTE, str_STATUT, str_CREATED_BY, dt_CREATED, lg_CLIENT_ID, lg_BRANCHE_ID) "
                            ." VALUES (:lg_FACTURE_ID, :int_NUMFACT, :str_POLICE, :dt_DATE, :dt_EFFET, :dt_ECHEANCE, :int_ACCESSOIRE, :int_TAXE, :int_PRIME_NETTE, :str_STATUT, :str_CREATED_BY, $dt_CREATED, :lg_CLIENT_ID, :lg_BRANCHE_ID);";

                        if($i>0) {
                            //echo $str_CLIENT_FILES.'<br/>';
                            $str_CLIENT_ID = getIdClient($str_CLIENT_FILES, $str_BP_FILES, $str_TEL_FILES, $db);
                            $str_BRANCHE_IDS = getIdBranche($str_BRANCHE_FILES, $db);

                            $int_NUMFACT = getLastFactureNumber($_SESSION['lg_SERVICE_ID'], $db);

                            if (!empty($str_FACTURE_ID)) {
                                try {
                                    $stmt = $db->prepare($sql);

                                    $stmt->BindParam(':lg_FACTURE_ID', $str_FACTURE_ID);
                                    $stmt->BindParam(':int_NUMFACT', $int_NUMFACT);
                                    $stmt->BindParam(':str_POLICE', $str_NUMERO_POLICE_FILES);
                                    $stmt->BindParam(':dt_DATE', $annee);
                                    $stmt->BindParam(':dt_EFFET', $dt_DATE_EFFETS);
                                    $stmt->BindParam(':dt_ECHEANCE', $dt_FIN_GARANTIES);
                                    $stmt->BindParam(':int_ACCESSOIRE', $str_ACCESSOIRE_FILES);
                                    $stmt->BindParam(':int_TAXE', $int_TAXE_FILES);
                                    $stmt->BindParam(':int_PRIME_NETTE', $int_PRIMENETTE_FILES);
                                    $stmt->BindParam(':str_STATUT', $str_STATUT);
                                    $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                                    $stmt->BindParam(':lg_CLIENT_ID', $str_CLIENT_ID);
                                    $stmt->BindParam(':lg_BRANCHE_ID', $str_BRANCHE_IDS);

                                    if ($stmt->execute()) {
                                        $cpt++;
                                        $current_ok .= "{$str_BRANCHE_FILE} \t {$str_CLIENT_FILE} \t  {$str_NUMERO_POLICE_FILE} \t {$str_DATE_EFFET_FILE} \t {$str_DATE_ECHEANCE_FILE} \t {$str_ACCESSOIRE_FILE} \t {$int_TAXE_FILE} \t {$int_PRIMENETTE_FILE} \t {$str_BP_FILE} \t {$str_TEL_FILE} \r\n";

                                        fputs($fichiersSucces, $current_ok);
                                        $mt_pnette += $int_PRIMENETTE_FILES;
                                        $message = "L'insertion a été effectué avec succès. il y a {$cpt} lignes en base de données. Il y a eu {{$cpt_erreur}} erreurs";
                                        $code_statut = "1";

                                    } else {
                                        $cpt_erreur++;
                                        $message = "enregistrement impossible, il y a {$cpt_erreur} erreurs";
                                        $code_statut = "0";
                                    }
                                } catch (PDOException $e) {
                                    die("Erreur ! : " . $e->getMessage());
                                }
                            }
                        }
                        $i++;
                    }
                }
                else {
                    $message = "Erreur, veuillez selectionner un fichier avec l'extension 'excel'\r\n";
                    fputs ($fichiers, $message);
                }
            }
            else{
                echo "je ne suis pas supporté";
                return;
            }
            $i--;
            //conclusion fichier intégration reussi
            $message = "TOTAL MIS A JOUR SUR TOTAL LU : {$cpt}/{$i}\r\n";
            $message .= "MONTANT TOTAL PRIME NETTE : {$mt_pnette}\r\n";

            fputs ($fichiersSucces, $current_ok);
            fputs ($fichiersSucces, $message);
            fclose ($fichiersSucces);
        }
        $db->commit();
        $arrayJson["results"] = $message;
        $arrayJson["code_statut"] = $code_statut;
        $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }

    function getAllService($lg_SERVICE_ID, $db){
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;
        if ($lg_SERVICE_ID == "" || $lg_SERVICE_ID == null) {
            $lg_SERVICE_ID = "%%";
        }
        $lg_SERVICE_ID = $db -> quote($lg_SERVICE_ID);

        $sql = "SELECT * FROM t_service "
            . " WHERE lg_SERVICE_ID LIKE " . $lg_SERVICE_ID . " AND str_STATUT <> '".$str_STATUT."' "
            . " ORDER BY dt_CREATED DESC;";
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
        }
        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function isExistCodeService($lg_SERVICE_ID, $db) {
        $str_STATUT = 'delete';
        $lg_SERVICE_ID = $db->quote($lg_SERVICE_ID);
        $sql = "SELECT * FROM t_service WHERE lg_SERVICE_ID LIKE " . $lg_SERVICE_ID . " AND str_STATUT <> '" . $str_STATUT . "'";
        if(!empty($lg_SERVICE_ID)){
            try {
                $stmt = $db->query($sql);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($result) > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                die("Erreur ! : " . $e->getMessage());
                return false;
            }
        }
        return false;
    }
    function addService($db, $str_LIBELLE) {

        $message = "";
        $code_statut = "";
        $str_STATUT = "enable";
        $lg_SERVICE_ID = RandomString();

        $dt_CREATED = $db->quote(gmdate("Y-m-d, H:i:s"));
        $sql = "INSERT INTO t_service(lg_SERVICE_ID, str_LIBELLE,  str_STATUT, dt_CREATED, str_CREATED_BY)"
            . "VALUES (:lg_SERVICE_ID, :str_LIBELLE, :str_STATUT,$dt_CREATED,:str_CREATED_BY)";
        try {
            if (!isExistCodeService($lg_SERVICE_ID, $db)) {

                $stmt = $db->prepare($sql);
                $str_STATUT = "enable";
                $stmt->BindParam(':lg_SERVICE_ID', $lg_SERVICE_ID);
                $stmt->BindParam(':str_LIBELLE', $str_LIBELLE);
                $stmt->BindParam(':str_STATUT', $str_STATUT);
                $stmt->BindParam(':str_CREATED_BY', $_SESSION['str_SECURITY_ID']);
                //var_dump($stmt);
                if ($stmt->execute()) {
                    $message = "Insertion effectué avec succès";
                    $code_statut = "1";
                } else {
                    $message = "Erreur lors de l'insertion";
                    $code_statut = "0";
                }
            } else {
                $message = "Ce Code  : \" " . $lg_SERVICE_ID . " \" de table existe déja! \r\n";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
        $arrayJson["results"] = $message;
        $arrayJson["code_statut"] = $code_statut;
        $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }
    function deleteService($lg_SERVICE_ID, $db) {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        $str_STATUT = "delete";
        $lg_SERVICE_ID = $db->quote($lg_SERVICE_ID);
        $str_UPDATED_BY = $db->quote($_SESSION['str_SECURITY_ID']);
        $sql = "UPDATE t_service "
            . "SET str_STATUT = '$str_STATUT',"
            . "str_UPDATED_BY = $str_UPDATED_BY, "
            . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "' "
            . "WHERE lg_SERVICE_ID = $lg_SERVICE_ID";
        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Suppression effectuée avec succès";
                $code_statut = "1";
            } else {
                $message = "Erreur lors de la modification";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function editService($lg_SERVICE_ID, $str_LIBELLE, $db)
    {
        $arrayJson = array();
        $message = "";
        $code_statut = "";
        //ECHO $str_ETAT_ID;
        $str_LIBELLE = $db->quote($str_LIBELLE);
        $lg_SERVICE_ID = $db->quote($lg_SERVICE_ID);
        $sql = "UPDATE t_service "
            . "SET str_LIBELLE = $str_LIBELLE, "
            . "str_UPDATED_BY = '" . $_SESSION['str_SECURITY_ID'] . "',"
            . "dt_UPDATED = '" . gmdate("Y-m-d, H:i:s") . "'"
            . " WHERE lg_SERVICE_ID = $lg_SERVICE_ID";

        try {
            $sucess = $db->exec($sql);
            if ($sucess > 0) {
                $message = "Modification effectuée avec succès";
                $code_statut = "1";
            } else {
                $message = "Erreur lors de la modification";
                $code_statut = "0";
            }
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }

        $arrayJson["results"] = $message;
        $arrayJson["total"] = $sucess;
        $arrayJson["code_statut"] = $code_statut;
        //    $arrayJson["desc_statut"] = $db->errorInfo();
        echo "[" . json_encode($arrayJson) . "]";
    }

    function getAllExtraction( $libelle, $params, $nbre, $str_EXTRACTION_ID, $db, $index){
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;

        if ($str_EXTRACTION_ID == "" || $str_EXTRACTION_ID == null) {
            $str_EXTRACTION_ID = "%%";
        }
        $str_EXTRACTION_ID = $db -> quote($str_EXTRACTION_ID);
        if ($libelle == "" || $libelle == null) {
            $libelle = "%%";
        }
        $libelle = $db -> quote('%'.$libelle.'%');
        if ($nbre == "" || $nbre == null) {
            $nbre = "%%";
        }
        $nbre = $db -> quote($nbre);
        if ($params == "" || $params == null) {
            $params = "%%";
        }
        $params = $db -> quote($params.'%');

        $sql = "SELECT * FROM t_extraction "
            . " WHERE str_EXTRACTION_ID LIKE " . $str_EXTRACTION_ID . " AND str_PARAM LIKE $libelle AND int_NUMBER_EXTRACT LIKE $nbre AND dt_CREATED LIKE $params AND str_STATUT <> '".$str_STATUT."'  "
            . " ORDER BY dt_CREATED DESC LIMIT ".$index.",10;";
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
        }
        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;
        //echo "[" . json_encode($arrayJson) . "]";
        echo  json_encode($arraySql) ;
    }
    function countData($db, $str_EXTRACTION_ID, $libelle, $nbre, $params){
        $arrayJson = array();
        $arraySql = array();
        $code_statut = "0";
        $str_STATUT = "delete";
        $intResult = 0;

        if ($str_EXTRACTION_ID == "" || $str_EXTRACTION_ID == null) {
            $str_EXTRACTION_ID = "%%";
        }
        $str_EXTRACTION_ID = $db -> quote($str_EXTRACTION_ID);
        if ($libelle == "" || $libelle == null) {
            $libelle = "%%";
        }
        $libelle = $db -> quote('%'.$libelle.'%');
        if ($nbre == "" || $nbre == null) {
            $nbre = "%%";
        }
        $nbre = $db -> quote($nbre);
        if ($params == "" || $params == null) {
            $params = "%%";
        }
        $params = $db -> quote($params.'%');


        $sql = "SELECT count(*) AS numberData FROM t_extraction "
                ." WHERE str_EXTRACTION_ID LIKE " . $str_EXTRACTION_ID . " AND str_PARAM LIKE $libelle AND int_NUMBER_EXTRACT LIKE $nbre AND dt_CREATED LIKE $params AND str_STATUT <> '".$str_STATUT."'  ";
        $stmt = $db -> query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $item_result) {
            $arraySql[] = $item_result;
            $intResult++;
            $code_statut = "1";
        }
        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["desc_statut"] = $db->errorInfo();
        $arrayJson["code_statut"] = $code_statut;

        echo  json_encode($arraySql) ;
    }
    function getAlphabetiqueWord(){
        $arrayJson = array();
        $arraySql = array();
        $message = "";
        $code_statut = "";
        $code_statut = "0";
        $intResult = 0;
        $lettre = "";
        foreach(range('A', 'Z') as $letter) {
            $arraySql[] = array('str_WORD' => strtoupper($letter));
            if($letter=="Z"){
                foreach(range('A', 'Z') as $lettres) {
                    foreach(range('A', 'Z') as $letters) {
                        $arraySql[] = array('str_WORD' => strtoupper($lettres).''.strtoupper($letters));
                    }
                }
            }
            $intResult++;
            $code_statut = "1";
        }
        $arrayJson["results"] = $arraySql;
        $arrayJson["total"] = $intResult;
        $arrayJson["code_statut"] = $code_statut;
        echo "[" . json_encode($arrayJson) . "]";
    }
    function convert_number_to_words($number) {

        $hyphen      = '-';
        $conjunction = ' et '; //' et ';
        $separator   = ', ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'un',
            2                   => 'deux',
            3                   => 'trois',
            4                   => 'quatre',
            5                   => 'cinq',
            6                   => 'six',
            7                   => 'sept',
            8                   => 'huit',
            9                   => 'neuf',
            10                  => 'dix',
            11                  => 'onze',
            12                  => 'douze',
            13                  => 'treize',
            14                  => 'quatorze',
            15                  => 'quinze',
            16                  => 'seize',
            17                  => 'dix sept',
            18                  => 'dix huit',
            19                  => 'dix neuf',
            20                  => 'vingt',
            30                  => 'trente',
            40                  => 'quarante',
            50                  => 'cinquante',
            60                  => 'soixante',
            70                  => 'soixante-dix',
            80                  => 'quatre-vingt',
            90                  => 'quatre-vingt dix',
            100                 => 'cent',
            1000                => 'mille',
            1000000             => 'million',
            1000000000          => 'milliard',
            1000000000000       => 'billion',
            1000000000000000    => 'billiard'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 17:
                $string = $dictionary[$number];
                break;
            case $number < 20:
                $string = $dictionary[10];
                $un = $number - 10;
                $string .= $hyphen . $dictionary[$un];
                break;
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                if (($tens == 70) || ($tens == 90))
                {
                    $un = $tens-10;
                    $string = $dictionary[$un];
                    $units+=10;
                }
                else
                {
                    $string = $dictionary[$tens];
                }
                if ($units) {
                    if ($units == 1)
                        $string .= $conjunction . $dictionary[$units];
                    else
                        $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                if ($hundreds >= 2)
                    $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                else
                    $string = $dictionary[100];
                if ($remainder) {
                    $string .=' '. convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= ' ';//$remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }
        return $string;
    }

?>