<?php

/***
 * Fonction qui retourne la liste des étudiants à partir de la table pv_annuel
 * @param $annee_academique
 * @param $id_etablissement
 * @param $id_departement
 * @param $id_specialite
 * @param $niveau_etude
 * @return array
 */
function ListeEtudiants($id_departement, $id_specialite, $niveau_etude, $premierepage = null, $parpage = null, $annee_academique)
{
    global $bdd;
    $requete = "
    SELECT pv.numero_carte  as matricule , pv.nom , pv.prenoms, GROUP_CONCAT(moy SEPARATOR '-') as moyennes  ,  GROUP_CONCAT(libelle_deliberation SEPARATOR '-') as deliberation
    FROM pv_annuel  pv
    JOIN deliberation dl ON dl.id_deliberation = pv.decision
    WHERE  
    id_departement = '$id_departement' AND 
    id_specialite = '$id_specialite' AND 
    pv.id_niveau =  '$niveau_etude' AND 
    id_annee_academique = '$annee_academique' AND
    id_session   = 2 AND
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
function InfoEtudiant($numero_matricule)
{
    global $bdd;
    $requete = "
    SELECT nom_etudiant as nom , prenom_etudiant as prenom , date_nais_etudiant as date_naissance, lieu_nais_etudiant as lieu_naissance , 
           s.libelle_sexe as sexe , p.lib_pays as pays
    FROM etu_diant et 
    JOIN sexe s ON s.id_sexe = et.id_sexe
    LEFT JOIN pays p ON p.id_pays = et.idpays
    WHERE matricule_etudiant = '$numero_matricule'";

    $resultat = $bdd->query($requete);
    $data = $resultat->fetch();
    if (is_bool($data)) {
        return array();
    } else {
        return $data;
    }
}

?>
