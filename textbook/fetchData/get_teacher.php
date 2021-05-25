<?php
session_start();
include "../../config/connexion.php";

$idInstitution = intval($_POST['institution']);
$idDepartment = intval($_POST["department"]);

/*
 * Liste des enseignants */
$teachers = array();
$query = $bdd->query("SELECT id_enseignant, nom_enseignant, prenom_enseignant
                               FROM enseignant
                               WHERE id_etablissement = " . $idInstitution . "
                               AND id_departement = " . $idDepartment);
while($data = $query->fetch(PDO::FETCH_ASSOC)){ $teachers[] = $data; }
?>

<option value="">
    <?php if (count($teachers) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>

<?php
foreach ($teachers as $teacher) { ?>
    <option value="<?= $teacher["id_enseignant"] ?>">
        <?= ucwords(strtolower($teacher["nom_enseignant"] . " " . $teacher["prenom_enseignant"])) ?>
    </option>
<?php } ?>
