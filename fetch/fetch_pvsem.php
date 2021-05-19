<?php

/* obtenir les ue d'un pv semestriel */
function getUE($periode)
{
    global $bdd;
    $sql = "SELECT DISTINCT pv.id_ue , ue.code_ue FROM pv_semestriel pv JOIN ue ON ue.id_ue = pv.id_ue WHERE pv.id_periode_evaluation = '$periode' ";
    $resultat = $bdd->query($sql);
    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}

/***
 * charger la liste des étudiants pour le pv sémestriel
 * @return array
 */
function fetchEtudiantPVSEM($niveau_etude, $periode, $premierepage, $parpage)
{
    global $bdd;
    $requete = "
    SELECT 
    etudiant_geographie.nom_etudiant as nom , etudiant_geographie.prenom_etudiant as prenom , etudiant_geographie.matricule_etudiant as matricule , 
    etudiant_geographie.date_nais_etudiant as date_naissance , etudiant_geographie.id_sexe as sexe, etudiant_geographie.alpha_2 as pays
    FROM `etudiant_geographie` 
    JOIN pv_semestriel  ON etudiant_geographie.matricule_etudiant = pv_semestriel.numero_carte 
    WHERE pv_semestriel.id_niveau = '$niveau_etude' AND pv_semestriel.id_periode_evaluation = $periode
    AND pv_semestriel.id_periode_evaluation = 1 
    ORDER BY nom ASC 
    LIMIT $premierepage,$parpage
    ";


    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return [];
    } else {
        return $resultat->fetchAll();
    }
}

/**
 * Compter les etudiants pour générer un PV SEM
 * @param $id_departement
 * @param $niveau_etude
 * @return int|mixed
 */
function compterEtudiantsPVSEM($id_departement, $niveau_etude)
{
    global $bdd;
    $requete = "SELECT DISTINCT COUNT(numero_carte) as nb  FROM pv_semestriel 
    WHERE  id_departement = '$id_departement'
    AND id_niveau =  '$niveau_etude'";
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return 0;
    } else {
        return $resultat->fetch();
    }
}


function getMoySEM($num, $id_ue, $niveau, $periode)
{
    global $bdd;
    $requete = "SELECT * FROM pv_semestriel WHERE  numero_carte = '$num' AND id_ue = '$id_ue'  AND id_niveau = '$niveau' AND id_periode_evaluation = '$periode' ";
    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return 0;
    } else {
        return $resultat->fetch();
    }
}