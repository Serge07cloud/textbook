<?php
require_once "../recap_functions.php";

$idDepartement = intval($_GET['el']);

/*
 * Liste des departements dans associé à l'UFR */
$departements = getDepartement($idDepartement)
?>
<option value=""></option>
<?php
foreach ($departements as $departement) { ?>
    <option value="<?= $departement["id_departement"] ?>"><?= $departement["nom_departement"] ?></option>
<?php } ?>
