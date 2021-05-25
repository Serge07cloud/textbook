<?php
session_start();
$teachers = array();
$query = $bdd->query("SELECT id_enseignant, nom_enseignant, prenom_enseignant 
                               FROM enseignant 
                               WHERE id_departement = " . (int)$_SESSION["id_departement"]);
while ($data = $query->fetch(PDO::FETCH_ASSOC)){ $teachers[] = $data; };

?>

<form action="./textbook/process.php" method="POST" onsubmit="onFormSubmit(this)">

    <div class="row form-group">
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
        <div class="col-sm-6">
            <label for="ue">ENSEIGNANTS</label>
            <select name="teacher" id="teacher" class="form-control" onchange="displayUe(this.value)">
                <option value=""></option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher["id_enseignant"] ?>"> <?= $teacher["nom_enseignant"] . " " . $teacher["prenom_enseignant"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <?php include "textbook/include/ue-block.php"?>
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