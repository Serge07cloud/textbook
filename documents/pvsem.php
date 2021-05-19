<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);

include('../config/connexion.php');
require_once "../fonctions/index.php";
require "../fonctions/pv_sem.php";
include('tcpdf-sem.php');

/* Liste des etudiants en fonctions des critères ci-dessous : */
$filtre = [
    'annee_academique' => $_POST['annee'],
    'id_etablissement' => $_POST['id_etablissement'],
    'id_departement' => $_POST['id_departement'],
    'id_parcours' => $_POST['id_parcours'],
    'niveau' => $_POST['id_niveau'],
    'id_semestre' => $_POST['id_semestre']
];

/* etudiants */
$etudiants = ListeEtdPVSEM($filtre['annee_academique'], $filtre['id_departement'], $filtre['niveau'], $filtre['id_semestre'], null, null);
$ue = ListeUE($filtre['annee_academique'], $filtre['id_departement'], $filtre['id_semestre']);

/* division en 12 */
$partition_etudiants = array_chunk($etudiants, 11);

$tt = 54 / (count($ue) + 2);
$div = round($tt, 2);


/* charger la liste des données */
$pdf = new MYTCPDF('L', 'mm', 'A4');
$pdf->SetMargins(1, 33, 1);

$total = 0;
$tbl = '';


var_dump($_SESSION);
die();

$tbl_header = '
    <style>
	table{
		font-size:6.5px;
	}
	td{
	    text-align:left;
	}
</style>
<table nobr="true" width="100%" border="1"  cellspacing="0" cellpadding="3">
   <tr>
        <td style="text-align:center;" colspan="7" width="36%">Informations Etudiant</td>
        <td style="text-align:center;" rowspan="2" width="5%">session</td>
        <td style="text-align:center;" colspan="12" width="54%">Informations UE</td>
        <td style="text-align:center;" rowspan="2" width="5%">Delibération</td>
   </tr>
  <tr>
 	<td width="7%">N carte étudiant</td>
    <td width="5%">Nom</td>
    <td width="8%">Prénom</td>
    <td width="5%">Date de naissance</td>
    <td width="3%">Genre</td>
    <td width="5%">Nationalité</td>
    <td width="3%">Statut</td> 
    ';

foreach ($ue as $liste) {
    $tbl_header .= '<td width="' . $div . '%">' . $liste['code_ue'] . '</td>';
}

$tbl_header .= ' 
    <!-- informations annuelle --> 
    <td width="' . $div . '%">Moyenne</td>
    <td width="' . $div . '%">Mention</td>
  </tr>';
$tbl_footer = '</table>';


foreach ($partition_etudiants as $index => $etd):
    foreach ($etd as $et):
        $info = InfoEtdPVSEM($et['matricule']);
        $sexe = ($etd['sexe'] == '1') ? 'M' : 'F';
        /* info */
        $nom = exist($info['nom'], $et['nom']);
        $prenom = exist($info['prenoms'], $et['prenoms']);
        $sexe = ($info['sexe'] == '1') ? 'M' : 'F';
        $pays = exist($info['pays']);
        $date_naissance = exist($info['date_naissance']);
        $nationalite = exist($info['pays']);
        $tbl .= '
    <tr>
        <!-- informations etudiants -->
        <td rowspan="3">' . $et['matricule'] . '</td>
        <td rowspan="3">' . $nom . '</td>
        <td rowspan="3">' . $prenom . '</td>
        <td rowspan="3">' . $date_naissance . '</td>
        <td rowspan="3">' . $sexe . '</td>
        <td rowspan="3">' . $pays . '</td>
        <td rowspan="3"></td>

	    <!-- semestre -->
        <td rowspan="2">normal</td>';
        foreach ($ue as $liste) {
            $id_ue = $liste['id_ue'];
            $mat = $et['matricule'];
            $moy = getMoySEM($mat, $id_ue, $filtre['niveau'], $filtre['id_semestre']);
            $tbl .= '<td>' . $moy['moy'] . '</td>';
        }
        $tbl .= '
       
        <!-- MOY -->
        <td rowspan="3"></td>
        <!-- MENTION -->
        <td rowspan="3"></td>
        <!-- Delibération -->
        <td rowspan="3" colspan="3"></td>
    </tr>
    <tr></tr>
    <tr>
        <!-- informations etudiants -->
        <td>rattrapage</td>';
        foreach ($ue as $liste) {
            $tbl .= '<td> </td>';
        }
        $tbl .= '
    </tr>
';
    endforeach;
    $pdf->AddPage();
    $pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
    $tbl = '';
endforeach;


//output
$pdf->SetFooterMargin(250);
$pdf->Output();











