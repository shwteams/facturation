<style type="text/css">
    table{
        border-collapse: collapse;
        width: 100%; color: #717375; font-size: 12pt;
        font-family: Helvetica; line-height: 6mm;
    }
    table strong {
        color: #000;
    }
    td.right{
        text-align: right;
    }
    h1{
        color: #000;
        margin: 0;
        padding: 0;
    }
    table.border td{
        border: 1px solid #CFD1D2;
        padding: 3mm 1mm;
    }

    table.border th, td.black{
        background: #0a0a0a;
        color: #fff;
        font-weight: normal;
        border:solid 1px #fff;
        padding: 1.5mm 1mm;
        text-align: left;
    }
    td.noborder{
        border: none;
    }
    td.noborder-bottom{
        border-bottom: none;
    }
    .pied-page{
        font-size: 8pt;
    }
</style>
<page backtop="30mm" backleft="14mm" backright="20mm" backbottom="14mm">
    <page_header>
        <table class="page_header" style="color: white">
            <tr>
                <td style="width: 100%; text-align: center; color: white;">
                    <span >
                        <!--<img src="services/img/logo.png" alt="logo" width="200" height="130" >-->
                    </span>
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <span style="font-size: 7pt;color: <?= COLOR_ASH; ?>; margin-bottom: 0;"><?= $str_EXTRACTION_ID; ?></span>
        <hr style=" height:1px;border:solid 1px white;color:#ffffff;background-color:white;margin-top: 0;">
        <p style="text-align: center;color: white;">
            <strong>SUNU Assurances IARD Côte d’Ivoire</strong> <br>
            <?=
                nl2br("<span class='pied-page'>Entreprise régie par le Code des Assurances-SA au capital de 4 500 000 000 F.CFA entièrement libéré
   R.C. CI-ABJ-1997-B-211398 –C.C 6000850 Q Immeuble SUNU, Avenue Botreau Roussel - 01 BP 3803 Abidjan 01 Côte d’Ivoire
     <strong>Tél. :</strong> (+225) 20 25 18 18 - <strong>Fax :</strong> (+225) 20 32 57 91 - <strong>E-mail :</strong> cotedivoire.iard@sunu-group.com - <strong>Site Web :</strong> www.sunu-group.com</span>
");
            ?>
        </p>
    </page_footer>
    <table style="vertical-align: top">
        <tr>
            <td style="width: 75%"> SUNU ASSURANCE IARD </td>
            <td style="width: 25%">
                <strong>Client : <?= wordwrap($item_result['str_NAME'],20,"<br/>", 1); ?></strong> <br>
                <strong><?= ($item_result['str_BP'] <> NULL?'BP : '.wordwrap($item_result['str_BP'],23,"<br/>", 1):'') ?></strong> <br>
                <strong><?= ($item_result['str_TEL'] <> NULL?'TEL : '.$item_result['str_TEL']:'') ?></strong>
            </td>
        </tr>
    </table>
    <table style="vertical-align: bottom; margin-top: 20mm;">
        <tr>
            <td style="width:50%"><h1>FACTURE N° <?= ($item_result['int_NUMFACT']<9?"0".$item_result['int_NUMFACT']:$item_result['int_NUMFACT']); ?>/<?= $item_result['dt_DATE']; ?></h1></td>
            <!--<td style="width:50%"><h1>FACTURE N° DT-<?= $item_result['dt_DATE']; ?>/FACT-<?= ($item_result['int_NUMFACT']<9?"0".$item_result['int_NUMFACT']:$item_result['int_NUMFACT']); ?></h1></td>-->
            <td style="width:50%" class="right">Emis le <?= date('d/m/Y') ?></td>
        </tr>
    </table>
    <table class="border">
        <thead>
        <tr>
            <th style="width: 58%">
                DESIGNATION
            </th>
            <th style="width: 23%">
                DEBIT
            </th>
            <th style="width: 24%">
                CREDIT
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="noborder-bottom">
                <?= $item_result['str_LIBELLE']; ?>
            </td>
            <td class="noborder-bottom"></td>
            <td class="noborder-bottom"></td>
        </tr>
        <tr>
            <td class="noborder-bottom">Police N° <?= strtoupper($item_result['str_POLICE']); ?> </td>
            <td class="noborder-bottom"></td>
            <td class="noborder-bottom"></td>
        </tr>
        <tr>
            <td class="noborder-bottom">
                Période du <?= date("d/m/Y", strtotime($item_result['dt_EFFET'])); ?> au <?= date("d/m/Y", strtotime($item_result['dt_ECHEANCE'])); ?>
            </td>
            <td class="noborder-bottom"></td>
            <td class="noborder-bottom"></td>
        </tr>
        <tr>
            <td class="noborder-bottom">
                Décompte de prime
            </td>
            <td class="noborder-bottom"></td>
            <td class="noborder-bottom"></td>
        </tr>
        <tr>
            <td style="text-align: center;" class="noborder-bottom">Prime nette </td>
            <td class="noborder-bottom"><?= number_format($item_result['int_PRIME_NETTE'], 0,',', ' '); ?> F CFA</td>
            <td class="noborder-bottom"></td>
        </tr>
        <tr>
            <td style="text-align: center;" class="noborder-bottom">Accessoires </td>
            <td class="noborder-bottom"><?= number_format( $item_result['int_ACCESSOIRE'], 0,',', ' '); ?> F CFA</td>
            <td class="noborder-bottom"></td>
        </tr>
        <tr>
            <td style="text-align: center;">Taxes (<?= $item_result['int_TAXE']; ?> %) </td>
            <td>
                <?php
                $taxe = ($item_result['int_ACCESSOIRE'] + $item_result['int_PRIME_NETTE'])*$item_result['int_TAXE']/100;
                echo number_format($taxe, 0,',', ' ');
                ?> F CFA
            </td>
            <td></td>
        </tr>
        <tr>
            <td><b>Prime total TTC</b></td>
            <td>
                <b>
                    <?php
                    $montant = ceil($item_result['int_ACCESSOIRE'] + $item_result['int_PRIME_NETTE']+$taxe);
                    echo number_format($montant, 0,',', ' ');
                    ?> F CFA
                </b>
            </td>
            <td></td>
        </tr>

        <tr>
            <td class="noborder"></td>
            <td class="black" style="padding: 1mm"><b>Total :</b></td>
            <td><b><?= number_format($montant, 0,',', ' '); ?> F CFA</b></td>
        </tr>
        <tr>
            <td colspan="3" class="noborder"></td>
        </tr>
        <tr>
            <td colspan="3" class="noborder"><b>Arrêtée la présente facture à la somme de : <?= convert_number_to_words(ceil($montant)); ?> F CFA.</b></td>
        </tr>
        <tr>
            <td colspan="3" class="noborder">
                <em>La  prise d'effet du contrat est subordonnée au paiement de la présente facture. (Article nouveau 13 du code CIMA).</em>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="noborder"></td>
        </tr>
        <tr>
            <td colspan="3" class="noborder" style="text-align: right;">
                <u>POUR LA SOCIETE</u>
            </td>
        </tr>
        </tbody>
    </table>
</page>