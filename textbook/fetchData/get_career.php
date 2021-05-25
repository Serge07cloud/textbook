<?php
session_start();
include "../../config/connexion.php";

$idGrade        = intval($_POST["grade"]);
$idEcue         = intval($_POST["ecue"]);
$idTeacher      = intval($_POST["teacher"]);
$idDepartment   = intval($_POST["department"]);
$idInstitution  = intval($_POST["institution"]);

/* Selection des spécialités (parcours) */
$careers = array();
$query = $bdd->query("SELECT specialite.id_specialite, specialite.libelle_specialite 
                               FROM specialite
                               INNER JOIN attribuer
                                ON attribuer.id_specialite = specialite.id_specialite
                               INNER JOIN semestre
                                ON semestre.id_semestre = attribuer.id_semestre
                               INNER JOIN niveau
                                ON semestre.id_niveau = niveau.id_niveau
                               AND niveau.id_niveau              = " . $idGrade       . "
                               AND attribuer.id_ecue             = " . $idEcue        . "
                               AND attribuer.id_enseignant       = " . $idTeacher     . "
                           AND attribuer.id_departement          = " . $idDepartment  . "
                               AND attribuer.id_etablissement    = " . $idInstitution . "
                               AND attribuer.id_annee_academique = " . $_SESSION["id_annee_academique"]." ");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $careers[] = $data;
}

?>
<option value="">
    <?php if (count($careers) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>
<?php
foreach ($careers as $career) { ?>
    <option value="<?= $career["id_specialite"] ?>">
        <?= ucfirst(strtolower($career["libelle_specialite"])) ?>
    </option>
<?php } ?>
