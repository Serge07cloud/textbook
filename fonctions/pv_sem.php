<?php

/***
 * Fonction qui retourne la liste des étudiants à partir de la table pv_semestriel
 * @param $annee_academique
 * @param $id_etablissement
 * @param $id_departement
 * @param $id_specialite
 * @param $niveau_etude
 * @return array
 */
function ListeEtdPVSEM($id_annee, $id_departement, $niveau_etude, $id_periode, $premierepage = null, $parpage = null)
{
    global $bdd;
    $requete = "
    SELECT pv.numero_carte  as matricule , pv.nom , pv.prenoms , pv.date_nais_etudiant , pv.lieu_nais_etudiant 
    FROM pv_semestriel  pv
    WHERE
    pv.id_annee_academique	= $id_annee AND
    id_departement = '$id_departement' AND 
    pv.id_niveau =  '$niveau_etude' AND 
    id_session   = 1 AND
    id_periode_evaluation= $id_periode AND      
    pv.numero_carte <> ''
    GROUP BY pv.numero_carte , pv.nom , pv.prenoms
    ORDER BY nom ASC";


    if (!is_null($premierepage) && !is_null($parpage)) {
        $requete .= " LIMIT $premierepage,$parpage";
    }
    $resultat = $bdd->query($requete);

    if (is_bool($resultat)) {
        return array();
    } else {
        return $resultat->fetchAll();
    }
}

/***
 * Info sur un seul étudiant en fonction de son numéro de matricule
 * @param $numero_matricule
 */
function InfoEtdPVSEM($numero_matricule)
{
    global $bdd;
    $requete = "
    SELECT nom_etudiant  as nom , prenom_etudiant as prenom , date_nais_etudiant as date_naissance,
    lieu_nais_etudiant as lieu_naissance , et.sexe_etudiant as sexe , p.lib_pays as pays
    FROM etudiant et
    LEFT JOIN pays p ON p.id_pays = et.id_pays
    WHERE  
    matricule_etudiant = '$numero_matricule'";
    $resultat = $bdd->query($requete);
    $data = $resultat->fetch();
    if (is_bool($data)) {
        return array();
    } else {
        return $data;
    }
}


function ListeUE($id_annee, $id_departement, $id_periode)
{
    global $bdd;
    $requete = "
    SELECT DISTINCT pv.id_ue , ue.code_ue FROM pv_semestriel pv JOIN ue ON pv.id_ue = ue.id_ue WHERE pv.id_annee_academique	= $id_annee AND pv.id_periode_evaluation = $id_periode AND pv.id_departement = $id_departement";
    $resultat = $bdd->query($requete);
    $data = $resultat->fetchAll();
    if (is_bool($data)) {
        return array();
    } else {
        return $data;
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

/**
 * Compter la liste des étudiants présents dans la base de donnée en fonction des paramètres ci-dessous :
 * @param $id_departement
 * @param $id_specialite
 * @param $niveau_etude
 * @return int|mixed
 */
function compterEtdPVSEM($id_annee, $id_departement, $id_specialite, $niveau_etude)
{
    global $bdd;
    $requete = "SELECT DISTINCT COUNT(pv.numero_carte) as nb FROM  pv_semestriel pv WHERE  
    pv.id_departement = '$id_departement' AND pv.id_specialite = '$id_specialite' AND pv.id_niveau =  '$niveau_etude' 
                                                                                 AND pv.id_annee_academique = $id_annee";
    $resultat = $bdd->query($requete);
    if (is_bool($resultat)) {
        return 0;
    } else {
        return $resultat->fetch();
    }
}

?>
