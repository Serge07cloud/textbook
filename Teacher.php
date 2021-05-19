<?php


class Teacher
{
    private $_id_enseignant;
    private $_matricule_enseignant;
    private $_nom_enseignant;
    private $_prenom_enseignant;
    private $_date_nais_enseignant;
    private $_sexe_enseignant;
    private $_tel_enseignant;
    private $_tel2_enseignant;
    private $_email_enseignant;
    private $_email2_enseignant;
    private $_adresse_enseignant;
    private $_num_compte_bancaire;
    private $_etablissement_bancaire;
    private $_permanent;
    private $_date_recrutement_enseignant;
    private $_id_etablissement;
    private $_id_departement;
    private $_etablissement_origine;
    private $_id_laboratoire;
    private $_id_specialite_labo;
    private $_id_pays;
    private $_id_utilisateur;
    private $_id_type_personnel;
    private $_id_groupe_sco;

    /* Définition des Accesseurs */

    public function id_enseignant()         {   return $this->_id_enseignant;           }

    public function matricule_enseignant()  {   return $this->_matricule_enseignant;    }

    public function nom_enseignant()        {   return $this->_nom_enseignant;          }

    public function prenom_enseignant()     {   return $this->_prenom_enseignant;       }

    public function date_nais_enseignant()  {   return $this->_date_nais_enseignant;    }

    public function sexe_enseignant()       {   return $this->_sexe_enseignant;         }

    public function tel_enseignant()        {   return $this->_tel_enseignant;          }

    public function tel2_enseignant()       {   return $this->_tel2_enseignant;         }

    public function email_enseignant()      {   return $this->_email_enseignant;        }

    public function email2_enseignant()     {   return $this->_email2_enseignant;       }

    public function adresse_enseignant()    {   return $this->_adresse_enseignant;      }

    public function num_compte_bancaire()   {   return $this->_num_compte_bancaire;     }

    public function etablissement_bancaire(){   return $this->_etablissement_bancaire;  }

    public function permanent()             {   return $this->_permanent;      }

    public function date_recrutement_enseignant()  {   return $this->_date_recrutement_enseignant; }

    public function id_etablissement()      {   return $this->_id_etablissement;        }

    public function id_departement()        {   return $this->_id_departement;          }

    public function etablissement_origine(){    return $this->_etablissement_origine;   }

    public function id_laboratoire()        {   return $this->_id_laboratoire;          }

    public function id_specialite_labo()    {   return $this->_id_specialite_labo;      }

    public function id_pays()               {   return $this->_id_pays;                 }

    public function id_utilisateur()        {   return $this->_id_utilisateur;          }

    public function id_type_personnel()     {   return $this->_id_type_personnel;       }

    public function id_groupe_sco()     {   return $this->_id_groupe_sco; }



    /* Définition des mutateurs */

    /**
     * @param mixed $id_enseignant
     */
    public function setIdEnseignant($id_enseignant)
    {
        $this->_id_enseignant = $id_enseignant;
    }

    /**
     * @param mixed $matricule_enseignant
     */
    public function setMatriculeEnseignant($matricule_enseignant)
    {
        $this->_matricule_enseignant = $matricule_enseignant;
    }

    /**
     * @param mixed $nom_enseignant
     */
    public function setNomEnseignant($nom_enseignant)
    {
        $this->_nom_enseignant = $nom_enseignant;
    }

    /**
     * @param mixed $prenom_enseignant
     */
    public function setPrenomEnseignant($prenom_enseignant)
    {
        $this->_prenom_enseignant = $prenom_enseignant;
    }

    /**
     * @param mixed $date_nais_enseignant
     */
    public function setDateNaisEnseignant($date_nais_enseignant)
    {
        $this->_date_nais_enseignant = $date_nais_enseignant;
    }

    /**
     * @param mixed $sexe_enseignant
     */
    public function setSexeEnseignant($sexe_enseignant)
    {
        $this->_sexe_enseignant = $sexe_enseignant;
    }

    /**
     * @param mixed $tel_enseignant
     */
    public function setTelEnseignant($tel_enseignant)
    {
        $this->_tel_enseignant = $tel_enseignant;
    }

    /**
     * @param mixed $tel2_enseignant
     */
    public function setTel2Enseignant($tel2_enseignant)
    {
        $this->_tel2_enseignant = $tel2_enseignant;
    }

    /**
     * @param mixed $email_enseignant
     */
    public function setEmailEnseignant($email_enseignant)
    {
        $this->_email_enseignant = $email_enseignant;
    }

    /**
     * @param mixed $email2_enseignant
     */
    public function setEmail2Enseignant($email2_enseignant)
    {
        $this->_email2_enseignant = $email2_enseignant;
    }

    /**
     * @param mixed $adresse_enseignant
     */
    public function setAdresseEnseignant($adresse_enseignant)
    {
        $this->_adresse_enseignant = $adresse_enseignant;
    }

    /**
     * @param mixed $num_compte_bancaire
     */
    public function setNumCompteBancaire($num_compte_bancaire)
    {
        $this->_num_compte_bancaire = $num_compte_bancaire;
    }

    /**
     * @param mixed $etablissement_bancaire
     */
    public function setEtablissementBancaire($etablissement_bancaire)
    {
        $this->_etablissement_bancaire = $etablissement_bancaire;
    }

    /**
     * @param mixed $permanent
     */
    public function setPermanent($permanent)
    {
        $this->_permanent = $permanent;
    }

    /**
     * @param mixed $date_recrutement_enseignant
     */
    public function setDateRecrutementEnseignant($date_recrutement_enseignant)
    {
        $this->_date_recrutement_enseignant = $date_recrutement_enseignant;
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
     * @param mixed $etablissement_origine
     */
    public function setEtablissementOrigine($etablissement_origine)
    {
        $this->_etablissement_origine = $etablissement_origine;
    }

    /**
     * @param mixed $id_laboratoire
     */
    public function setIdLaboratoire($id_laboratoire)
    {
        $this->_id_laboratoire = $id_laboratoire;
    }

    /**
     * @param mixed $id_specialite_labo
     */
    public function setIdSpecialiteLabo($id_specialite_labo)
    {
        $this->_id_specialite_labo = $id_specialite_labo;
    }

    /**
     * @param mixed $id_pays
     */
    public function setIdPays($id_pays)
    {
        $this->_id_pays = $id_pays;
    }

    /**
     * @param mixed $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->_id_utilisateur = $id_utilisateur;
    }

    /**
     * @param int $id_type_personnel
     */
    public function setIdTypePersonnel($id_type_personnel)
    {
        $this->_id_type_personnel = $id_type_personnel;
    }

    /**
     * @param mixed $id_groupe_sco
     */
    public function setIdGroupeSco($id_groupe_sco)
    {
        $this->_id_groupe_sco = $id_groupe_sco;
    }



    /* Hydratation des données */

    public function hydrate(array $donnees){

        if (isset($donnees['id_enseignant'])){
            $this->setIdEnseignant($donnees['id_enseignant']);
        }

        if (isset($donnees['matricule_enseignant'])){
            $this->setMatriculeEnseignant($donnees['matricule_enseignant']);
        }
        //  Non de l'enseignant
        if (isset($donnees['nom_enseignant'])){
            $this->setNomEnseignant($donnees['nom_enseignant']);
        }
        // Prénoms
        if (isset($donnees['prenom_enseignant'])){
            $this->setPrenomEnseignant($donnees['prenom_enseignant']);
        }
        // Date de Naissance
        if (isset($donnees['date_nais_enseignant'])){
            $this->setDateNaisEnseignant($donnees['date_nais_enseignant']);
        }
        // Sexe
        if (isset($donnees['sexe_enseignant'])){
            $this->setSexeEnseignant($donnees['sexe_enseignant']);
        }
        // Télephone 1
        if (isset($donnees['tel_enseignant'])){
            $this->setTelEnseignant($donnees['tel_enseignant']); // Pause
        }
        // Télephone 2
        if (isset($donnees['tel2_enseignant'])){
            $this->setTel2Enseignant($donnees['tel2_enseignant']);
        }
        // Email 1
        if (isset($donnees['email_enseignant'])){
            $this->setEmailEnseignant($donnees['email_enseignant']);
        }
        // Email 2
        if (isset($donnees['email2_enseignant'])){
            $this->setEmail2Enseignant($donnees['email2_enseignant']);
        }
        // Adresse
        if (isset($donnees['adresse_enseignant'])){
            $this->setAdresseEnseignant($donnees['adresse_enseignant']);
        }
        // Numero compte bancaire
        if (isset($donnees['num_compte_bancaire'])){
            $this->setNumCompteBancaire($donnees['num_compte_bancaire']);
        }
        // Etablissement bancaire
        if (isset($donnees['etablissement_bancaire'])){
            $this->setEtablissementBancaire($donnees['etablissement_bancaire']);
        }
        // Permanent
        if (isset($donnees['permanent'])){
            $this->setPermanent($donnees['permanent']);
        }
        // Date recrutement
        if (isset($donnees['date_recrutement_enseignant'])){
            $this->setDateRecrutementEnseignant($donnees['date_recrutement_enseignant']);
        }
        // Identifiant etablissement
        if (isset($donnees['id_etablissement'])){
            $this->setIdEtablissement($donnees['id_etablissement']);
        }
        // Identifiant département
        if (isset($donnees['id_departement'])){
            $this->setIdDepartement($donnees['id_departement']);
        }
        // Etablissement d'origine
        if (isset($donnees['etablissement_origine'])){
            $this->setEtablissementOrigine($donnees['etablissement_origine']);
        }
        // Identifiant lboratoire
        if (isset($donnees['id_laboratoire'])){
            $this->setIdLaboratoire($donnees['id_laboratoire']);
        }
        // Identifiant spécialité laboratoire
        if (isset($donnees['id_specialite_labo'])){
            $this->setIdSpecialiteLabo($donnees['id_specialite_labo']);
        }
        // Identifiant Pays
        if (isset($donnees['id_pays'])){
            $this->setIdPays($donnees['id_pays']);
        }
        // Identifiant Utilisateur
        if (isset($donnees['id_utilisateur'])){
            $this->setIdUtilisateur($donnees['id_utilisateur']);
        }
        // Identifiant type personnel
        if (isset($donnees['id_type_personnel'])){
            $this->setIdTypePersonnel($donnees['id_type_personnel']);
        }

        // Identifiant groupe scolarité
        if (isset($donnees['id_groupe_sco'])){
            $this->setIdGroupeSco($donnees['id_groupe_sco']);
        }

    }


    /* Notre constructeur */
    public function __construct(array $donnees){
        $this->hydrate($donnees);
    }

}