<?php
    require "../config/connexion.php";
    $idEstablishment = intval($_GET['el']);
    ?>

<select name="departement" class="form-control">
    <option value="null"></option>
    <?php
    $query = $bdd->query("SELECT id_departement, nom_departement FROM departement WHERE id_etablissement = '". $idEstablishment ."'" );
    while ($result = $query->fetch())
    {
        ?>
        <option value="<?= $result['id_departement']?>"> <?= $result['nom_departement']?> </option>
        <?php
    }
    ?>
</select>
