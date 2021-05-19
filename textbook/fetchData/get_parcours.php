<?php
session_start();
include "../../config/connexion.php";

/* Selection des spécialités (parcours) */
$query = $bdd->query("SELECT specialite.id_specialite, specialite.libelle_specialite FROM specialite
                            INNER JOIN attribuer
                            ON attribuer.id_specialite = specialite.id_specialite
                            INNER JOIN semestre
                            ON semestre.id_semestre = attribuer.id_semestre
                            INNER JOIN niveau
                            ON semestre.id_niveau = niveau.id_niveau
                            AND niveau.id_niveau = ". (int)$_POST["value"] ."
                            AND attribuer.id_ecue = ". (int)$_POST["ecue"] ."
                            AND attribuer.id_enseignant = ".$_SESSION["teacher"]."
                            AND attribuer.id_annee_academique = ".$_SESSION["id_annee_academique"]." ");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $specialites[] = $data;
}

?>
<option value=""></option>
<?php
foreach ($specialites as $specialite) { ?>
    <option value="<?= $specialite["id_specialite"] ?>"><?= $specialite["libelle_specialite"] ?></option>
<?php } ?>
