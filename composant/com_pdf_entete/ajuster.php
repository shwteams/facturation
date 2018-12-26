<style type="text/css">
    table{
        width: 100%;
        table-layout:fixed;
        font-size: 11pt;
        font-family: helvetica;
        line-height: 6mm;
        vertical-align: top;
        text-align:justify;
    }
    ul{
        line-height: 6mm;
    }
    img{
        opacity: 0.3;
        filter: alpha(opacity=30);
    }
    .tableau-interne {
        border-collapse: collapse;
        color: #717375;
    }

    .tableau-interne, .tableau-interne tr, .tableau-interne th,.tableau-interne td {
        border: 1px solid #CFD1D2;
        padding: 2mm 1mm;
    }
    .tableau-interne strong{
        color: #000;
    }
    .pied-page{
        font-size: 8pt;
    }

</style>
<page backtop="30mm" backleft="14mm" backright="20mm" backbottom="14mm">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 100%; text-align: center; ">
                    <span >
                        <img src="services/img/logo.png" alt="logo" width="200" height="130" >
                    </span>
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <span style="font-size: 7pt;color: lightgrey; margin-bottom: 0;"><?= $str_EXTRACTION_ID; ?></span>
        <hr style=" height:1px;border:none;color:red;background-color:red">
        <p style="text-align: center; ">
            <strong>SUNU Assurances IARD Côte d’Ivoire</strong> <br>
            <?=
                nl2br("<span class='pied-page'>Entreprise régie par le Code des Assurances-SA au capital de 4 500 000 000 F.CFA entièrement libéré
   R.C. CI-ABJ-1997-B-211398 –C.C 6000850 Q Immeuble SUNU, Avenue Botreau Roussel - 01 BP 3803 Abidjan 01 Côte d’Ivoire
     <strong>Tél. :</strong> (+225) 20 25 18 18 - <strong>Fax :</strong> (+225) 20 32 57 91 - <strong>E-mail :</strong> cotedivoire.iard@sunu-group.com - <strong>Site Web :</strong> www.sunu-group.com</span>
");
            ?>
        </p>
    </page_footer>
    <p>
        <table >
            <tr>
                <td style="width: 50%; text-align:right;" colspan="2">
                    <strong>Abidjan le, <?= date("d/m/Y"); ?></strong><br>
                    <strong>Client : <?= wordwrap($item_result['str_CLIENT'],20,"<br/>", 1); ?></strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 10px"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left"><strong>Intermediaire : <?= $item_result['str_CODE_INTERMEDIAIRE']; ?></strong></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left"><strong>Référence du courrier : DT-<?= date('Y'); ?>/SEP-A/<?= ($cpt<10?'00'.$cpt:$cpt); ?></strong><br/><br/></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left"><strong>Objet : AVIS D’ECHEANCE </strong></td>
            </tr>

            <tr>
                <td colspan="2"  style="text-align: left"><strong>N°police : <?= ($item_result['str_ANCIENNE_POL'] && strlen($item_result['str_ANCIENNE_POL'])<9)?$item_result['str_NUMERO_POLICE']:$item_result['str_ANCIENNE_POL']; ?> </strong></td>
            </tr>
            <tr>
                <td colspan="2"  style="text-align: left"><strong>Période </strong> : Du <strong><?= date("d/m/Y", strtotime($item_result['dt_DATE_EFFET'])); ?></strong> au <strong><?= date("d/m/Y", strtotime($item_result['dt_FIN_GARANTIE'])); ?></strong></td>
            </tr>
            <tr>
                <td colspan="2"><br/><br/>
                    <p>Cher(e)  client(e),<br/><br/>
                        Nous avons l’honneur de vous rappeler que votre contrat ci-dessus, arrive à échéance  le <strong><?= date("d/m/Y", strtotime($item_result['dt_FIN_GARANTIE'])); ?> à minuit</strong>.<br/>
                        La situation de sinistralité de votre contrat est la suivante :
                        <br/><br/>
                        &nbsp;&nbsp;&nbsp;<img src="services/img/puce.png" width="10" height="10" alt="puce" > Nombre de sinistre : <strong><?= $item_result['int_NBSIN']; ?></strong><br/>
                        &nbsp;&nbsp;&nbsp;<img src="services/img/puce.png" width="10" height="10" alt="puce" > Evaluations: <strong><?= number_format($item_result['int_CHARGE_TOTAL'], 0,',', ' '); ?> FCFA</strong>
                        <br/> <br/>
                        Au vu de la sinistralité, votre prime TTC reste inchangée pour la période du <strong><?= date("d/m/Y", strtotime($item_result['dt_FIN_GARANTIE']. "+ 1 day")); ?></strong> au <strong><?= date("d/m/Y", strtotime($item_result['dt_FIN_GARANTIE']. "+ {$item_result['int_DUREE']} day")) ; ?></strong> soit une prime TTC de <strong><?= number_format($item_result['int_PRIME_TTC'], 0,',', ' '); ?></strong>  FCFA. <br/>
                        Nous vous prions de bien vouloir vous rapprocher de nos bureaux pour le renouvellement et vous rappelons qu’en application de l’article 13 du code des assurances CIMA, votre contrat ne pendra
                        effet qu’après règlement totale de votre prime TTC avant sa date d’échéance. <br/>
                        En vous remerciant de votre fidélité et de votre confiance renouvelée, Veuillez agréer cher(e) client(e), l’expression de notre profonde considération.
                    </p>
                </td>
            </tr>
            <tr>
                <td> </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    <!--<strong><u>Service Etudes et Projets </u></strong>-->
                </td>
                <td style="width: 50%; text-align: right;">
                    <strong><u>Pour la compagnie</u></strong>
                    <br>
                    <!-- Mis en commentaire sous la demande de monsieur angoua pour le tirage des avis d'échéance de décembre<?= SIGNATURE_DT ?>-->
                </td>
            </tr>
        </table>
    </p>
</page>