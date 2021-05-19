<?php


class User
{
    private $_id_utilisateur;
    private $_matricule_utilisateur;
    private $_nom_utilisateur;
    private $_prenom_utilisateur;
    private $_tel_utilisateur;
    private $_adresse_utilisateur;
    private $_email_utilisateur;
    private $_login_utilisateur;
    private $_mot_passe_utilisateur;
    private $_id_type_utilisateur;
    private $_id_etablissement;
    private $_id_departement;
    private $_id_groupe_utilisateur;
    private $_id_qualite_utilisateur;
    private $_parametres_envoye;
    private $_date_envoie;
    private $_heure_envoie;
    private $_connexion_reussie;
    private $_date_derniere_connexion;
    private $_heure_derniere_connexion;

    // Définition des Accesseurs

    public function id_utilisateur()       {    return $this->_id_utilisateur;  }

    public function matricule_utilisateur() {   return $this->_matricule_utilisateur;   }

    public function nom_utilisateur()   {   return $this->_nom_utilisateur; }

    public function prenom_utilisateur() { return $this->_prenom_utilisateur;   }

    public function tel_utilisateur() { return $this->_tel_utilisateur; }

    public function adresse_utilisateur() { return $this->_adresse_utilisateur; }

    public function email_utilisateur() { return $this->_email_utilisateur;}

    public function login_utilisateur() { return $this->_login_utilisateur;}

    public function mot_passe_utilisateur() { return $this->_mot_passe_utilisateur;}

    public function id_type_utilisateur() { return $this->_id_type_utilisateur;}

    public function id_etablissement(){ return $this->_id_etablissement;}

    public function id_departement(){ return $this->_id_departement;}

    public function id_groupe_utilisateur() { return $this->_id_groupe_utilisateur;}

    public function id_qualite_utilisateur() { return $this->_id_qualite_utilisateur;}

    public function parametres_envoye() { return $this->_parametres_envoye;}

    public function date_envoie() {return $this->_date_envoie;}

    public function heure_envoie() {return $this->_heure_envoie;}

    public function connexion_reussie() { return $this->_connexion_reussie;}

    public function date_derniere_connexion() {return $this->_date_derniere_connexion;}

    public function heure_derniere_connexion() {    return $this->_heure_derniere_connexion;}


    /* Définition des mutateurs */

    /**
     * @param mixed $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->_id_utilisateur = $id_utilisateur;
    }

    /**
     * @param mixed $matricule_utilisateur
     */
    public function setMatriculeUtilisateur($matricule_utilisateur)
    {
        $this->_matricule_utilisateur = $matricule_utilisateur;
    }

    /**
     * @param mixed $nom_utilisateur
     */
    public function setNomUtilisateur($nom_utilisateur)
    {
        $this->_nom_utilisateur = $nom_utilisateur;
    }

    /**
     * @param mixed $prenom_utilisateur
     */
    public function setPrenomUtilisateur($prenom_utilisateur)
    {
        $this->_prenom_utilisateur = $prenom_utilisateur;
    }

    /**
     * @param mixed $tel_utilisateur
     */
    public function setTelUtilisateur($tel_utilisateur)
    {
        $this->_tel_utilisateur = $tel_utilisateur;
    }

    /**
     * @param mixed $adresse_utilisateur
     */
    public function setAdresseUtilisateur($adresse_utilisateur)
    {
        $this->_adresse_utilisateur = $adresse_utilisateur;
    }

    /**
     * @param mixed $email_utilisateur
     */
    public function setEmailUtilisateur($email_utilisateur)
    {
        $this->_email_utilisateur = $email_utilisateur;
    }

    /**
     * @param mixed $login_utilisateur
     */
    public function setLoginUtilisateur($login_utilisateur)
    {
        $this->_login_utilisateur = $login_utilisateur;
    }

    /**
     * @param mixed $mot_passe_utilisateur
     */
    public function setMotPasseUtilisateur($mot_passe_utilisateur)
    {
        $this->_mot_passe_utilisateur = $mot_passe_utilisateur;
    }

    /**
     * @param mixed $id_type_utilisateur
     */
    public function setIdTypeUtilisateur($id_type_utilisateur)
    {
        $this->_id_type_utilisateur = $id_type_utilisateur;
    }

    /**
     * @param mixed $id_etablissement
     */
    public function setIdEtablissement($id_etablissement)
    {
        $this->_id_etablissement = $id_etablissement;
    }

    /**
     * @param mixed $id_departement
     */
    public function setIdDepartement($id_departement)
    {
        $this->_id_departement = $id_departement;
    }

    /**
     * @param mixed $id_groupe_utilisateur
     */
    public function setIdGroupeUtilisateur($id_groupe_utilisateur)
    {
        $this->_id_groupe_utilisateur = $id_groupe_utilisateur;
    }

    /**
     * @param mixed $id_qualite_utilisateur
     */
    public function setIdQualiteUtilisateur($id_qualite_utilisateur)
    {
        $this->_id_qualite_utilisateur = $id_qualite_utilisateur;
    }

    /**
     * @param mixed $parametres_envoye
     */
    public function setParametresEnvoye($parametres_envoye)
    {
        $this->_parametres_envoye = $parametres_envoye;
    }

    /**
     * @param mixed $date_envoie
     */
    public function setDateEnvoie($date_envoie)
    {
        $this->_date_envoie = $date_envoie;
    }

    /**
     * @param mixed $heure_envoie
     */
    public function setHeureEnvoie($heure_envoie)
    {
        $this->_heure_envoie = $heure_envoie;
    }

    /**
     * @param mixed $connexion_reussie
     */
    public function setConnexionReussie($connexion_reussie)
    {
        $this->_connexion_reussie = $connexion_reussie;
    }

    /**
     * @param mixed $date_derniere_connexion
     */
    public function setDateDerniereConnexion($date_derniere_connexion)
    {
        $this->_date_derniere_connexion = $date_derniere_connexion;
    }

    /**
     * @param mixed $heure_derniere_connexion
     */
    public function setHeureDerniereConnexion($heure_derniere_connexion)
    {
        $this->_heure_derniere_connexion = $heure_derniere_connexion;
    }


    // Hydratation des données
    public function hydrate(array $data){

        // Identifiant de l'utilisateur
        if (isset($data['id_utilisateur'])){
            $this->setIdUtilisateur($data['id_utilisateur']);
        }
        // Matricule
        if (isset($data['matricule_utilisateur'])){
            $this->setMatriculeUtilisateur($data['matricule_utilisateur']);
        }
        // Nom
        if (isset($data['nom_utilisateur'])){
            $this->setNomUtilisateur($data['nom_utilisateur']);
        }
        // Prénoms
        if (isset($data['prenom_utilisateur'])){
            $this->setPrenomUtilisateur($data['prenom_utilisateur']);
        }
        // Téléphone
        if (isset($data['tel_utilisateur'])){
            $this->setTelUtilisateur($data['tel_utilisateur']);
        }
        // Adresse
        if (isset($data['adresse_utilisateur'])){
            $this->setAdresseUtilisateur($data['adresse_utilisateur']);
        }
        // Email
        if (isset($data['email_utilisateur'])){
            $this->setEmailUtilisateur($data['email_utilisateur']);
        }
        // Login
        if (isset($data['login_utilisateur'])){
            $this->setLoginUtilisateur($data['login_utilisateur']);
        }
        // Mot de passe
        if (isset($data['mot_passe_utilisateur'])){
            $this->setMotPasseUtilisateur($data['mot_passe_utilisateur']);
        }
        // Identifiant type utilisateur
        if (isset($data['id_type_utilisateur'])){
            $this->setIdTypeUtilisateur($data['id_type_utilisateur']);
        }
        // Identifiant etablissement
        if (isset($data['id_etablissement'])){
            $this->setIdEtablissement($data['id_etablissement']);
        }
        // Identifiant departement
        if (isset($data['id_departement'])){
            $this->setIdDepartement($data['id_departement']);
        }
        // Identifiant groupe utilisateur
        if (isset($data['id_groupe_utilisateur'])){
            $this->setIdGroupeUtilisateur($data['id_groupe_utilisateur']);
        }
        // Identifiant qualité utilisateur
        if (isset($data['id_qualite_utilisateur'])){
            $this->setIdQualiteUtilisateur($data['id_qualite_utilisateur']);
        }
        // Paramètres envoyés
        if (isset($data['parametres_envoye'])){
            $this->setParametresEnvoye($data['parametres_envoye']);
        }
        // Date envoie
        if (isset($data['date_envoie'])){
            $this->setDateEnvoie($data['date_envoie']);
        }
        // Heure envoie
        if (isset($data['heure_envoie'])){
            $this->setHeureEnvoie($data['heure_envoie']);
        }
        // Connexion réussie
        if (isset($data['connexion_reussie'])){
            $this->setConnexionReussie($data['connexion_reussie']);
        }
        // Date dernière connexion
        if (isset($data['date_derniere_connexion'])){
            $this->setDateDerniereConnexion($data['date_derniere_connexion']);
        }
        // Heure dernière connexion
        if (isset($data['heure_derniere_connexion'])){
            $this->setHeureDerniereConnexion($data['heure_derniere_connexion']);
        }
    }

    // Constructeur
    public function __construct(array $data){
        $this->hydrate($data);
    }
}