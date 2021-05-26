<?php


class UserManager
{
    private $_db;

    public function __construct($db){
        $this->setDb($db);
    }


    /* Fonction d'ajout d'un nouvelle enseignant */

    public function add(User $utilisateur){

        // Requête
        $query =   "INSERT INTO utilisateur SET 
                    id_utilisateur              =       :id_utilisateur,
                    matricule_utilisateur       =       :matricule_utilisateur,
                    nom_utilisateur             =       :nom_utilisateur,
                    prenom_utilisateur          =       :prenom_utilisateur,
                    tel_utilisateur             =       :tel_utilisateur,
                    adresse_utilisateur         =       :adresse_utilisateur,
                    email_utilisateur           =       :email_utilisateur,
                    login_utilisateur           =       :login_utilisateur,
                    mot_passe_utilisateur       =       :mot_passe_utilisateur,
                    id_type_utilisateur         =       :id_type_utilisateur,
                    id_etablissement            =       :id_etablissement,
                    id_departement              =       :id_departement,
                    id_groupe_utilisateur       =       :id_groupe_utilisateur,
                    id_qualite_utilisateur      =       :id_qualite_utilisateur,
                    parametres_envoye           =       :parametres_envoye,
                    date_envoie                 =       :date_envoie,
                    heure_envoie                =       :heure_envoie,
                    connexion_reussie           =       :connexion_reussie,
                    date_derniere_connexion     =       :date_derniere_connexion,
                    heure_derniere_connexion    =       :heure_derniere_connexion";

        // Préparation de la requête
        $query = $this->_db->prepare($query);

        // Assignation des valeurs à la requête
        $query->bindValue(':id_utilisateur', $utilisateur->id_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':matricule_utilisateur', $utilisateur->matricule_utilisateur());
        $query->bindValue(':nom_utilisateur', $utilisateur->nom_utilisateur());
        $query->bindValue(':prenom_utilisateur', $utilisateur->prenom_utilisateur());
        $query->bindValue(':tel_utilisateur', $utilisateur->tel_utilisateur());
        $query->bindValue(':adresse_utilisateur', $utilisateur->adresse_utilisateur());
        $query->bindValue(':email_utilisateur', $utilisateur->email_utilisateur());
        $query->bindValue(':login_utilisateur', $utilisateur->login_utilisateur());
        $query->bindValue(':mot_passe_utilisateur', $utilisateur->mot_passe_utilisateur());
        $query->bindValue(':id_type_utilisateur', $utilisateur->id_type_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':id_etablissement', $utilisateur->id_etablissement(), PDO::PARAM_INT);
        $query->bindValue(':id_departement', $utilisateur->id_departement(), PDO::PARAM_INT);
        $query->bindValue(':id_groupe_utilisateur', $utilisateur->id_groupe_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':id_qualite_utilisateur', $utilisateur->id_qualite_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':parametres_envoye', $utilisateur->parametres_envoye());
        $query->bindValue(':date_envoie', $utilisateur->date_envoie());
        $query->bindValue(':heure_envoie', $utilisateur->heure_envoie());
        $query->bindValue(':connexion_reussie', $utilisateur->connexion_reussie());
        $query->bindValue(':date_derniere_connexion', $utilisateur->date_derniere_connexion());
        $query->bindValue(':heure_derniere_connexion', $utilisateur->heure_derniere_connexion());

        // Execution de la requête
        $query->execute();
    }

    private function bindValueForUser($query, $utilisateur){

        $query->bindValue(':id_utilisateur', $utilisateur->id_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':matricule_utilisateur', $utilisateur->matricule_utilisateur());
        $query->bindValue(':nom_utilisateur', $utilisateur->nom_utilisateur());
        $query->bindValue(':prenom_utilisateur', $utilisateur->prenom_utilisateur());
        $query->bindValue(':tel_utilisateur', $utilisateur->tel_utilisateur());
        $query->bindValue(':adresse_utilisateur', $utilisateur->adresse_utilisateur());
        $query->bindValue(':email_utilisateur', $utilisateur->email_utilisateur());
        $query->bindValue(':login_utilisateur', $utilisateur->login_utilisateur());
        $query->bindValue(':mot_passe_utilisateur', $utilisateur->mot_passe_utilisateur());
        $query->bindValue(':id_type_utilisateur', $utilisateur->id_type_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':id_etablissement', $utilisateur->id_etablissement(), PDO::PARAM_INT);
        $query->bindValue(':id_departement', $utilisateur->id_departement(), PDO::PARAM_INT);
        $query->bindValue(':id_groupe_utilisateur', $utilisateur->id_groupe_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':id_qualite_utilisateur', $utilisateur->id_qualite_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':parametres_envoye', $utilisateur->parametres_envoye());
        $query->bindValue(':date_envoie', $utilisateur->date_envoie());
        $query->bindValue(':heure_envoie', $utilisateur->heure_envoie());
        $query->bindValue(':connexion_reussie', $utilisateur->connexion_reussie());
        $query->bindValue(':date_derniere_connexion', $utilisateur->date_derniere_connexion());
        $query->bindValue(':heure_derniere_connexion', $utilisateur->heure_derniere_connexion());

    }

    public function getLastInsertedUser(){
        $statement = $this->_db->query("SELECT MAX(id_utilisateur) FROM utilisateur");
        return $statement->fetchColumn();
    }

    /* Fonction de suppression d'un enseignant */

    public function delete($id){
        // Exécution d'une requête de type DELETE
        $id = (int) $id;
        $this->_db->query("DELETE FROM utilisateur WHERE id_utilisateur = " .$id);
    }


    /* Fonction de Mise à jour */

    public function update(User $user){

        $query =   "UPDATE utilisateur SET 
                    id_utilisateur              =       :id_utilisateur,
                    matricule_utilisateur       =       :matricule_utilisateur,
                    nom_utilisateur             =       :nom_utilisateur,
                    prenom_utilisateur          =       :prenom_utilisateur,
                    tel_utilisateur             =       :tel_utilisateur,
                    adresse_utilisateur         =       :adresse_utilisateur,
                    email_utilisateur           =       :email_utilisateur,
                    login_utilisateur           =       :login_utilisateur,
                    mot_passe_utilisateur       =       :mot_passe_utilisateur,
                    id_type_utilisateur         =       :id_type_utilisateur,
                    id_etablissement            =       :id_etablissement,
                    id_departement              =       :id_departement,
                    id_groupe_utilisateur       =       :id_groupe_utilisateur,
                    id_qualite_utilisateur      =       :id_qualite_utilisateur,
                    parametres_envoye           =       :parametres_envoye,
                    date_envoie                 =       :date_envoie,
                    heure_envoie                =       :heure_envoie,
                    connexion_reussie           =       :connexion_reussie,
                    date_derniere_connexion     =       :date_derniere_connexion,
                    heure_derniere_connexion    =       :heure_derniere_connexion 
                    WHERE id_utilisateur        =       :id_utilisateur";
        // Preparation de la requête de mise à  jour
        $query = $this->_db->prepare($query);

        $this->bindValueForUser($query, $user);

        $query->execute();
    }

    /* Obtenir une liste d'utilisateur */

    public function getList(){
        $users = array();

        $query = $this->_db->query("SELECT * FROM utilisateur WHERE 1");
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            $users[] = new EnseignantClass($data);
        }
        return $users;
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}