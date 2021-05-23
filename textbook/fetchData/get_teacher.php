<?php
session_start();
include "../../config/connexion.php";


$idDepartement = intval($_POST["department"]);
$idEtablissement = intval($_SESSION["id_etablissement"]);

/*
 * Liste des enseignants */
$teachers = array();
$query = $bdd->query("SELECT id_enseignant, nom_enseignant, prenom_enseignant
                               FROM enseignant
                               WHERE id_etablissement = " . $idEtablissement . "
                               AND id_departement = " . $idDepartement);
while($data = $query->fetch(PDO::FETCH_ASSOC)){
    $teachers[] = $data;
}
?>
<option value=""><?php echo "Choisir..."?></option>
<?php
foreach ($teachers as $teacher) { ?>
    <option value="<?= $teacher["id_enseignant"] ?>"><?= $teacher["nom_enseignant"] . " " . $teacher["prenom_enseignant"] ?></option>
<?php } ?>
