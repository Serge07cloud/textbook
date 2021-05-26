<?php
    require "../config/connexion.php";
    $idInstitution = intval($_POST['institution']);

    $departments = array();
    $query = $bdd->query("SELECT id_departement, nom_departement FROM departement WHERE id_etablissement = ". $idInstitution );
    while ($result = $query->fetch(PDO::FETCH_ASSOC)){
        $departments[] = $result;
    }
    ?>

<option value="">
    <?php if (count($departments) > 0)
        echo "Choisir...";
    else echo "Aucun"?>
</option>

<?php
foreach ($departments as $department) { ?>
    <option value="<?= $department["id_departement"] ?>" >
        <?= ucfirst(strtolower($department["nom_departement"])) ?>
    </option>
<?php } ?>
