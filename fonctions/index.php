<?php
/* Inclusions des autres fonctions */
include_once "search.php";


/***
 * Déterminer le status sur le pv en fonction du paramètre suivant
 * @param $numerocarte
 * @return string
 */
function statusEtudiant($numerocarte, $niveau)
{
    global $bdd;
    $requete = "SELECT pv.id_niveau pv_niveau , lid.id_niveau lid_niveau , pv.decision 
                FROM pv_annuel pv 
                JOIN liste_inscrit_droit lid ON pv.numero_carte = lid.numero_carte 
                WHERE pv.numero_carte  ='$numerocarte' AND id_periode_evaluation = '3' AND pv.id_niveau = '$niveau'";

    $resultat = $bdd->query($requete);
    $data = $resultat->fetch();
    if (!is_bool($data)) {
        /* Admis en 2018 - 2019 */
        /* Il a toute les UE validées */
        if (in_array($data['decision'], array('1', '2', '3', '4', '5', '6', '7')) && ($data['pv_niveau'] > $data['lid_niveau'])) {
            /* Etudiant FIP */
            if (in_array($data['pv_niveau'], array('15', '16'))) {
                return "EFA";
            } /* Etudiant regulier */
            else {
                return "ENA";
            }
        } /* Autorisé en 2018 - 2019 */
        elseif ($data['decision'] === '9' && ($data['pv_niveau'] > $data['lid_niveau'])) {
            /* Etudiant FIP */
            if (in_array($data['pv_niveau'], array('15', '16'))) {
                return "EFU";
            } /* Etudiant regulier */
            else {
                return "ERU";
            }
        }  /* Ajournée en 2018 - 2019 */
        elseif ($data['decision'] === '8' && ($data['pv_niveau'] == $data['lid_niveau'])) {
            /* Etudiant FIP */
            if (in_array($data['pv_niveau'], array('15', '16'))) {
                return "EFS";
            } /* Etudiant regulier */
            else {
                return "ERS";
            }
        } else {
            /* Etudiant FIP */
            if (in_array($data['pv_niveau'], array('15', '16'))) {
                return "EFN";
            } /* Etudiant regulier */
            else {
                return "ENN";
            }
        }
    } else {
        return "";
    }
}

/**
 * Compter la liste des étudiants présents dans la base de donnée en fonction des paramètres ci-dessous :
 * @param $id_departement
 * @param $id_specialite
 * @param $niveau_etude
 * @return int|mixed
 */
function compterEtudiants($annee,$id_departement, $id_specialite, $niveau_etude)
{
    global $bdd;
    $requete = "SELECT DISTINCT COUNT(pv_annuel.numero_carte) as nb FROM pv_annuel WHERE  
    pv_annuel.id_departement = '$id_departement' AND pv_annuel.id_specialite = '$id_specialite' AND pv_annuel.id_niveau =  '$niveau_etude' 
    AND pv_annuel.id_annee_academique = $annee";
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return 0;
    } else {
        return $resultat->fetch();
    }
}

/***
 * Déliberation d'un étudiant
 * @param $etud
 * @param $sem
 * @return mixed|string[]
 */
function deliberationEtudiant($etud, $sem)
{
    global $bdd;
    $SQL = "SELECT libelle_deliberation as decision 
    FROM pv_annuel pv 
    JOIN deliberation dl ON dl.id_deliberation = pv.decision 
    WHERE pv.numero_carte = '$etud' AND pv.id_periode_evaluation = '$sem'  AND id_session  = 2";

    $resultat = $bdd->query($SQL);
    if (is_bool($resultat)) {
        return array('decision' => '');
    }
    return $resultat->fetchColumn();
}


/***
 * moyenne d'un étudiant
 * @param $etud
 * @param $sem
 * @return mixed|string[]
 */
function moyEtudiant($etud, $sem)
{
    global $bdd;
    $SQL = "SELECT moy as moyenne
    FROM pv_annuel pv 
    WHERE pv.numero_carte = '$etud' AND pv.id_periode_evaluation = '$sem'  AND id_session  = 2";
    $resultat = $bdd->query($SQL);
    if (is_bool($resultat)) {
        return [
            'decision' => ''
        ];
    }
    return $resultat->fetchColumn();
}


/**
 * Function exst() - Checks if the variable has been set
 * (copy/paste it in any place of your code)
 *
 * If the variable is set and not empty returns the variable (no transformation)
 * If the variable is not set or empty, returns the $default value
 *
 * @param mixed $var
 * @param mixed $default
 *
 * @return mixed
 */

function exist(&$var, $default = "")
{
    $t = "";
    if (!isset($var) || !$var) {
        if (isset($default) && $default != "") $t = $default;
    } else {
        $t = $var;
    }
    if (is_string($t)) $t = trim($t);
    return $t;
}

/****
 * Déterminer le sexe
 * @param $sexe
 * @return string
 */
function sexe(&$sexe)
{
    if (isset($sexe) && $sexe === '1') {
        return "M";
    } else if (isset($sexe) && $sexe === '2') {
        return "F";
    } else {
        return $sexe;
    }
}


/***
 *
 */
function ListePV($id_anne)
{
    global $bdd;
    $SQL = "SELECT DISTINCT etablissement.id_etablissement , departement.id_departement , specialite.id_specialite , pv_annuel.id_niveau , niveau.libelle_niveau , mention.id_mention , specialite.libelle_specialite , departement.nom_departement , 
  mention.libelle_mention , etablissement.nom_etablissement
FROM `pv_annuel` 
JOIN specialite ON specialite.id_specialite = pv_annuel.id_specialite
JOIN departement ON departement.id_departement = pv_annuel.id_departement
JOIN niveau ON niveau.id_niveau = pv_annuel.id_niveau
JOIN mention ON mention.id_mention = specialite.id_mention
JOIN etablissement On departement.id_etablissement = etablissement.id_etablissement
WHERE id_annee_academique = $id_anne";
    $resultat = $bdd->query($SQL);
    if (is_bool($resultat)) {
        return array();
    }
    return $resultat->fetchAll();
}

function ListePV1($id_etablissment,$id_departement,$id_anne)
{
    global $bdd;
    $SQL = "SELECT DISTINCT etablissement.id_etablissement , departement.id_departement , specialite.id_specialite , pv_annuel.id_niveau , niveau.libelle_niveau , mention.id_mention , specialite.libelle_specialite , departement.nom_departement , 
  mention.libelle_mention , etablissement.nom_etablissement
FROM `pv_annuel` 
JOIN specialite ON specialite.id_specialite = pv_annuel.id_specialite
JOIN departement ON departement.id_departement = pv_annuel.id_departement
JOIN niveau ON niveau.id_niveau = pv_annuel.id_niveau
JOIN mention ON mention.id_mention = specialite.id_mention
JOIN etablissement On departement.id_etablissement = etablissement.id_etablissement
WHERE id_annee_academique = $id_anne and etablissement.id_etablissement in ($id_etablissment) and departement.id_departement in ($id_departement)";
    $resultat = $bdd->query($SQL);
    if (is_bool($resultat)) {
        return array();
    }
    return $resultat->fetchAll();
}

