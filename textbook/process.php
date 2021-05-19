<?php
session_start();
require('MYPDF.php');
require_once "textbook-functions.php";

$formateur = $_COOKIE["formateur"];

$data = json_decode($formateur);
//debug($data);
//debug($_SESSION);
$ue = $data->ue;
$ecue = $data->ecue;
$niveau = $data->niveau;
$parcours = $data->specialite;
$cm_state = $data->cm_checked;
$td_state = $data->td_checked;
$tp_state = $data->tp_checked;
$cm_group = $data->cm_group;
$td_group = $data->td_group;
$tp_group = $data->tp_group;
$volume = getTempsAttribue((int)$ecue,(int)$parcours,(int)$_SESSION["id_annee_academique"], (int)$_SESSION["teacher"]);
//debug($cm_state);
//debug($niveau);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT,true);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

/* Personnal configurations */
$teacher = getUserConnected((int)$_SESSION["connecte"]);
$ue = getUe((int)$ue)[0]["intitule_ue"];
$ecue = getEcue((int)$ecue)[0]["intitule_ecue"];
$niveau = getNiveau((int)$niveau)[0]["libelle_niveau"];
$parcours = getParcours((int)$parcours)[0]["libelle_specialite"];
$department = getDepartment((int)$_SESSION["id_departement"])[0]["nom_departement"];
$etablissement = getEtablissement((int)$_SESSION["id_etablissement"])[0]["nom_etablissement"];
$logoEtablissement = getEtablissement((int)$_SESSION["id_etablissement"])[0]["logo_etablissement"];


$pdf->setTeacher($teacher[0]["nom_enseignant"] . " " . $teacher[0]["prenom_enseignant"]);
$pdf->setSchoolYear(getSchoolYear((int)$_SESSION["id_annee_academique"])[0]["libelle_annee_academique"]);
$pdf->setUe($ue);
$pdf->setEcue($ecue);
$pdf->setLevel($niveau);
$pdf->setCareer($parcours);
$pdf->setDepartment($department);
$pdf->setDepartmentImage("");
$pdf->setUfr($etablissement);
$pdf->setUfrImage($logoEtablissement);
$pdf->setTimeCM($volume[0]["vol_cm"]);
$pdf->setTimeTD($volume[0]["vol_td"]);
$pdf->setTimeTP($volume[0]["vol_tp"]);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage('L', 'A4');


if ($cm_state == true){
    # Selection of all CM groups
    $cmGroups = getGroups(1,$_SESSION["teacher"],(int)$_SESSION["id_annee_academique"],(int)$_SESSION["id_departement"],(int)$_SESSION["id_etablissement"],(int)$data->niveau);
//    debug($cmGroups);
    foreach ($cmGroups as $cmGroup){

        $cms = getCourses(1,$cmGroup["id_groupe"],$_SESSION["teacher"],(int)$_SESSION["id_annee_academique"],(int)$_SESSION["id_departement"],(int)$_SESSION["id_etablissement"],(int)$data->niveau);
        $groupLabel = getGroupLabel($cmGroup["id_groupe"]);
//        debug($cms);
        if (count($cms) > 0)
        {
            $totalHour = 0;
            $html = <<<EOD
        <table cellpadding="2">
            <tr>
                <td style="border-bottom-style: solid"><b>GROUPE : $groupLabel</b></td>
            </tr>
        </table>
EOD;
            $y = $pdf->GetY() + 1;
            $pdf->writeHTMLCell(0, 0, '', 59, $html, 0, 1, 0, true, '', true);

            # Affichage du type d'enseignement
            $html = <<<EOD
        <table cellpadding="3">
            <tr>
                <td width="15%">Type d'enseignement</td>
                <td width="20%">: <b>COURS MAGISTRAL</b></td>
            </tr>
        </table>
        <table border="1" cellpadding="3">
            <tr>
                <th scope="col" align="center" style="font-size: 0.9em; font-weight: bold" width="9%">DATE</th>
                <th scope="col" align="center" style="font-size: 0.9em; font-weight: bold" width="6%">DEBUT</th>
                <th scope="col" align="center" style="font-size: 0.9em; font-weight: bold" width="6%">FIN</th>
                <th scope="col" align="center" style="font-size: 0.9em; font-weight: bold" width="9%">DUREE (MIN)</th>
                <th scope="col" align="center" style="font-size: 0.9em; font-weight: bold" width="40%">CONTENU ENSEIGNEMENT</th>
                <th scope="col" align="center" style="font-size: 0.9em; font-weight: bold" width="20%">COMMENTAIRES</th>
                <th scope="col" align="center" style="font-size: 0.9em; font-weight: bold" width="10%">SALLE</th>
            </tr>
EOD;
            $breakPage = 0;
            # On affiche tous les CM pour ce groupe
            foreach ($cms as $cm){
                /*
                 * Liste des vairables du tableau */
                $totalHour += (int)$cm["duree_enseignement_minutes"] / 60;
                $date = $cm["date_enseignement"];
                $startTime = $cm["heure_debut"];
                $endTime = $cm["heure_fin"];
                $duration = $cm["duree_enseignement_minutes"];
                $comment = $cm["commentaire"] != "" ? $cm["commentaire"] : "Aucun commentaire";
                $content = $cm["contenu_enseignement"];
                $room = getRoomLabel((int)$cm["id_salle"]);

                $html .= <<<EOD
            <tr>
                <td align="center" style="height: 10px; line-height: 30px" width="9%">$date</td>
                <td align="center" style="height: 10px; line-height: 30px" width="6%">$startTime</td>
                <td align="center" style="height: 10px; line-height: 30px" width="6%">$endTime</td>
                <td align="center" style="height: 10px; line-height: 30px" width="9%">$duration</td>
                <td align="center" style="height: 30px; line-height: 15px" width="40%">$content</td>
                <td align="center" style="height: 30px; line-height: 15px" width="20%">$comment</td>
                <td align="center" style="height: 10px; line-height: 30px" width="10%">$room</td>
            </tr>
EOD;
                $breakPage++;
                if ($breakPage % 10 == 0){
                    $html .= <<<EOD
        </table>
                <br pagebreak="true"/>
EOD;
                    $y = $pdf->GetY();
                    $pdf->writeHTMLCell(0, 0, '', $y, $html, 0, 1, 0, true, '', true);

                    $html = <<<EOD
        <table cellpadding="2">
            <tr>
                <td style="border-bottom-style: solid"><b>GROUPE : </b></td>
            </tr>
        </table>
EOD;
                    $y = $pdf->GetY() - 8;
                    $pdf->writeHTMLCell(0, 0, '', $y, $html, 0, 1, 0, true, '', true);
                    $html = <<<EOD
        <table cellpadding="3">
            <tr>
                <td width="15%">Type d'enseignement</td>
                <td width="20%">: <b>COURS MAGISTRAL</b></td>
            </tr>
        </table>
        <table border="1" cellpadding="3">
EOD;
                }

            } # EndForeach

            $html .= <<<EOD
        <tr>
        <td colspan="7" align="center">Total volume Horaire : <b> $totalHour </b>H</td>
        
</tr>
        </table>
EOD;
            $y = $pdf->GetY();
            $pdf->writeHTMLCell(0, 0, '', $y, $html, 0, 1, 0, true, '', true);
            $cms = null;
        }
    }
}



//var_dump($data);
$pdf->Output('example_003.pdf', 'I');