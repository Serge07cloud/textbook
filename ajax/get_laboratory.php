<?php
require "../config/connexion.php";
$idDepartment = intval($_POST['department']);

$laboratories = array();
$query = $bdd->query("SELECT id_laboratoire, libelle_laboratoire FROM laboratoire WHERE id_departement = " . $idDepartment);
while ($result = $query->fetch(PDO::FETCH_ASSOC)){
    $laboratories[] = $result;
}
?>

<option value="">
    <?php if (count($laboratories) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>

<?php
foreach ($laboratories as $laboratory) { ?>
    <option value="<?= $laboratory["id_laboratoire"] ?>">
        <?= ucfirst(strtolower($laboratory["libelle_laboratoire"])) ?>
    </option>
<?php } ?>
