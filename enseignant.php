<?php
require "./Teacher.php";
require "./TeacherManager.php";
require "./User.php";
require "./UserManager.php";
require "./config/connexion.php";

// Identifiant de l'etablissement
$idEtablissement = $_GET["idEtablissement"];

//$bdd = new PDO('mysql:host=localhost; dbname=ufhbedupxhonline','roots', '');
//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$teacherManager = new TeacherManager($bdd);
$userManager = new UserManager($bdd);

date_default_timezone_set('UTC');

// Identifiant de la nouvelle entrée
$identifiant = $teacherManager->getLastInsertedOne() + 1;

// Enregistrement
if (isset($_POST['enregistrer']))
{

        // Dernier identifiant utilisateur de la base de données
        $lastID = (int)$userManager->getLastInsertedUser();

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

        // Enregistrement de l'enseignant
        $teacherManager->add($teacher);

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

// Suppression
if (isset($_POST['supprimer'])){
    if (!empty($_POST["cocher"])) {
        foreach ($_POST["cocher"] as $id) {

            $id = (int) $id;

            // Enseignant sélectionné
            $selectedTeacher = $teacherManager->get($id);

            // Suppression de l'utilisateur
            $userManager->delete($selectedTeacher->id_utilisateur());

            // Suppression de l'enseignant de la table des enseignant
            $teacherManager->delete($id);

        }
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations supprimées avec succès .</span></div>
        <?php
    }
}

// Mise à jour

?>
<div class="card shadow mb-4">
    <!--  Titre  -->
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Enseignant</h3>
    </div>

    <div class="card-body">

        <form action="" method="POST">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="identifiant">Identifiant</label>
                    <input type="text" class="form-control " id="identifiant"  name="identifiant" readonly required="" autofocus="" value="<?= $identifiant ?>">
                </div>

                <div class="form-group col-md-4">
                    <label for="matricule">Matricule</label>
                    <input type="text" class="form-control " id="matricule"   name="matricule" required="" value="">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control " id="nom"  name="nom" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="prenoms">Prénoms</label>
                    <input type="text" class="form-control " id="prenoms"  name="prenoms" required="" autofocus="">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="dateDeNaissance">Date de naissance</label>
                    <input type="date" class="form-control " id="dateDeNaissance"   name="dateDeNaissance" value="">
                </div>
                <div class="form-group col-md-4">
                    <label for="sexe">Sexe</label>
                    <select name="sexe" id="sexe" class="form-control">
                        <option value="1">MASCULIN</option>
                        <option value="2">FEMININ</option>
                    </select>
                </div>

            </div><hr>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="telephone1">Telephone 1</label>
                    <input type="text" class="form-control " id="telephone1"  name="telephone1" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="telephone2">Telephone 2</label>
                    <input type="text" class="form-control " id="telephone2"   name="telephone2" value="">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="email1">Email 1</label>
                    <input type="text" class="form-control " id="email1"  name="email1" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="email2">Email 2</label>
                    <input type="text" class="form-control " id="email2"   name="email2" value="">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control " id="adresse"  name="adresse" required="" autofocus="">
                </div>
            </div><hr>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="etablissementBancaire">Etablissement bancaire</label>
                    <input type="text" class="form-control " id="etablissementBancaire"  name="etablissementBancaire" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="numeroBancaire">Numero de compte bancaire</label>
                    <input type="text" class="form-control " id="numeroBancaire"  name="numeroBancaire" required="" autofocus="">
                </div>
            </div><hr>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="etablissement">Etablissement</label>
                    <select name="etablissement" id="etablissement" class="form-control" onchange="showDepartment(this.value)">
                        <option value=""></option>
                        <?php
                        $query = $bdd->query("SELECT id_etablissement, nom_etablissement FROM etablissement WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_etablissement']?>"> <?= $result['nom_etablissement']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="departement">Departement</label>
                    <p id="department">
                        <select name="departement" class="form-control">
                            <option value="null"></option>
                        </select>
                    </p>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="laboratoire">Laboratoire</label>
                    <select name="laboratoire" id="laboratoire" class="form-control">
                        <option value="null"></option>
                        <?php
                        $query = $bdd->query("SELECT id_laboratoire, libelle_laboratoire FROM laboratoire WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_laboratoire']?>"> <?= $result['libelle_laboratoire']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="specialiteLaboratoire">Spécialité laboratoire</label>
                    <select name="specialiteLaboratoire" id="specialiteLaboratoire" class="form-control">
                        <option value="null"></option>
                        <?php
                        $query = $bdd->query("SELECT id_specialite_labo, libelle_specialite_labo FROM specialite_labo WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_specialite_labo']?>"> <?= $result['libelle_specialite_labo']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="etablissementOrigine">Etablissement d'origine</label>
                    <select name="etablissementOrigine" id="etablissementOrigine" class="form-control">
                        <?php
                        $query = $bdd->query("SELECT id_departement, nom_departement FROM departement WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_departement']?>"> <?= $result['nom_departement']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="permanent">Permanent</label>
                    <select name="permanent" id="permanent" class="form-control">
                        <option value="OUI">OUI</option>
                        <option value="NON">NON</option>
                    </select>
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="pays">Pays</label>
                    <select name="pays" id="pays" class="form-control">
                        <?php
                        $query = $bdd->query("SELECT id_pays, lib_pays FROM pays WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_pays']?>"> <?= $result['lib_pays']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="dateRecrutement">Date de récrutement</label>
                    <input type="date" class="form-control " id="dateRecrutement"  name="dateRecrutement" required="" autofocus="">
                </div>
            </div>

            <hr>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="userGroup">Groupe Utilisateur</label>
                    <select id="userGroup"  name="userGroup" required="" class="form-control">
                        <?php
                        $query = $bdd->query("SELECT id_groupe_utilisateur, libelle_groupe_utilisateur FROM groupe_utilisateur WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_groupe_utilisateur']?>"> <?= $result['libelle_groupe_utilisateur']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="userQuality">Qualité Utilisateur</label>
                    <select id="userQuality"  name="userQuality" required="" class="form-control">
                        <?php
                        $query = $bdd->query("SELECT id_qualite_utilisateur , lib_qualite_utilisateur FROM qualite_utilisateur WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_qualite_utilisateur']?>"> <?= $result['lib_qualite_utilisateur']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="login">Nom d'utilisateur</label>
                    <input type="text" class="form-control " id="login"  name="login" required="" autofocus="">
                </div>
                <div class="form-group col-md-4">
                    <label for="password">Mot de passe</label>
                    <input type="text" class="form-control " id="password"  name="password" required="" autofocus="">
                </div>
            </div>


            <div class="modal fade" id="saveClasseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment enregistrer ces informations ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Cliquez sur le bouton "Enregistrer" ci-dessous si vous voulez valider ces informations.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <!--<a class="btn btn-primary" href="index.php?page=aj_etab&amp;act=save">Enregistrer</a>-->
                            <button type="submit" class="btn btn-primary" name="enregistrer" data-toggle="modal" data-target="#saveClasseModal" ><i class="fas fa-plus-square fa-sm fa-fw mr-2 text-gray-400"></i> Enregister </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateClasseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment modifier ces informations ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Cliquez sur le bouton "Modifier" ci-dessous si vous voulez valider ces informations.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <!--<a class="btn btn-primary" href="index.php?page=aj_etab&amp;act=save">Enregistrer</a>-->
                            <button type="submit" class="btn btn-primary" name="modifier" data-toggle="modal" data-target="#saveClasseModal" ><i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Modifier </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

        <div align="right">

            <?php
            if (!isset($_GET['id']))
            {
                ?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#saveClasseModal">Valider</button>
                <button  class="btn btn-danger" type="reset">Annuler</button>
                <?php
            }
            else if(isset($_GET['id']))
            {?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#updateClasseModal">Editer</button>
                <a  class="btn btn-danger"  href="index.php?page=group_util">Annuler</a>

                <?php

            } ?>
        </div>

    </div>

</div>

<?php

// List de tous les enseignants
$list = $teacherManager->getList();

?>
<form action="" method="POST">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des enseignants</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <!-- Head -->
                    <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                    </tr>
                    </thead>

                    <!-- Footer -->
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                    </tr>
                    </tfoot>

                    <!-- Body -->
                    <tbody>
                    <?php
                    foreach ($list as $enseignant)
                    {
                        ?>
                        <tr>
                            <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $enseignant->id_enseignant(); ?>"></td>
                            <td><?php echo $enseignant->id_enseignant(); ?></td>
                            <td><?php echo $enseignant->nom_enseignant();?></td>
                            <td><?php echo $enseignant->prenom_enseignant();?></td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>

                </table>
            </div>
        </div>

        <div><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#DeleteEvaluationModal" style="margin: 20px;"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Supprimer la sélection</a></div>

        <div class="modal fade" id="DeleteEvaluationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment supprimer la sélection ?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Cliquez sur le bouton "Supprimer" ci-dessous si vous voulez supprimer les éléments sélectionnés.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <!--<a class="btn btn-primary" href="index.php?page=aj_etab&amp;act=save">Enregistrer</a>-->
                        <button type="submit" class="btn btn-danger" name="supprimer"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Supprimer </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>


</form>

<script>
    function showDepartment(establishment) {
        if (establishment === "") {
            const parent = document.getElementById("department");
            parent.innerHTML = "";
            const select = document.createElement("select");
            select.classList.add("form-control");
            const option = document.createElement("option");
            select.add(option);
            parent.insertBefore(select,null);
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("department").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET","./ajax/get_department.php?el="+establishment,true);
            xmlhttp.send();
        }
    }
</script>
