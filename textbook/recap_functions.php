<?php
require_once "config/connection.php";

/*
 * Selection des enseignants selon le departement et l'UFR */
function getAllTeachers($idEtablissement, $idDepartement){
    $dbh = getConnection();
    $result = array();
    $query = $dbh->query("SELECT id_enseignant, nom_enseignant, prenom_enseignant FROM enseignant WHERE id_etablissement = '" . $idEtablissement . "' AND id_departement = " . $idDepartement);
    while($data = $query->fetch(PDO::FETCH_ASSOC)){
        $result[] = $data;
    }
    return $result;
}

/*
 * Liste de tous les UFR: Sélection de 10 UFR */
function getAllUfr(){
    $dbh = getConnection();
    $result = array();
    $query = $dbh->query("SELECT id_etablissement, nom_etablissement FROM etablissement");
    while($data = $query->fetch(PDO::FETCH_ASSOC)){
        $result[] = $data;
    }
    return $result;
}

/*
 * Liste des departements selon l'UFR selectionnée*/
function getDepartement($idEtablissement){
    $dbh = getConnection();
    $result = array();
    $query = $dbh->query("SELECT id_departement, nom_departement FROM departement WHERE id_etablissement = " . $idEtablissement);
    while($data = $query->fetch(PDO::FETCH_ASSOC)){
        $result[] = $data;
    }
    return $result;
}
/*
 * Liste de tous les niveaux : Licence 1 au Master 2*/
function getNiveau(){
    $dbh = getConnection();
    $query = $dbh->query("SELECT id_niveau, libelle_niveau FROM niveau WHERE id_niveau BETWEEN 1 AND 5");
    while($data = $query->fetch(PDO::FETCH_ASSOC)){
        $result[] = $data;
    }
    return $result;
}

/*
 * Sélection de l'identifiant des spécialités (Parcours) dans lesquelles interviennent un enseignant */
function getIdSpecialites($idEnseignant){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT id_specialite FROM composer_maquette AS cmp INNER JOIN enseigner AS ens  WHERE cmp.id_composer_maquette = ens.id_composer_maquette AND id_enseignant = " . $idEnseignant);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/*
 * Selection des spécialités */
function getSpecialites($tabIdSpecialites){
    $dbh = getConnection();
    $result = array();
    foreach ($tabIdSpecialites as $specialite){
        $query = $dbh->query("SELECT id_specialite, libelle_specialite FROM specialite WHERE id_specialite = " . $specialite["id_specialite"]);
        $result[] = $query->fetch(PDO::FETCH_ASSOC);
    }
    return $result;
}
/*
 * Selection de l'identifiant composer maquette d'un enseignant */
function getIdComposerMaquette($idEnseignant){
    $dbh = getConnection();
    $result = array();
    $query = $dbh->query("SELECT DISTINCT id_composer_maquette FROM enseigner WHERE id_enseignant = " . $idEnseignant);
//    $query = $dbh->query("SELECT DISTINCT id_ecue FROM composer_maquette AS cmp NATURAL JOIN enseigner WHERE id_enseignant = " . $idEnseignant);
//    while ($data = ){
//        $result[] = $data;
//    }
    return $query->fetchAll();
}
/*
 * Selection des identifiants ue et ecue à partir de l'identifiant composer maquette */
function getUeAndEcu($idComposerMaquette){
    $dbh = getConnection();
    $query = $dbh->query("SELECT id_ue, id_ecue FROM composer_maquette WHERE id_composer_maquette = " . $idComposerMaquette);
    return $query->fetch(PDO::FETCH_ASSOC);
}

/*
 * Selection du libelle d'un ue à partir de son identifiant */
function getLibelleUe($idUe){
    $dbh = getConnection();
    $result = array();
    $query = $dbh->query("SELECT intitule_ue FROM ue WHERE id_ue = " . $idUe);
    return $query->fetchColumn();
}

/*
 * Selection du libelle d'un ecue à partir de son identifiant */
function getLibelleEcue($idEcue){
    $dbh = getConnection();
    $result = array();
    $query = $dbh->query("SELECT intitule_ecue FROM ecue WHERE id_ecue = " . $idEcue);
    return $query->fetchColumn();
}

/*
 * Sélection des identifiants ecue selon la spécialité (Parcours) et l'enseignant */
function getIdEcue($idEnseignant){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT c.id_ecue FROM composer_maquette AS c INNER JOIN enseigner AS e ON c.id_composer_maquette = e.id_composer_maquette AND id_enseignant = " . $idEnseignant);
    return $query->fetchAll();
}

//function getEcue($tabIdEcue){
//    $dbh = getConnection();
//    $result = array();
//    foreach ($tabIdEcue as $item){
//        $query = $dbh->query("SELECT id_ecue, intitule_ecue FROM ecue WHERE id_ecue = " . $item["id_ecue"]);
//        $result[] = $query->fetch(PDO::FETCH_ASSOC);
//    }
//    return $result;
//}

function getTeacherName($id){
    $dbh = getConnection();
    $query = $dbh->query("SELECT nom_enseignant, prenom_enseignant FROM enseignant WHERE id_enseignant = " . $id);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getUfrById($idUfr){
    $dbh = getConnection();
    $query = $dbh->query("SELECT nom_etablissement FROM etablissement WHERE id_etablissement = " . $idUfr);
    return $query->fetchColumn();
}

function getDepartmentById($idDepartment){
    $dbh = getConnection();
    $query = $dbh->query("SELECT nom_departement FROM departement WHERE id_departement = " . $idDepartment);
    return $query->fetchColumn();
}

function getSpecialityById($idSpecialite){
    $dbh = getConnection();
    $query = $dbh->query("SELECT libelle_specialite FROM specialite WHERE id_specialite = " . $idSpecialite);
    return $query->fetchColumn();
}

function getAnneeAcademiqueById($idAnnee){
    $dbh = getConnection();
    $query = $dbh->query("SELECT libelle_annee_academique FROM annee_academique WHERE id_annee_academique = " . $idAnnee);
    return $query->fetchColumn();
}

function getLevelById($idLevel){
    $dbh = getConnection();
    $query = $dbh->query("SELECT libelle_niveau FROM niveau WHERE id_niveau = " . $idLevel);
    return $query->fetchColumn();
}

function getGroupById($idGroupe){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT libelle_groupe FROM groupe WHERE id_groupe = " . $idGroupe);
    return $query->fetchColumn();
}

function getUeByIdEcue($idEcue){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT intitule_ue FROM ue NATURAL JOIN composer_maquette WHERE id_ecue = " . $idEcue);
    return $query->fetchColumn();
}

function getCourses($idEnseignant, $idNiveau, $idAnnee){
    $dbh = getConnection();
    $query = $dbh->query("SELECT *  FROM enseigner AS ens INNER JOIN classe AS cls ON ens.id_etablissement = cls.id_etablissement AND ens.id_departement = cls.id_departement AND ens.id_enseignant = " . $idEnseignant . " AND cls.id_niveau = " . $idNiveau . " AND ens.id_annee_academique = " . $idAnnee);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
/*
 * Selection de tous les groupes ayant eu cours avec l'enseignant dans l'ecue */
function getGroupes($idEnseignant, $idNiveau, $idAnnee){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT ens.id_groupe FROM enseigner AS ens INNER JOIN classe AS cls ON ens.id_etablissement = cls.id_etablissement AND ens.id_departement = cls.id_departement AND ens.id_enseignant = " . $idEnseignant . " AND cls.id_niveau = " . $idNiveau . " AND ens.id_annee_academique = " . $idAnnee);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

/*
 * Selection de tous les CM */
function getCM($idEnseignant,$idNiveau,$idAnnee,$idGroupe){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT ens.id_type_enseignement, ens.date_enseignement, ens.id_annee_academique, ens.id_groupe, ens.id_type_enseignement, ens.heure_debut, ens.heure_fin, ens.duree_enseignement_minutes, ens.commentaire, ens.id_salle  FROM enseigner AS ens INNER JOIN classe AS cls ON ens.id_etablissement = cls.id_etablissement AND ens.id_departement = cls.id_departement AND ens.id_enseignant = " . $idEnseignant . " AND cls.id_niveau = " . $idNiveau . " AND ens.id_annee_academique = " . $idAnnee . " AND ens.id_groupe =  " . $idGroupe . " AND ens.id_type_enseignement = 1");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTD($idEnseignant,$idNiveau,$idAnnee,$idGroupe){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT ens.id_type_enseignement, ens.date_enseignement, ens.id_annee_academique, ens.id_groupe, ens.id_type_enseignement, ens.heure_debut, ens.heure_fin, ens.duree_enseignement_minutes, ens.commentaire, ens.id_salle  FROM enseigner AS ens INNER JOIN classe AS cls ON ens.id_etablissement = cls.id_etablissement AND ens.id_departement = cls.id_departement AND ens.id_enseignant = " . $idEnseignant . " AND cls.id_niveau = " . $idNiveau . " AND ens.id_annee_academique = " . $idAnnee . " AND ens.id_groupe =  " . $idGroupe . " AND ens.id_type_enseignement = 2");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTP($idEnseignant,$idNiveau,$idAnnee,$idGroupe){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT ens.id_type_enseignement, ens.date_enseignement, ens.id_annee_academique, ens.id_groupe, ens.id_type_enseignement, ens.heure_debut, ens.heure_fin, ens.duree_enseignement_minutes, ens.commentaire, ens.id_salle  FROM enseigner AS ens INNER JOIN classe AS cls ON ens.id_etablissement = cls.id_etablissement AND ens.id_departement = cls.id_departement AND ens.id_enseignant = " . $idEnseignant . " AND cls.id_niveau = " . $idNiveau . " AND ens.id_annee_academique = " . $idAnnee . " AND ens.id_groupe =  " . $idGroupe . " AND ens.id_type_enseignement = 3");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTypeEnseignement($idTypeEnseignement){
    $dbh = getConnection();
    $query = $dbh->query("SELECT code_type_enseignement FROM type_enseignement WHERE id_type_enseignement = " . $idTypeEnseignement);
    return $query->fetchColumn();
}

function getAllSchoolYear(){
    $dbh = getConnection();
    $query = $dbh->query("SELECT id_annee_academique,libelle_annee_academique FROM annee_academique WHERE 1");
    $result = array();
    while ($data = $query->fetch(PDO::FETCH_ASSOC)){
        $result [] = $data;
    }
    return $result;
}

function getSchoolYearById($idSchoolYear){
    $dbh = getConnection();
    $query = $dbh->query("SELECT libelle_annee_academique FROM annee_academique WHERE id_annee_academique = " . $idSchoolYear);
    return $query->fetchColumn();
}

function getSalleById($idSalle){
    $dbh = getConnection();
    $query = $dbh->query("SELECT libelle_salle FROM salle WHERE id_salle = " . $idSalle);
    return $query->fetchColumn();
}

function getTempsAttribue($idEcue, $idSpecialite, $idAnneeAcademique){
    $dbh = getConnection();
    $query = $dbh->query("SELECT DISTINCT vol_cm, vol_td, vol_tp FROM attribuer WHERE id_ecue = " . $idEcue . " AND id_specialite = " . $idSpecialite . " AND id_annee_academique = " . $idAnneeAcademique);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getLogoUfr($idEtablissement){
    $dbh = getConnection();
    $query = $dbh->query("SELECT logo_etablissement FROM etablissement WHERE id_etablissement = " . $idEtablissement);
    return $query->fetchColumn();
}

//function getUe($user, $schoolYear){
//    $dbh = getConnection();
//    $query = $dbh->query("SELECT intitule_ue FROM ue WHERE id_ue IN ( SELECT DISTINCT cmp.id_ue FROM composer_maquette AS cmp INNER JOIN enseigner AS ens ON cmp.id_composer_maquette = ens.id_composer_maquette WHERE cmp.id_composer_maquette IN ( SELECT DISTINCT id_composer_maquette FROM enseigner WHERE id_annee_academique = ". $schoolYear ." AND id_utilisateur = ". $user ."))");
//    return $query->fetchAll();
//}
/*
 * Fonction de debogage */
//function debug($value){
//    echo "<pre>";
//    var_dump($value);
//    echo "</pre>";
//}