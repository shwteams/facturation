
<?php

@mysql_connect("localhost","root","")or die("erreur de connexion du serveur");
@mysql_select_db("etcp")or die("erreur de connexion à la base de données");


?>


<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
-->
</style>
<page backcolor="#fff" backimg="./res/bas_page.png" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;time;page" style="font-size: 12pt">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="./res/logo.png" alt="Logo"><br>
                RELATION CLIENT
            </td>
            <td style="width: 50%;">
                <span>ENTREPRISE TRANSPORT CISSE ET PATERNAIRE</span>
            </td>
            <td style="width: 25%; color: #444444;">
                <img style="width: 100%;" src="./res/logo.png" alt="Logo"><br>
                RELATION CLIENT
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%; ">Client :</td>
            <td style="width:36%">M. Albert Dupont</td>
        </tr>
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%; ">Adresse :</td>
            <td style="width:36%">
                Résidence perdue<br>
                1, rue sans nom<br>
                00 000 - Pas de Ville<br>
            </td>
        </tr>
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%; ">Email :</td>
            <td style="width:36%">nomail@domain.com</td>
        </tr>
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%; ">Tel :</td>
            <td style="width:36%">33 (0) 1 00 00 00 00</td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%; ">Spipu Ville, le <?php echo date('d/m/Y'); ?></td>
        </tr>
    </table>
    <br>
    <i>
        <b><u>Objet </u>: &laquo; Bon de Retour &raquo;</b><br>
        Compte client : 00C4520100A<br>
        Référence du Dossier : 71326<br>
    </i>
   
   
    <?php
    $date_inscription = date('d-m-Y');
    $r=mysql_query("SELECT * FROM rapport1 WHERE date_inscription='$date_inscription' ORDER BY date_inscription ASC");
$nmb=mysql_num_rows($r);
    echo'
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 12%">Produit</th>
            <th style="width: 52%">Désignation</th>
            <th style="width: 13%">Prix Unitaire</th>
            <th style="width: 10%">Quantité</th>
            <th style="width: 13%">Prix Net</th>
        </tr>
    </table>';

 $somme = 0;
$somme_energie = 0;
$somme_prix = 0;
$somme_kilo_jour = 0;
$somme_depense_j=0;
$caisse=0;
$somme_garage=0;
$depense_total=0;
/*Affichage de plusieurs enregistrement*/
while($row=mysql_fetch_row($r))
{
  $id= $row[0];
$report_solde=$row[1];
$nouveau_solde=$row[2]; 
$immatriculation=$row[3];
$type=$row[4]; 
$energie=$row[5];
$matricule= $row[6];
$nom= $row[7];
$contact_chauffeur= $row[8];
$report_somme_depense= $row[9];
$type_jour= $row[10];
$prix= $row[11];
$somme_prix +=$prix;
$kilo_jour= $row[23];
$somme_kilo_jour += $kilo_jour ;
$litre= $row[13];
$litre_jour= $row[22];

$somme_energie +=$litre_jour ;
$recette= $row[16];
$somme += $recette;
$date_rapport= $row[15];
 $somme_energie_jour= $row[12]; 
 $kilo_jour= $row[23]; 
 $depense_jour= $row[25];

$motif_depense=$row[17];
 
  $somme_depense_j += $depense_jour;
 
 $somme_depense_jour=$row[19];
 $somme_garage += $somme_depense_jour;
 

 $depense_total=$somme_depense_j+$somme_garage;
 $caisse=$somme-$depense_total;

    }
?>
 
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: center; font-size: 10pt;">
        <tr>
            <td style="width: 12%; text-align: left"> </td>
            <td style="width: 52%; text-align: left"><?php // $nom; ?></td>
            <td style="width: 13%; text-align: right"><?php echo $recette; ?></td>
            <td style="width: 10%"> <?php echo $matricule; ?></td>
            <td style="width: 13%; text-align: right;"><?php echo $matricule; ?></td>
        </tr>
    </table>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 10pt;">
        <tr>
            <th style="width: 87%; text-align: right;">Total : </th>
            <th style="width: 13%; text-align: right;"><?php echo $matricule; ?> &euro;</th>
        </tr>
    </table>
    <br>
    Cette reprise concerne la quantité et les matériels dont la référence figure sur le <a href="#document_reprise">document de reprise joint</a>.<br>
    Nous vous demandons de nous retourner ces produits en parfait état et dans leur emballage d'origine.<br>
    <br>
    Nous vous demandons également de coller impérativement l'autorisation de reprise jointe, sur le colis à reprendre afin de faciliter le traitement à l'entrepôt.<br>
    <br>
    Notre Service Clients ne manquera pas de revenir vers vous dès que l'avoir de ces matériels sera établi.<br>
    <nobreak>
        <br>
        Dans cette attente, nous vous prions de recevoir, Madame, Monsieur, Cher Client, nos meilleures salutations.<br>
        <br>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:50%;"></td>
                <td style="width:50%; ">
                    Mle Jesuis CELIBATAIRE<br>
                    Service Relation Client<br>
                    Tel : 33 (0) 1 00 00 00 00<br>
                    Email : on_va@chez.moi<br>
                </td>
            </tr>
        </table>
    </nobreak>
</page>