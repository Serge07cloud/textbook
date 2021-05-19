<?php
session_start();

require_once '../vendor/autoload.php';
require_once '../config/connexion.php';
require_once '../fonctions/index.php';

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

/* Liste des etudiants en fonctions des critères ci-dessous : */
$filtre = [
    'annee_academique' => $_SESSION['imprimer']['annee'],
    'id_etablissement' => $_SESSION['imprimer']['id_etablissement'],
    'id_departement' => $_SESSION['imprimer']['id_departement'],
    'id_parcours' => $_SESSION['imprimer']['id_parcours'],
    'niveau_etude' => $_SESSION['imprimer']['niveau']
];
/* liste des étudiants */
$etudiants = ListeEtudiants($filtre['id_departement'], $filtre['id_parcours'], $filtre['niveau_etude'],$filtre['annee_academique']);
$liste_decouper = array_chunk($etudiants, 14);

$tbl = '';

$tbl_header = '
<table  width="100%" border="1"  cellspacing="0" cellpadding="3">
  <thead>
  <tr>
    <th  colspan="7" width="65.5%">Informations Etudiant</th>
    <th  rowspan="2" width="5.5%">semestre</th>
    <th  colspan="3" width="14.5%">Informations semestre</th>
    <th  colspan="3" width="14.5%">Informations Annuelle</th>
  </tr>
  <tr>
 	<!-- informations etudiants --> 
    <th width="7%">N carte étudiant</th>
    <th width="10%">Nom</th>
    <th width="23.5%">Prénom</th>
    <th width="5%">Date de naissance</th>
    <th width="3.1%">Genre</th>    
    <th width="13.4%">Nationalité</th>  
    <th width="3.5%">Statut</th>

    <!-- informations semestre --> 
    <th width="4.5%">Moyenne</th> 
    <th width="4%">Mention</th>
    <th width="6%">Délibération</th>  
    
    <!-- informations annuelle --> 
    <th width="4.5%">Moyenne</th> 
    <th width="4%">Mention</th>
    <th width="6%">Délibération</th>  
  </tr>
  </thead>';

$tbl_footer = '</table>';

foreach ($liste_decouper as $index => $etd) {
    foreach ($etd as $et) {
        $info = InfoEtudiant($et['matricule']);
        /* moyennes */
        $sem1 = moyEtudiant($et['matricule'], 1);
        $sem2 = moyEtudiant($et['matricule'], 2);
        $an = moyEtudiant($et['matricule'], 3);
        /* decision */
        $dec_sem1 = deliberationEtudiant($et['matricule'], 1);
        $dec_sem2 = deliberationEtudiant($et['matricule'], 2);
        $dec_an = deliberationEtudiant($et['matricule'], 3);
        $status = "";
        $tbl .= '
<tr>
     <!-- informations etudiants --> 
    <td rowspan="3"> ' . $et['matricule'] . '</td>
    <td rowspan="3">' . $info['nom'] . '</td>
    <td rowspan="3">' . $info['prenom'] . '</td>
    <td rowspan="3">' . exist($info['date_naissance']) . '</td>
    <td rowspan="3">' . exist($info['sexe']) . '</td>
    <td rowspan="3">' . exist($info['pays']) . '</td>
    <td rowspan="3"></td>
	<td rowspan="2">Semestre 1 </td>
	<!-- informations semestre --> 
	<!-- premier semestre -->
    <td  rowspan="2">' . exist($sem1) . '</td>
    <td rowspan="2"></td>
    <td rowspan="2">' . exist($dec_sem1) . '</td>

    <!-- informations annuelle --> 
     <td rowspan="3">' . exist($an) . '</td>
    <td rowspan="3"></td>
    <td rowspan="3">' . exist($dec_an) . '</td>
</tr>
    <tr>
    </tr>
    <tr>
        <!-- informations etudiants -->
        <td>Semestre 2</td>
        <td >' . exist($sem2) . '</td>
        <td></td>
        <td>' . exist($dec_sem2) . '</td>
    </tr>
';
    }
    $html = $tbl_header . $tbl . $tbl_footer;
    $mpdf->AddPage('L');
    $mpdf->WriteHTML($html);
    $tbl = '';
}

$mpdf->Output();