<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

include('../config/connexion.php');
include('../fonctions/index.php');
include('../fonctions/pv_annuel.php');

/* Liste des etudiants en fonctions des critères ci-dessous : */
$filtre = [
    'annee_academique' => $_POST['annee'],
    'id_etablissement' => $_POST['id_etablissement'],
    'id_departement' => $_POST['id_departement'],
    'id_parcours' => $_POST['id_parcours'],
    'niveau_etude' => $_POST['niveau']
];


/* liste des étudiants */
$etudiants = ListeEtudiants($filtre['id_departement'], $filtre['id_parcours'], $filtre['niveau_etude'], null, null, $filtre['annee_academique']);
$liste_decouper = array_chunk($etudiants, 12);

/* make TCPDF object */
include('tcpdf.php');
$pdf = new MYTCPDF('L', 'mm', 'A4');
$pdf->SetMargins(2, 31, 2);
$pdf->setFontSubsetting(false);

$tbl = '';

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
  <tr nobr="true">
    <td style="text-align:center;" colspan="7" width="65.5%">Informations Etudiant</td>
    <td style="text-align:center;" rowspan="2" width="5.5%">semestre</td>
    <td style="text-align:center;" colspan="3" width="14.5%">Informations semestre</td>
    <td style="text-align:center;" colspan="3" width="14.5%">Informations Annuelle</td>
  </tr>
  <tr nobr="true">
 	<!-- informations etudiants --> 
    <td width="7%">N carte étudiant</td>
    <td width="10%">Nom</td>
    <td width="23.5%">Prénom</td>
    <td width="5%">Date de naissance</td>
    <td width="3.1%">Genre</td>    
    <td width="13.4%">Nationalité</td>  
    <td width="3.5%">Statut</td>

    <!-- informations semestre --> 
    <td width="4.5%">Moyenne</td> 
    <td width="4%">Mention</td>
    <td width="6%">Délibération</td>  
    
    <!-- informations annuelle --> 
    <td width="4.5%">Moyenne</td> 
    <td width="4%">Mention</td>
    <td width="6%">Délibération</td>  
  
  </tr>';
$tbl_footer = '</table>';

foreach ($liste_decouper as $index => $etd) {
    foreach ($etd as $et) {
        $info = InfoEtudiant($et['matricule']);
        /* moyennes */
        $sem1 = moyEtudiant($et['matricule'], 1);
        $sem2 = moyEtudiant($et['matricule'], 2);
        $an = moyEtudiant($et['matricule'], 3);
        /* decision */
        if (isset($filtre) && $filtre['annee_academique'] !== '22019') {
            $dec_sem1 = deliberationEtudiant($et['matricule'], 1);
            $dec_sem2 = deliberationEtudiant($et['matricule'], 2);
            $dec_an = deliberationEtudiant($et['matricule'], 3);
        }
        $status = statusEtudiant($et['matricule'], $filtre['niveau_etude']);
        $nom = empty($info['nom']) ? $et['nom'] : $info['nom'];
        $prenom = empty($info['prenom']) ? $et['prenoms'] : $info['prenom'];
        $tbl .= '
<tr>
     <!-- informations etudiants --> 
    <td rowspan="3"> ' . $et['matricule'] . '</td>
    <td rowspan="3">' . $nom . '</td>
    <td rowspan="3">' . $prenom . '</td>
    <td style="text-align: right" rowspan="3">' . exist($info['date_naissance']) . '</td>
    <td rowspan="3">' . exist($info['sexe']) . '</td>
    <td rowspan="3">' . exist($info['pays']) . '</td>
    <td rowspan="3">' . exist($status) . '</td>
	<td rowspan="2">Semestre 1 </td>
	<!-- informations semestre --> 
	<!-- premier semestre -->
    <td style="text-align: right" rowspan="2">' . exist($sem1) . '</td>
    <td rowspan="2"></td>
    <td rowspan="2">' . exist($dec_sem1) . '</td>

    <!-- informations annuelle --> 
     <td style="text-align: right" rowspan="3">' . exist($an) . '</td>
    <td rowspan="3"></td>
    <td rowspan="3">' . exist($dec_an) . '</td>
</tr>
    <tr>
    </tr>
    <tr>
        <!-- informations etudiants -->
        <td>Semestre 2</td>
        <td style="text-align: right">' . exist($sem2) . '</td>
        <td></td>
        <td>' . exist($dec_sem2) . '</td>
    </tr>
';
    }
    $html = $tbl_header . $tbl . $tbl_footer;
    $pdf->AddPage();
    $pdf->writeHTML($html, true, false, false, false, '');
    $tbl = '';
}


//output
$pdf->SetFooterMargin(250);
$pdf->Output('pv-annuel' . rand() . '.pdf', 'D');











