<?php
session_start();
include "../../config/connexion.php";

$idTeacher = intval($_POST['teacher']);
$idDepartment = intval($_POST["department"]);
$idInstitution = intval($_POST["institution"]);

/* Selection des UE */
$query = $bdd->query("SELECT id_ue, intitule_ue 
                               FROM ue WHERE id_ue 
                               IN (
                                    SELECT DISTINCT id_ue 
                                    FROM attribuer 
                                    WHERE id_enseignant     = " . $idTeacher    . " 
                                    AND id_departement      = " . $idDepartment . "
                                    AND id_etablissement    = " . $idInstitution. "
                                    AND id_annee_academique = " . $_SESSION["id_annee_academique"]. "
                                    )"
);
$ues = array();
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $ues[] = $data;
}

?>
<option value="">
    <?php if (count($ues) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>
<?php
foreach ($ues as $ue) { ?>
    <option value="<?= $ue["id_ue"] ?>">
        <?= ucfirst(strtolower($ue["intitule_ue"])) ?>
    </option>
<?php } ?>
