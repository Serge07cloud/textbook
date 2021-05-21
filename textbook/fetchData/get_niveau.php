<?php
session_start();
include "../../config/connexion.php";

/*
 * Sélection du niveau */
$query = $bdd->query("SELECT niveau.id_niveau, niveau.libelle_niveau FROM niveau 
INNER JOIN semestre
ON semestre.id_niveau = niveau.id_niveau
INNER JOIN attribuer
ON attribuer.id_semestre = semestre.id_semestre
AND attribuer.id_ecue = ".(int)$_POST["value"]."
AND attribuer.id_enseignant = ". intval($_POST["teacher"]) ."
AND attribuer.id_annee_academique = ". $_SESSION["id_annee_academique"]."");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $niveaux[] = $data;
}

?>
<option value="">Choisir...</option>
<?php
foreach ($niveaux as $niveau) { ?>
    <option value="<?= $niveau["id_niveau"] ?>"><?= $niveau["libelle_niveau"] ?></option>
<?php } ?>
