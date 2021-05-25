<?php
session_start();
require('MYPDF.php');
require_once "textbook-functions.php";

$information = $_COOKIE["information"];
$data = json_decode($information);

$teacher        = intval($data->teacher);
$ue             = intval($data->ue);
$ecue           = intval($data->ecue);
$grade          = intval($data->niveau);
$department     = intval($data->departement);
$institution    = intval($data->institution);
$career         = intval($data->specialite);
$schoolYear     = intval($_SESSION["id_annee_academique"]);
$cm_state       = $data->cm_checked;
$td_state       = $data->td_checked;
$tp_state       = $data->tp_checked;
$volume         = getTempsAttribue($ecue,$career,$schoolYear, $teacher);

/* Personnal configurations */
$teacher        = getUser($teacher);
$ue             = getUe($ue)[0]["intitule_ue"];
$ecue           = getEcue($ecue)[0]["intitule_ecue"];
$grade          = getNiveau($grade)[0]["libelle_niveau"];
$career         = getParcours($career)[0]["libelle_specialite"];
$department     = getDepartment($department)[0]["nom_departement"];
$institutionImage = getInstitutionImage($institution);
$institution      = getEtablissement($institution)[0]["nom_etablissement"];

$fullName = ucfirst(strtolower($teacher[0]["nom_enseignant"] . " " . $teacher[0]["prenom_enseignant"]));
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT,true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->setUe($ue);
$pdf->setEcue($ecue);
$pdf->setLevel($grade);
$pdf->setCareer($career);
$pdf->setUfr($institution);
$pdf->setTimeCM($volume[0]["vol_cm"]);
$pdf->setTimeTD($volume[0]["vol_td"]);
$pdf->setTimeTP($volume[0]["vol_tp"]);
$pdf->setDepartment($department);
$pdf->setInstitutionImage("../img/" . $institutionImage);
$pdf->setSchoolYear(getSchoolYear($schoolYear)[0]["libelle_annee_academique"]);
$pdf->setTeacher($teacher[0]["nom_enseignant"] . " " . $teacher[0]["prenom_enseignant"]);

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage('L', 'A4');

$dataTable = array(
    "type"          => null,
    "teacher"       => intval($data->teacher),
    "schoolYear"    => $schoolYear,
    "department"    => intval($data->department),
    "institution"   => intval($data->institution),
    "grade"         => intval($data->niveau)
);

if ($cm_state == true){
    $dataTable["type"] = 1;
    displayTable($pdf, $dataTable);
}

if ($td_state == true){
    $dataTable["type"] = 2;
    displayTable($pdf, $dataTable, true);
}

if ($tp_state == true){
    $dataTable["type"] = 3;
    displayTable($pdf, $dataTable, true);
}


$filename = "CT". substr($fullName,0,-3) ."_". $grade ."_".time();
$pdf->Output($filename, 'D');



