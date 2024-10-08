<?php

function connexion(){
    return new PDO('mysql:host=localhost; dbname=ufhbedupxhonlines; charset=utf8', 'root', '');
}
function debug($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function getUser($userId){
    $bdd = connexion();
    $query = $bdd->query("SELECT nom_enseignant, prenom_enseignant FROM enseignant WHERE id_enseignant = ". $userId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getSchoolYear($yearId){
    $bdd = connexion();
    $query = $bdd->query("SELECT libelle_annee_academique FROM annee_academique WHERE id_annee_academique = ". $yearId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getUe($ueId){
    $bdd = connexion();
    $query = $bdd->query("SELECT intitule_ue FROM ue WHERE id_ue = ". $ueId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getEcue($ecueId){
    $bdd = connexion();
    $query = $bdd->query("SELECT intitule_ecue FROM ecue WHERE id_ecue = ". $ecueId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getNiveau($niveauId){
    $bdd = connexion();
    $query = $bdd->query("SELECT libelle_niveau FROM niveau WHERE id_niveau = ". $niveauId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getParcours($parcoursId){
    $bdd = connexion();
    $query = $bdd->query("SELECT libelle_specialite FROM specialite WHERE id_specialite = ". $parcoursId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getDepartment($departmentId){
    $bdd = connexion();
    $query = $bdd->query("SELECT nom_departement FROM departement WHERE id_departement = ". $departmentId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getEtablissement($etablissementId){
    $bdd = connexion();
    $query = $bdd->query("SELECT nom_etablissement, logo_etablissement FROM etablissement WHERE id_etablissement = ". $etablissementId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTempsAttribue($idEcue, $idSpecialite, $idAnneeAcademique, $teacher){
    $dbh = connexion();
    $query = $dbh->query("SELECT DISTINCT vol_cm, vol_td, vol_tp FROM attribuer WHERE id_ecue = " . $idEcue . " AND id_specialite = " . $idSpecialite . " AND id_annee_academique = " . $idAnneeAcademique . " AND id_enseignant = " . $teacher);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/*
 * Return groups ID depending on the type param
 * type = 1 => CM
 * type = 2 => TD
 * type = 3 => TP*/
function getGroups($type,$teacherId, $schoolYearId,$departmentId,$institutionId,$gradeId){
    $dbh = connexion();
    $query = $dbh->query("SELECT DISTINCT id_groupe FROM enseigner AS ens
                                   INNER JOIN composer_maquette AS cmp ON cmp.id_composer_maquette = ens.id_composer_maquette
                                   INNER JOIN semestre AS sem ON cmp.id_semestre = sem.id_semestre
                                   AND ens.id_enseignant = ".$teacherId."
                                   AND ens.id_annee_academique = ".$schoolYearId."
                                   AND ens.id_departement = ".$departmentId."
                                   AND ens.id_etablissement = ".$institutionId."
                                   AND ens.id_type_enseignement = ".$type."
                                   AND sem.id_niveau = ".$gradeId." ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/*
 * Return all informations according to the group ID */
function getCourses($type,$groupId,$teacherId, $schoolYearId,$departmentId,$institutionId,$gradeId){
    $dbh = connexion();
    $query = $dbh->query("SELECT ens.date_enseignement, ens.id_annee_academique, ens.id_groupe, ens.id_type_enseignement, ens.heure_debut, ens.heure_fin, ens.duree_enseignement_minutes, ens.contenu_enseignement, ens.commentaire, ens.id_salle FROM enseigner AS ens
                                   INNER JOIN composer_maquette AS cmp ON cmp.id_composer_maquette = ens.id_composer_maquette
                                   INNER JOIN semestre AS sem ON cmp.id_semestre = sem.id_semestre
                                   AND ens.id_enseignant = ".$teacherId."
                                   AND ens.id_annee_academique = ".$schoolYearId."
                                   AND ens.id_departement = ".$departmentId."
                                   AND ens.id_etablissement = ".$institutionId."
                                   AND ens.id_type_enseignement = ".$type."
                                   AND ens.id_groupe = ".$groupId."
                                   AND sem.id_niveau = ".$gradeId." ");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getGroupLabel($groupId){
    $dbh = connexion();
    $query = $dbh->query("SELECT DISTINCT libelle_groupe FROM groupe WHERE id_groupe = " . $groupId);
    return $query->fetchColumn();
}

function getRoomLabel($roomId){
    $dbh = connexion();
    $query = $dbh->query("SELECT libelle_salle FROM salle WHERE id_salle = " . $roomId);
    return $query->fetchColumn();
}

function getInstitutionImage($institutionId){
    $dbh = connexion();
    $query = $dbh->query("SELECT logo_etablissement FROM etablissement WHERE id_etablissement = " . $institutionId);
    return $query->fetchColumn();
}

function getTeachers($departmentId){
    $dbh = connexion();
    $query = $dbh->query("SELECT id_enseignant, nom_enseignant, prenom_enseignant FROM enseignant WHERE id_departement = " . $departmentId);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getEducationType($type){
    switch ($type){
        case 1:
            $value = "COURS MAGISTRAL";
            break;
        case 2:
            $value = "TRAVAUX DIRIGES";
            break;
        default:
            $value = "TRAVAUX PRATIQUES";
            break;
    }
    return $value;
}

function displayTable($pdf, array $data, $pageBreak = false){
    $groups = getGroups($data["type"],$data["teacher"],$data["schoolYear"],$data["department"],$data["institution"],$data["grade"]);

    foreach ($groups as $group)
    {
        $courses = getCourses($data["type"],$group["id_groupe"],$data["teacher"],$data["schoolYear"],$data["department"],$data["institution"],$data["grade"]);

        $groupLabel = getGroupLabel($group["id_groupe"]);
        if (count($courses) > 0)
        {
            $totalHour = 0;
            if ($pageBreak == true)
            {

                $totalHour = 0;
                $html = <<<EOD
            <br pagebreak="true" />
EOD;
                $y = $pdf->GetY();
                $pdf->writeHTMLCell(0, 0, '', $y, $html, 0, 1, 0, true, '', true);
            }

            $html = <<<EOD
            <table>
                <tr>
                    <td style="border-bottom-style: solid"><b>GROUPE : $groupLabel</b></td>
                </tr>
            </table>
EOD;
            $pdf->writeHTMLCell(0, 0, '', 70, $html, 0, 1, 0, true, '', true);

            # Affichage du type d'enseignement
            $educationType = getEducationType($data["type"]);
            $html = <<<EOD
            <table style="border-collapse: separate; border-spacing: 5px;">
                <tr>
                    <td width="15%">Type d'enseignement</td>
                    <td width="20%">: <b>$educationType</b></td>
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
            $pageBreak = 0;
            # On affiche tous les CM pour ce groupe
            foreach ($courses as $course){
                /*
                 * Liste des vairables du tableau */
                $totalHour += (int)$course["duree_enseignement_minutes"] / 60;
                $date = $course["date_enseignement"];
                $startTime = $course["heure_debut"];
                $endTime = $course["heure_fin"];
                $duration = $course["duree_enseignement_minutes"];
                $comment = $course["commentaire"] != "" ? $course["commentaire"] : "Aucun commentaire";
                $content = $course["contenu_enseignement"];
                $room = getRoomLabel((int)$course["id_salle"]);

                $html .= <<<EOD
            <tr>
                <td align="center" style="height: 10px; line-height: 30px" width="9%">$date</td>
                <td align="center" style="height: 10px; line-height: 30px" width="6%">$startTime</td>
                <td align="center" style="height: 10px; line-height: 30px" width="6%">$endTime</td>
                <td align="center" style="height: 10px; line-height: 30px" width="9%">$duration</td>
                <td align="" style="height: 30px; line-height: 15px" width="40%">$content</td>
                <td align="center" style="height: 30px; line-height: 15px" width="20%">$comment</td>
                <td align="center" style="height: 10px; line-height: 30px; font-size: 9px" width="10%">$room</td>
            </tr>
EOD;
                $pageBreak++;
                if ($pageBreak % 9 == 0){
                    $html .= <<<EOD
                </table>
                <br pagebreak="true"/>
EOD;
                    $y = $pdf->GetY() + 5;
                    $pdf->writeHTMLCell(0, 0, '', $y, $html, 0, 1, 0, true, '', true);

                    $html = <<<EOD
                <table cellpadding="2">
                    <tr>
                        <td style="border-bottom-style: solid"><b>GROUPE : $groupLabel </b></td>
                    </tr>
                </table>
EOD;
                    $y = $pdf->GetY() + 5;
                    $pdf->writeHTMLCell(0, 0, '', $y, $html, 0, 1, 0, true, '', true);
                    $html = <<<EOD
                <table style="border-collapse: separate; border-spacing: 5px;">
                    <tr>
                        <td width="15%">Type d'enseignement</td>
                        <td width="20%">: <b>$educationType</b></td>
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
            $courses = null;
        }
    }
}