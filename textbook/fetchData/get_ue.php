<?php
session_start();
include "../../config/connexion.php";
$teacherId = intval($_POST['value']);

/* Selection des UE */
$query = $bdd->query("SELECT id_ue, intitule_ue FROM ue WHERE id_ue IN (
 SELECT DISTINCT id_ue FROM attribuer WHERE id_enseignant = ". $teacherId . " AND id_annee_academique = ". $_SESSION["id_annee_academique"]. ")");
$ues = array();
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $ues[] = $data;
}


//$query = $bdd->query("SELECT id_ue, intitule_ue FROM ue
//                                WHERE id_ue IN (
//                                SELECT DISTINCT id_ue FROM attribuer WHERE  id_enseignant = ". (int)$_SESSION["teacher"]." AND id_departement = ". (int)$_SESSION["id_departement"]."
//                                )");
//$ues = array();
//while ($data = $query->fetch(PDO::FETCH_ASSOC)){
//    $ues[] = $data;
//}
?>
<option value="">Choisir...</option>
<?php
foreach ($ues as $ue) { ?>
    <option value="<?= $ue["id_ue"] ?>"><?= strtoupper($ue["intitule_ue"]) ?></option>
<?php } ?>
