<?php


class TeacherManager
{
    // Instance de PDO
    private $_db;

    public function __construct($db){
        $this->setDb($db);
    }

    public function getLastInsertedOne(){
        $statement = $this->_db->query("SELECT MAX(id_enseignant) FROM enseignant");
        return $statement->fetchColumn();
    }

    /* Fonction d'ajout d'un nouvelle enseignant */
    public function add(Teacher $teacher){
        // Requête
        $query =   "INSERT INTO enseignant SET 
                    id_enseignant                   =       :id_enseignant,
                    matricule_enseignant            =       :matricule_enseignant,
                    nom_enseignant                  =       :nom_enseignant,
                    prenom_enseignant               =       :prenom_enseignant,
                    date_nais_enseignant            =       :date_nais_enseignant,
                    sexe_enseignant                 =       :sexe_enseignant,
                    tel_enseignant                  =       :tel_enseignant,
                    tel2_enseignant                 =       :tel2_enseignant,
                    email_enseignant                =       :email_enseignant,
                    email2_enseignant               =       :email2_enseignant,
                    adresse_enseignant              =       :adresse_enseignant,
                    num_compte_bancaire             =       :num_compte_bancaire,
                    etablissement_bancaire          =       :etablissement_bancaire,
                    permanent                       =       :permanent,
                    date_recrutement_enseignant     =       :date_recrutement_enseignant,
                    id_etablissement                =       :id_etablissement,
                    id_departement                  =       :id_departement,
                    etablissement_origine           =       :etablissement_origine,
                    id_laboratoire                  =       :id_laboratoire,
                    id_specialite_labo              =       :id_specialite_labo,
                    id_pays                         =       :id_pays,
                    id_utilisateur                  =       :id_utilisateur,
                    id_type_personnel               =       :id_type_personnel,
                    id_groupe_sco                   =       :id_groupe_sco";


        // Préparation de la requête
        $query = $this->_db->prepare($query);

        // Assignation des valeurs à la requête
        $query->bindValue(':id_enseignant', $teacher->id_enseignant(), PDO::PARAM_INT);
        $query->bindValue(':matricule_enseignant', $teacher->matricule_enseignant());
        $query->bindValue(':nom_enseignant', $teacher->nom_enseignant());
        $query->bindValue(':prenom_enseignant', $teacher->prenom_enseignant());
        $query->bindValue(':date_nais_enseignant', $teacher->date_nais_enseignant());
        $query->bindValue(':sexe_enseignant', $teacher->sexe_enseignant());
        $query->bindValue(':tel_enseignant', $teacher->tel_enseignant());
        $query->bindValue(':tel2_enseignant', $teacher->tel2_enseignant());
        $query->bindValue(':email_enseignant', $teacher->email_enseignant());
        $query->bindValue(':email2_enseignant', $teacher->email2_enseignant());
        $query->bindValue(':adresse_enseignant', $teacher->adresse_enseignant());
        $query->bindValue(':num_compte_bancaire', $teacher->num_compte_bancaire());
        $query->bindValue(':etablissement_bancaire', $teacher->etablissement_bancaire());
        $query->bindValue(':permanent', $teacher->permanent());
        $query->bindValue(':date_recrutement_enseignant', $teacher->date_recrutement_enseignant());
        $query->bindValue(':id_etablissement', $teacher->id_etablissement(), PDO::PARAM_INT);
        $query->bindValue(':id_departement', $teacher->id_departement(), PDO::PARAM_INT);
        $query->bindValue(':etablissement_origine', $teacher->etablissement_origine(), PDO::PARAM_INT);
        $query->bindValue(':id_laboratoire', $teacher->id_laboratoire(), PDO::PARAM_INT);
        $query->bindValue(':id_specialite_labo', $teacher->id_specialite_labo(), PDO::PARAM_INT);
        $query->bindValue(':id_pays', $teacher->id_pays(), PDO::PARAM_INT);
        $query->bindValue(':id_utilisateur', $teacher->id_utilisateur(), PDO::PARAM_INT);
        $query->bindValue(':id_type_personnel', $teacher->id_type_personnel(), PDO::PARAM_INT);
        $query->bindValue(':id_groupe_sco', $teacher->id_groupe_sco(), PDO::PARAM_INT);

        // Execution de la requête
        $query->execute();
    }

    /* Fonction de suppression d'un enseignant */

    public function delete($id){
        $id = (int) $id;
        $this->_db->query("DELETE FROM enseignant WHERE id_enseignant = " .$id);
    }

    /* Fonction de Mise à jour */

    public function update(Teacher $teacher){
        // Preparation de la requête de mise à  jour
        // Assignation des valeurs à la requête
        // Exécution de la requête
    }

    /* Obtenir une liste d'enseignant */
    public function getList(){
        $teachers = array();

        $query = $this->_db->query("SELECT * FROM enseignant WHERE 1");
        while ($data = $query->fetch(PDO::FETCH_ASSOC)){
            $teachers[] = new Teacher($data);
        }
        return $teachers;
    }

    /* Obtenir un enseignant */
    public function get($id){
        $id = (int) $id;

        $query = $this->_db->query("SELECT * FROM enseignant WHERE id_enseignant = ". $id);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data == false){
            $teacher = new Teacher(array());
            $teacher->setIdEnseignant(0);
            return $teacher;
        }else{
            return new Teacher($data);
        }

    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}