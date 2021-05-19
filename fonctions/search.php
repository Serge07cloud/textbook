<?php

/***
 * Etablissements
 * @return array
 */
function ListeEtablissements()
{
    global $bdd;
    $requete = "SELECT id_etablissement , nom_etablissement , code_etablissement , logo_etablissement FROM etablissement  LIMIT 0,13";
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return array();
    } else {
        return $resultat->fetchAll();
    }
}

function ListeEta($id_etablissement)
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


/***
 * Info sur un etablissement
 * @param $id_etablissement
 * @return mixed
 */
function InfoEtablissement($id_etablissement)
{
    global $bdd;
    $id_etablissement = (int)$id_etablissement;
    $requete = "SELECT * FROM etablissement  WHERE id_etablissement = $id_etablissement";
    $resultat = $bdd->query($requete);
    return $resultat->fetch();
}

/***
 * Info sur les parcours
 * @param null $id
 * @return array
 */
function InfoParcours($id = null)
{
    global $bdd;
    $id = (int)$id;
    $requete = "SELECT * FROM specialite";
    if (!empty($id) && !is_null($id)) {
        $requete .= " WHERE id_specialite = $id";
    }
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return array();
    } else {
        return $resultat->fetchAll();
    }
}


/**
 * Info sur une mention
 * @param $id_mention
 * @return array|mixed
 */
function InfoMention($id_mention)
{
    global $bdd;
    $id_mention = (int)$id_mention;
    $requete = "SELECT * FROM mention WHERE id_mention = $id_mention";
    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return array();
    } else {
        return $resultat->fetch();
    }

}


/**
 * info sur un departement
 * @return array
 */
function InfoDepartement($id_etablissement = null)
{
    global $bdd;
    $id_etablissement = (int)$id_etablissement;
    $requete = "SELECT * FROM departement";
    if (!is_null($id_etablissement) && !empty($id_etablissement)) {
        $requete .= " WHERE id_departement = $id_etablissement";
    }

    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return array();
    } else {
        return $resultat->fetch();
    }
}

function InfoStatut($code)
{
    global $bdd;
    $requete = "SELECT * FROM statut_etudiant WHERE code_statut_etudiant = '$code'";
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return "";
    } else {
        return $resultat->fetch();
    }
}
