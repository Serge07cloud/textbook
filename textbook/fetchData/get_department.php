<?php
include "../../config/connexion.php";

$idInstitution = intval($_POST['institution']);

/* Liste des departements dans associé à l'UFR */
$departments = array();
$query = $bdd->query("SELECT id_departement, nom_departement 
                               FROM departement WHERE id_etablissement = " . $idInstitution);
while($data = $query->fetch(PDO::FETCH_ASSOC)){
    $departments[] = $data;
}
?>
<option value="">Choisir...</option>
<?php
foreach ($departments as $department) { ?>
    <option value="<?= $department["id_departement"] ?>">
        <?= ucfirst(strtolower($department["nom_departement"])) ?>
    </option>
<?php } ?>
