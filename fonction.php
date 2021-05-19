<?php
/***
 * convertir en float
 * @param $val
 * @return float
 */
function floatvalue($val)
{
    $val = str_replace(",", ".", $val);
    $val = preg_replace('/\.(?=.*\.)/', '', $val);
    return floatval($val);
}

/**
 * récuperer les moyennes d'un etudiants
 * @param $etudiant
 * @param $semestre
 * @return mixed
 */
function fetchMoyenne($etudiant, $semestre)
{

    global $bdd;
    $SQL = "SELECT moy FROM pv_annuel WHERE numero_carte = '$etudiant' AND id_periode_evaluation = '$semestre' AND id_session  = 2";
    $resultat = $bdd->query($SQL);
    return $resultat->fetch();
}

/***
 * Obtenir la deliberations
 * @param $etud
 * @param $sem
 * @return array
 */
function fetchDeliberation($etud, $sem)
{
    global $bdd;
    $SQL = "SELECT libelle_deliberation as decision 
    FROM pv_annuel pv 
    JOIN deliberation dl ON dl.id_deliberation = pv.decision 
    WHERE pv.numero_carte = '$etud' AND pv.id_periode_evaluation = '$sem'  AND id_session  = 2";
    $resultat = $bdd->query($SQL);
    if (is_bool($resultat)) {
        return [
            'decision' => ''
        ];
    }
    return $resultat->fetchColumn();
}


function infoETB($id_etablissement)
{
    global $bdd;
    $id_etablissement = (int)$id_etablissement;
    $requete = "SELECT * FROM etablissement  WHERE id_etablissement = $id_etablissement";
    $resultat = $bdd->query($requete);
    return $resultat->fetch();
}

/***
 * charger la liste des étudiants
 * @return array
 */
function fetchEtudiants($annee_academique, $id_etablissement, $id_departement, $id_specialite, $niveau_etude, $premierepage, $parpage)
{
    global $bdd;
    $requete = "
    SELECT DISTINCT etudiants_.matricule_etudiant  as matricule , etudiants_.nom_etudiant as nom , etudiants_.prenom_etudiant  as prenom ,
    etudiants_.date_nais_etudiant  as date_naissance , pays_.libelle_pays as pays , etudiants_.id_sexe as sexe
    FROM pv_annuel 
    JOIN etudiants_ ON etudiants_.matricule_etudiant = pv_annuel.numero_carte
    JOIN inscription_ ON inscription_.numero = etudiants_.matricule_etudiant
    LEFT JOIN pays_ ON pays_.id_pays = etudiants_.idpays
    WHERE  
    pv_annuel.id_departement = '$id_departement' AND pv_annuel.id_specialite = '$id_specialite' AND pv_annuel.id_niveau =  '$niveau_etude' AND pv_annuel.id_annee_academique = 3
    AND inscription_.id_etablissement = '$id_etablissement' 
    ORDER BY nom LIMIT $premierepage,$parpage";

    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}

/** determiner le status d'un etudiant
function statusEtudiant($numerocarte)
{
    global $bdd;
    $requete = "SELECT * FROM groupe_td JOIN pv_annuel pv ON pv.numero_carte = groupe_td.numero_carte
                WHERE groupe_td.numero_carte ='$numerocarte' AND id_periode_evaluation = '3'";
    $resultat = $bdd->query($requete);
    if (!is_bool($resultat)) {
        $data = $resultat->fetch();
        // Ajourné + R
        if ($data['decision'] === '8' && $data['statut'] === 'R') {
            return "ERS";
        }
        // Autorisé + R
        if ($data['decision'] === '9' && $data['statut'] === 'R') {
            return "ERU";
        }

        // si status est nouveau
        if ($data['statut'] === 'N') {
            return "EN";
        }


    } else {
        return "";
    }

}
 */
function compterEtudiants($id_departement, $id_specialite, $niveau_etude)
{
    global $bdd;
    $requete = "SELECT DISTINCT COUNT(pv_annuel.numero_carte) as nb FROM pv_annuel WHERE  
    pv_annuel.id_departement = '$id_departement' AND pv_annuel.id_specialite = '$id_specialite' AND pv_annuel.id_niveau =  '$niveau_etude' AND pv_annuel.id_annee_academique = 3";

    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return 0;
    } else {
        return $resultat->fetch();
    }
}


function fetchEtudiantsTest($annee_academique, $id_etablissement, $id_departement, $id_specialite, $niveau_etude)
{
    global $bdd;
    $requete = "
    SELECT DISTINCT etudiants_.matricule_etudiant  as matricule , etudiants_.nom_etudiant as nom , etudiants_.prenom_etudiant  as prenom ,
    etudiants_.date_nais_etudiant  as date_naissance , pays_.libelle_pays as pays , etudiants_.id_sexe as sexe
    FROM pv_annuel 
    JOIN etudiants_ ON etudiants_.matricule_etudiant = pv_annuel.numero_carte
    JOIN inscription_ ON inscription_.numero = etudiants_.matricule_etudiant
    LEFT JOIN pays_ ON pays_.id_pays = etudiants_.idpays
    WHERE  
    pv_annuel.id_departement = '$id_departement' AND pv_annuel.id_specialite = '$id_specialite' AND pv_annuel.id_niveau =  '$niveau_etude' AND pv_annuel.id_annee_academique = 3
    AND inscription_.id_etablissement = '$id_etablissement' 
    ORDER BY nom ASC 
    ";

    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}

function fetchParcours($id = null)
{
    global $bdd;
    $id = (int)$id;
    $requete = "SELECT * FROM specialite";
    if (!empty($id) && !is_null($id)) {
        $requete .= " WHERE id_specialite = $id";
    }
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}

/***
 * Etablissements
 * @return array
 */
function fetchETB()
{
    global $bdd;
    $requete = "SELECT id_etablissement , nom_etablissement , code_etablissement , logo_etablissement FROM etablissement  LIMIT 0,13";
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}

function fetchOneEtabl($id_etablissement)
{
    global $bdd;
    $id_etablissement = (int)$id_etablissement;
    $requete = "SELECT * FROM etablissement where id_etablissement = $id_etablissement";
    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}

/**
 * info sur un departement
 * @return array
 */
function fetchOneDEPARTEMENT($id_etablissement = null)
{
    global $bdd;
    $id_etablissement = (int)$id_etablissement;
    $requete = "SELECT * FROM departement";
    if (!is_null($id_etablissement) && !empty($id_etablissement)) {
        $requete .= " WHERE id_departement = $id_etablissement";
    }

    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetch();
    }
}

/**
 * liste des departements
 * @return array
 */
function fetchDEPARTEMENT($id_departement = null, $id_etablissement = null)
{
    global $bdd;
    $id_etablissement = (int)$id_etablissement;
    $id_departement = (int)$id_departement;
    $requete = "SELECT * FROM departement";
    if (is_null($id_etablissement) && !empty($id_etablissement)) {
        $requete = "WHERE id_etablissement = $id_etablissement";
    }

    if (is_null($id_departement) && !empty($id_departement)) {
        $requete = "WHERE id_departement = $id_departement";
    }

    if (is_null($id_etablissement) && !empty($id_etablissement) && is_null($id_departement) && !empty($id_departement)) {
        $requete = "WHERE id_etablissement = $id_etablissement AND id_departement = $id_departement";
    }

    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}


function fetchOneMENTION($id_mention)
{
    global $bdd;
    $id_mention = (int)$id_mention;
    $requete = "SELECT * FROM mention WHERE id_mention = $id_mention";
    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetch();
    }

}


/**
 * liste des mentions
 * @return array
 */
function fetchMENTION($id_mention = null, $id_etablissement = null, $id_departement = null)
{
    global $bdd;
    $id_mention = (int)$id_mention;
    $id_etablissement = (int)$id_etablissement;
    $id_departement = (int)$id_departement;
    $requete = "SELECT * FROM mention";

    if (!empty($id) && !is_null($id)) {
        $requete .= " WHERE id_mention = $id_mention";
    }

    if (!empty($id_departement) && !is_null($id_departement)) {
        $requete .= " WHERE id_departement = $id_departement";
    }
    if (!empty($id_etablissement) && !is_null($id_etablissement)) {
        $requete .= " WHERE id_etablissement =  $id_etablissement";
    }

    if (!empty($id_departement) && !is_null($id_departement) && !empty($id_etablissement) && !is_null($id_etablissement)) {
        $requete .= " WHERE id_departement = $id_departement AND id_etablissement =  $id_etablissement";
    }

    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }

}


function composerMaquette($id_departement, $id_parcours, $id_semestre)
{
    global $bdd;

    $sql = "SELECT composer_maquette.id_ue , code_ue,intitule_ue,credit_ue , code_ecue,intitule_ecue,nom_departement,libelle_specialite ,libelle_semestre , 
    ue_obligatoire ,ecue_obligatoire , libelle_annee_academique FROM composer_maquette INNER JOIN ue ,ecue, specialite , departement,annee_academique,semestre 
    WHERE composer_maquette.id_ue=ue.id_ue AND composer_maquette.id_specialite=specialite.id_specialite 
    AND departement.id_departement = ue.id_departement AND ecue.id_ecue=composer_maquette.id_ecue AND annee_academique.id_annee_academique=composer_maquette.id_annee_academique
    AND semestre.id_semestre=composer_maquette.id_semestre
    AND semestre.id_semestre = $id_semestre AND departement.id_departement = $id_departement AND specialite.id_specialite = $id_parcours
    AND annee_academique.id_annee_academique = 3
    ";

    $resultat = $bdd->query($sql);

    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}


/* obtenir la note d'un etudiant */
function getMoyenneUE($numcarte, $code_ue)
{
    global $bdd;
    $sql = "SELECT moy FROM pv_semestriel WHERE numero_carte = '$numcarte' AND id_ue = $code_ue";
    $resultat = $bdd->query($sql);
    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetch();
    }
}


function fetchEtudiantInfo()
{
    global $bdd;
    $requete = "SELECT matricule_etudiant as matricule , nom_etudiant as nom , prenom_etudiant as prenom , date_nais_etudiant as date_naissance , alpha_2 as pays ,
    id_sexe as sexe
    FROM etudiant_geographie ";

    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}


function determinerSexe($id_sexe)
{
    if (isset($id_sexe) && !empty($id_sexe)) {
        if ($id_sexe == "1") {
            return "M";
        } else {
            return "F";
        }
    } else {
        return "";
    }
}

function getIp(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



