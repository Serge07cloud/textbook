<?php
require_once "../recap_functions.php";


$idDepartement = intval($_GET["departement"]);
$idEtablissement = intval($_GET["etablissement"]);

/*
 * Liste des enseignants */
$teachers = getAllTeachers($idEtablissement, $idDepartement);
?>
<option value=""></option>
<?php
foreach ($teachers as $teacher) { ?>
    <option value="<?= $teacher["id_enseignant"] ?>"><?= $teacher["nom_enseignant"] . " " . $teacher["prenom_enseignant"] ?></option>
<?php } ?>
