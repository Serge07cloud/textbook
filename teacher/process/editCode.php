<?php

if (!empty($_POST["cocher"])) {

    $id = intval($_POST["cocher"][0]);

    if (isset($bdd)) {
        $query = $bdd->query("SELECT e.id_enseignant, e.matricule_enseignant,
           e.nom_enseignant, e.prenom_enseignant, e.date_nais_enseignant, e.sexe_enseignant,
           e.tel_enseignant, e.tel2_enseignant, e.email_enseignant, e.email2_enseignant,
           e.adresse_enseignant, e.num_compte_bancaire, e.etablissement_bancaire,
           e.permanent, e.date_recrutement_enseignant, e.id_etablissement, e.id_departement,
           e.etablissement_origine, e.id_laboratoire, e.id_specialite_labo, e.id_pays,
           u.id_utilisateur, u.login_utilisateur, u.mot_passe_utilisateur, u.id_groupe_utilisateur
           FROM enseignant e INNER JOIN utilisateur u ON e.id_utilisateur = u.id_utilisateur
           AND e.id_enseignant = " . $id
        );
    }
    $editResult = $query->fetchAll(PDO::FETCH_ASSOC);
    $editResult = $editResult[0];

    ?>
    <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i></span></div>
    <?php
}