<?php
session_start();

//include library
include('../config/connexion.php');
include('../fonction.php');

include('tcpdf-sem.php');


/* Liste des etudiants en fonctions des critères ci-dessous : */
$filtre = [
    'annee_academique' => $_SESSION['imprimer']['annee'],
    'id_etablissement' => $_SESSION['imprimer']['id_etablissement'],
    'id_departement' => $_SESSION['imprimer']['id_departement'],
    'id_parcours' => $_SESSION['imprimer']['id_parcours'],
    'niveau_etude' => $_SESSION['imprimer']['niveau']
];

$etudiants = fetchEtudiantsTest($filtre['annee_academique'], $filtre['id_etablissement'], $filtre['id_departement'], $filtre['id_parcours'], $filtre['niveau_etude']);



$moyenne = [];

// charger la liste des données


//make TCPDF object
$pdf = new MYTCPDF('L', 'mm', 'A4');
$pdf->SetMargins(2, 33, 2);

$total = 0;
$tbl = '';
$ue = [];
$new = array_chunk($etudiants, 12);


$tbl_header = '
    <style>
	table{
		font-size:7px;
	}
	td{
	    text-align:left;
	}
</style>


<table nobr="true" width="100%" border="1"  cellspacing="0" cellpadding="3">
   <tr>
        <td style="text-align:center;" colspan="7" width="36.8%">Informations Etudiant</td>
        <td style="text-align:center;" rowspan="2" width="4.6%">session</td>
        <td style="text-align:center;" colspan="12" width="54%">Informations UE</td>
        <td style="text-align:center;" rowspan="2" width="5.7%">Delibérations</td>
    </tr>
  <tr>
 	<td width="6.5%">N carte étudiant</td>
        <td width="5%">Nom</td>
        <td width="8.7%">Prénom</td>
        <td width="5%">Date de naissance</td>
        <td width="3.1%">Genre</td>
        <td width="5%">Nationalité</td>
        <td width="3.5%">Statut</td>

    <!-- informations semestre -->
    <td>FVR2111 (CDT 5)</td>
    <td>ENT2221 (CDT 3)</td> 
    <td>SAG2111 (CDT 4)</td>
    <td>ADO2221 (CDT 3)</td>
    <td>ELG2111 (CDT 3)</td> 
    <td>TEX2111 (CDT 2)</td>
    <td>OBR2221 (CDT 2)</td>
    <td>ANG2111 (CDT 2)</td>
    <td>SEC2221 (CDT 1)</td>
    <td>ENV2111 (CDT 1)</td>
    <td>EDE2221 (CDT 4)</td>
  
    <!-- informations annuelle --> 
    <td>Moyenne</td>
    <td>Mention</td>
  
  </tr>';
$tbl_footer = '</table>';


foreach ($new as $index => $etd):
    foreach ($etd as $et):
        $moyenne = fetchMoyenne($et['num_etud'],1);
        $deliberation = fetchDeliberation($et['num_etud'],1);

        $tbl .= '
<tr>
     <!-- informations etudiants -->
        <td rowspan="3">' . $et['matricule'] . '</td>
        <td rowspan="3">' . $et['nom'] . '</td>
        <td rowspan="3">' . $et['prenom'] . '</td>
        <td rowspan="3">' . $et['date_naissance'] . '</td>
        <td rowspan="3">X</td>
        <td rowspan="3">IVOIRIENNE</td>
        <td rowspan="3">XXX</td>

	<!-- semestre -->
        <td rowspan="2">normal</td>
        <!-- informations semestre -->
        <td rowspan="2"></td>
        <td rowspan="2"></td>
        <td rowspan="2"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="3">' . $et['SEM'] . '</td>
        <td rowspan="3">'.$deliberation["DECISION"].'</td>

        <!-- Delibération -->
        <td rowspan="3"></td>
</tr>
    <tr>
    </tr>
    <tr>
        <!-- informations etudiants -->
        <td>rattrapage</td>
        <td>' . $moyenne[0]['MOY'] . '</td>
        <td>' . $moyenne[3]['MOY'] . '</td>
        <td>' . $moyenne[4]['MOY'] . '</td>
        <td>' . $moyenne[5]['MOY'] . '</td>
        <td>' . $moyenne[6]['MOY'] . '</td>
        <td>' . $moyenne[7]['MOY'] . '</td>
        <td>' . $moyenne[10]['MOY'] . '</td>
        <td>' . $moyenne[11]['MOY'] . '</td>
        <td>' . $moyenne[12]['MOY'] . '</td>
        <td>' . $moyenne[13]['MOY'] . '</td>
        <td>' . $moyenne[14]['MOY'] . '</td>
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











