<?php
require "../config/connexion.php";
$idLaboratory = intval($_POST['laboratory']);

$specialities = array();
$query = $bdd->query("SELECT id_specialite_labo, libelle_specialite_labo FROM specialite_labo WHERE id_laboratoire = " . $idLaboratory);
while ($result = $query->fetch(PDO::FETCH_ASSOC)){
    $specialities[] = $result;
}
?>

<option value="">
    <?php if (count($specialities) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>

<?php
foreach ($specialities as $speciality) { ?>
    <option value="<?= $speciality["id_specialite_labo"] ?>">
        <?= ucfirst(strtolower($speciality["libelle_specialite_labo"])) ?>
    </option>
<?php } ?>
