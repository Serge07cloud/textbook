<?php

if (isset($_POST['enregistrer']))
{

    // Dernier identifiant utilisateur de la base de données
    if (isset($userManager)) {
        $lastID = (int)$userManager->getLastInsertedUser();
    }

    // Nouvel utilisateur
    $user = new User(array(
        'id_utilisateur'              =>       $lastID + 1,
        'matricule_utilisateur'       =>       $_POST['matricule'],
        'nom_utilisateur'             =>       $_POST['nom'],
        'prenom_utilisateur'          =>       $_POST['prenoms'],
        'tel_utilisateur'             =>       $_POST['telephone1'],
        'adresse_utilisateur'         =>       $_POST['adresse'],
        'email_utilisateur'           =>       $_POST['email1'],
        'login_utilisateur'           =>       $_POST['login'],
        'mot_passe_utilisateur'       =>       $_POST['password'],
        'id_type_utilisateur'         =>       4, // Formateur
        'id_etablissement'            =>       (int)$_POST['etablissement'],
        'id_departement'              =>       (int)$_POST['departement'],
        'id_groupe_utilisateur'       =>       (int)$_POST['userGroup'],
        'id_qualite_utilisateur'      =>       (int)$_POST['userQuality'],
        'parametres_envoye'           =>       "OUI",
        'date_envoie'                 =>       date("Y-m-d"),
        'heure_envoie'                =>       date("H:i:s"),
        'connexion_reussie'           =>       "OUI",
        'date_derniere_connexion'     =>       date("Y-m-d"),
        'heure_derniere_connexion'    =>       date("H:i:s")
    ));

    // Nouvel enseignant
    if (isset($identifiant)) {
        $teacher = new Teacher(array(
            'id_enseignant'                     => $identifiant,
            'matricule_enseignant'              => $_POST['matricule'],
            'nom_enseignant'                    => $_POST['nom'],
            'prenom_enseignant'                 => $_POST['prenoms'],
            'date_nais_enseignant'              => $_POST['dateDeNaissance'],
            'sexe_enseignant'                   => (int)$_POST['sexe'],
            'tel_enseignant'                    => $_POST['telephone1'],
            'tel2_enseignant'                   => $_POST['telephone2'],
            'email_enseignant'                  => $_POST['email1'],
            'email2_enseignant'                 => $_POST['email2'],
            'adresse_enseignant'                => $_POST['adresse'],
            'num_compte_bancaire'               => $_POST['numeroBancaire'],
            'etablissement_bancaire'            => $_POST['etablissementBancaire'],
            'permanent'                         => $_POST['permanent'],
            'date_recrutement_enseignant'       => $_POST['dateRecrutement'],
            'id_etablissement'                  => (int)$_POST['etablissement'],
            'id_departement'                    => (int)$_POST['departement'],
            'etablissement_origine'             => (int)$_POST['etablissementOrigine'],
            'id_laboratoire'                    => (int)$_POST['laboratoire'],
            'id_specialite_labo'                => (int)$_POST['specialiteLaboratoire'],
            'id_pays'                           => (int)$_POST['pays'],
            'id_utilisateur'                    => $lastID + 1,
            'id_type_personnel'                 => 1,
            'id_groupe_sco'                     => null
        ));
    }

    // Enregistrement de l'enseignant
    if (isset($teacherManager)) {
        $teacherManager->add($teacher);
    }

    // Enregistrement de l'utilisateur
    $userManager->add($user);
    ?>
    <div>
            <span id="" class="form-text text-success font-weight-bold">
                <i class="fas fa-check-square fa-md fa-fw mr-2"></i>Informations enrégistrées avec succès.
            </span>
    </div>
    <?php
    // Identifiant de la nouvelle entrée
    $identifiant = $teacherManager->getLastInsertedOne() + 1;
}
