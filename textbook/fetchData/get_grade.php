<?php
session_start();
include "../../config/connexion.php";

       $idEcue  = intval($_POST["ecue"]);
    $idTeacher  = intval($_POST["teacher"]);
 $idDepartment  = intval($_POST["department"]);
$idInstitution  = intval($_POST["institution"]);
/*
 * Sélection du niveau */
$grades = array();
$query = $bdd->query("SELECT niveau.id_niveau, niveau.libelle_niveau 
                               FROM niveau 
                               INNER JOIN semestre
                                ON semestre.id_niveau = niveau.id_niveau
                               INNER JOIN attribuer
                                ON attribuer.id_semestre = semestre.id_semestre
                               AND attribuer.id_ecue                = " . $idEcue       . "
                               AND attribuer.id_enseignant          = " . $idTeacher    . "
                               AND attribuer.id_departement         = " . $idDepartment . "
                               AND attribuer.id_etablissement       = " . $idInstitution. "
                               AND attribuer.id_annee_academique    = " . $_SESSION["id_annee_academique"]."");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $grades[] = $data;
}

?>
<option value="">
    <?php if (count($grades) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>
<?php
foreach ($grades as $grade) { ?>
    <option value="<?= $grade["id_niveau"] ?>">
        <?= ucfirst(strtolower($grade["libelle_niveau"])) ?>
    </option>
<?php } ?>
