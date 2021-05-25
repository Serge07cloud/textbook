<?php
session_start();

// User connected
$query = $bdd->query("SELECT id_enseignant 
                               FROM  enseignant 
                               WHERE id_utilisateur = " . $_SESSION["connecte"]);
$_SESSION["teacher"] = $query->fetchColumn();

// Ue selection
$listUe = array();
$query = $bdd->query("SELECT DISTINCT ue.id_ue, ue.intitule_ue FROM ue 
                               WHERE id_ue IN (
                                    SELECT DISTINCT attribuer.id_ue FROM attribuer 
                                    WHERE attribuer.id_enseignant = ". $_SESSION["teacher"] ." 
                                    AND attribuer.id_annee_academique = ". $_SESSION["id_annee_academique"]."
                               )
");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){    $listUe[] = $data;  };

?>

<form action="./textbook/process.php" method="POST" onsubmit="onFormSubmit(this)">

    <div class="row form-group">
        <select name="teacher" id="teacher" hidden>
            <option value="<?php if(isset($_SESSION["teacher"])) echo $_SESSION['teacher']?>">
            </option>
        </select>

        <select name="department" id="department" hidden>
            <option value="<?php if(isset($_SESSION["id_departement"])) echo $_SESSION['id_departement']?>">
            </option>
        </select>

        <select name="institution" id="institution" hidden>
            <option value="<?php if(isset($_SESSION["id_etablissement"])) echo $_SESSION['id_etablissement']?>">
            </option>
        </select>
    </div>

    <div class="row form-group">
        <div class="col-sm">
            <label for="ue">UE</label>
            <select name="ue" id="ue" class="form-control" onchange="displayEcue(this.value)">
                <?php foreach ($listUe as $ue): ?>
                    <option value="<?= $ue["id_ue"] ?>"> <?= $ue["intitule_ue"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php include "textbook/include/ecue-block.php"?>
    </div>

    <div class="row form-group">
        <?php include "textbook/include/grade-block.php"?>
        <?php include "textbook/include/career-block.php"?>
    </div>

    <div class="row form-group">
        <?php include "textbook/include/educationType-block.php"?>
    </div>

    <div class="container text-right">
        <?php include "textbook/include/summary-block.php"?>
    </div>

</form>

<script src="textbook/script/mainScript.js"></script>