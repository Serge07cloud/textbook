<?php
require "./Teacher.php";
require "./TeacherManager.php";
require "./User.php";
require "./UserManager.php";
require "./config/connexion.php";

// Identifiant de l'etablissement
$idEtablissement = $_GET["idEtablissement"];

$teacherManager = new TeacherManager($bdd);
$userManager = new UserManager($bdd);

date_default_timezone_set('UTC');

// Identifiant de la nouvelle entrée
$identifiant = $teacherManager->getLastInsertedOne() + 1;

// Enregistrement
include "teacher/process/saveCode.php";

// Suppression
include "teacher/process/deleteCode.php";

// Edit
include "teacher/process/editCode.php";

// Update
include "teacher/process/updateCode.php";

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
                    <input type="text" class="form-control " id="identifiant"  name="identifiant" readonly required="" autofocus="" value="<?php if (isset($editResult)) echo $editResult["id_enseignant"]; else echo $identifiant ?>">
                </div>

                <div class="form-group col-md-4">
                    <label for="matricule">Matricule</label>
                    <input type="text" class="form-control " id="matricule"   name="matricule" required="" value="<?php if (isset($editResult)) echo $editResult['matricule_enseignant']?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nom">Nom</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['nom_enseignant']?>" class="form-control" id="nom"  name="nom" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="prenoms">Prénoms</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['prenom_enseignant']?>" class="form-control " id="prenoms"  name="prenoms" required="" autofocus="">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="dateDeNaissance">Date de naissance</label>
                    <input type="date" value="<?php if (isset($editResult)) echo $editResult['date_nais_enseignant']?>" class="form-control " id="dateDeNaissance"   name="dateDeNaissance">
                </div>

                <div class="form-group col-md-4">
                    <label for="sexe">Sexe</label>
                    <select name="sexe" id="sexe" class="form-control">
                        <option value="1" <?php if (isset($editResult) && $editResult['sexe_enseignant'] == 1) echo "selected"?>>MASCULIN</option>
                        <option value="2" <?php if (isset($editResult) && $editResult['sexe_enseignant'] == 2) echo "selected"?> >FEMININ</option>
                    </select>
                </div>

            </div><hr>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="telephone1">Telephone 1</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['tel_enseignant']?>" class="form-control " id="telephone1"  name="telephone1" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="telephone2">Telephone 2</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['tel2_enseignant']?>" class="form-control " id="telephone2"   name="telephone2" value="">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="email1">Email 1</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['email_enseignant']?>" class="form-control " id="email1"  name="email1" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="email2">Email 2</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['email2_enseignant']?>" class="form-control " id="email2"   name="email2" value="">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="adresse">Adresse</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['adresse_enseignant']?>" class="form-control " id="adresse"  name="adresse" required="" autofocus="">
                </div>
            </div><hr>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="etablissementBancaire">Etablissement bancaire</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['etablissement_bancaire']?>" class="form-control " id="etablissementBancaire"  name="etablissementBancaire" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="numeroBancaire">Numero de compte bancaire</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['num_compte_bancaire']?>" class="form-control " id="numeroBancaire"  name="numeroBancaire" required="" autofocus="">
                </div>
            </div><hr>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="etablissement">Etablissement</label>
                    <select name="etablissement" id="etablissement" class="form-control" onchange="showDepartment(this.value)">
                        <option value="">Choisir...</option>
                        <?php
                        $query = $bdd->query("SELECT id_etablissement, nom_etablissement FROM etablissement WHERE 1");
                        while ($result = $query->fetch())
                        {
                            ?>
                            <option value="<?= $result['id_etablissement'] ?>" <?php if (isset($editResult) && $editResult['id_etablissement'] == $result['id_etablissement']) echo "selected" ?> > <?= $result['nom_etablissement']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="departement">Departement</label>
                        <select name="department" id="department" class="form-control" onchange="showLaboratory(this.value)">
                            <?php if (isset($editResult) && $editResult["id_departement"] != null): ?>
                                <option value="<?= $editResult["id_departement"] ?>">
                                    <?php
                                    $query = $bdd->query("SELECT nom_departement FROM departement WHERE id_departement = " . intval($editResult["id_departement"]));
                                    echo $query->fetchColumn();
                                    ?>
                                </option>
                            <?php endif; ?>
                        </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="laboratory">Laboratoire</label>
                    <select name="laboratory" id="laboratory" class="form-control" onchange="showSpeciality(this.value)">
                        <?php if (isset($editResult) && $editResult["id_laboratoire"] != null): ?>
                            <option value="<?= $editResult["id_laboratoire"] ?>">
                                <?php
                                $query = $bdd->query("SELECT libelle_laboratoire FROM laboratoire WHERE id_laboratoire = " . intval($editResult["id_laboratoire"]));
                                echo $query->fetchColumn();
                                ?>
                            </option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="speciality">Spécialité laboratoire</label>
                    <select name="speciality" id="speciality" class="form-control">
                        <?php if (isset($editResult) && $editResult["id_specialite_labo"] != null): ?>
                        <option value="<?= $editResult["id_specialite_labo"] ?>">
                            <?php
                                $query = $bdd->query("SELECT libelle_specialite_labo FROM specialite_labo WHERE id_specialite_labo = " . intval($editResult["id_specialite_labo"]));
                                echo $query->fetchColumn();
                            ?>
                        </option>
                        <?php endif; ?>
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
                            <option value="<?= $result['id_departement']?>" <?php if (isset($editResult) && $editResult['id_departement'] == $result['id_departement']) echo "selected" ?> > <?= $result['nom_departement']?> </option>
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
                            <option value="<?= $result['id_pays']?>" <?php if (isset($editResult) && $editResult["id_pays"] == $result['id_pays'] ) echo "selected"?> > <?= $result['lib_pays']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="dateRecrutement">Date de récrutement</label>
                    <input type="date" value="<?php if (isset($editResult)) echo $editResult['date_recrutement_enseignant']?>" class="form-control " id="dateRecrutement"  name="dateRecrutement" required="" autofocus="">
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
                            <option value="<?= $result['id_groupe_utilisateur']?>" <?php if (isset($editResult) && $editResult['id_groupe_utilisateur'] == $result['id_groupe_utilisateur']) echo "selected" ?>> <?= $result['libelle_groupe_utilisateur']?> </option>
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
                            <option value="<?= $result['id_qualite_utilisateur']?>" <?php if (isset($editResult) && $editResult['id_qualite_utilisateur'] == $result['id_qualite_utilisateur']) echo "selected" ?>> <?= $result['lib_qualite_utilisateur']?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="login">Nom d'utilisateur</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['login_utilisateur']?>"  class="form-control " id="login"  name="login" required="" autofocus="">
                </div>

                <div class="form-group col-md-4">
                    <label for="password">Mot de passe</label>
                    <input type="text" value="<?php if (isset($editResult)) echo $editResult['mot_passe_utilisateur']?>" class="form-control " id="password"  name="password" required="" autofocus="">
                </div>
            </div>

            <div class="row form-group" hidden>
                <label for="">Identifiant utilisateur</label>
                <input type="text" name="id_utilisateur" value="<?php if (isset($editResult)) echo $editResult["id_utilisateur"] ?>">
            </div>


            <!-- Save -->
            <?php include "teacher/modals/saveModal.php"?>
            <!-- Update -->
            <?php include "teacher/modals/updateModal.php"?>

        </form>

        <div align="left">

            <?php if (!isset($editResult)) : ?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#saveClasseModal">Valider</button>
            <?php else : ?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#updateClasseModal"><i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>Enregistrer</button>
            <?php endif; ?>

        </div>

    </div>

</div>

<?php $list = $teacherManager->getList(); ?>

<?php include "teacher/include/formListTeacher-block.php"?>

<script src="teacher/script/tscript.js"></script>
