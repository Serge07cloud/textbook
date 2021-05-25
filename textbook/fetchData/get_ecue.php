<?php
session_start();
include "../../config/connexion.php";

         $idUe  = intval($_POST['ue']);
    $idTeacher  = intval($_POST["teacher"]);
 $idDepartment  = intval($_POST["department"]);
$idInstitution  = intval($_POST["institution"]);

/* Selection des ECUE rattaché à cette UE */
$query = $bdd->query("SELECT id_ecue, intitule_ecue FROM ecue
                                WHERE id_ecue 
                                     IN (
                                        SELECT DISTINCT id_ecue 
                                        FROM attribuer 
                                        WHERE id_ue             = " . $idUe         . " 
                                        AND id_enseignant       = " . $idTeacher    . " 
                                        AND id_departement      = " . $idDepartment . "
                                        AND id_etablissement    = " . $idInstitution. "
                                        AND id_annee_academique = " . $_SESSION["id_annee_academique"]."
                                )");
$ecues = array();
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $ecues[] = $data;
}
?>
<option value="">
    <?php if (count($ecues) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>

<?php
foreach ($ecues as $ecue) { ?>
    <option value="<?= $ecue["id_ecue"] ?>">
        <?= ucfirst(strtolower($ecue["intitule_ecue"])) ?>
    </option>
<?php } ?>
