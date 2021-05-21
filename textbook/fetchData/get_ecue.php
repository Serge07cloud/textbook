<?php
session_start();
include "../../config/connexion.php";
$idUe = intval($_POST['value']);
$teacher = intval($_POST["teacher"]);

/* Selection des ECUE rattaché à cette UE */
$query = $bdd->query("SELECT id_ecue, intitule_ecue FROM ecue
                                WHERE id_ecue IN (
                                SELECT DISTINCT id_ecue FROM attribuer WHERE id_ue = ". $idUe ." AND id_enseignant = ". $teacher ." AND id_annee_academique = ". $_SESSION["id_annee_academique"]."
                                )");
$ecues = array();
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $ecues[] = $data;
}
?>
<option value="">Choisir...</option>
<?php
foreach ($ecues as $ecue) { ?>
    <option value="<?= $ecue["id_ecue"] ?>"><?= strtoupper($ecue["intitule_ecue"]) ?></option>
<?php } ?>
