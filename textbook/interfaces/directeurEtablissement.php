<?php
session_start();

# Selection of all departments of the institution (In session variable)
$departments = array();
$query = $bdd->query("SELECT id_departement, nom_departement 
                               FROM departement 
                               WHERE id_etablissement = " . (int)$_SESSION['id_etablissement']);
$departments = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="./textbook/process.php" method="POST" onsubmit="onFormSubmit(this)">

    <div class="row form-group">
        <select name="institution" id="institution" hidden>
            <option value="<?php if(isset($_SESSION["id_etablissement"])) echo $_SESSION['id_etablissement']?>">
            </option>
        </select>
    </div>

    <div class="row form-group">
        <div class="col-sm-6">
            <label for="ue">DEPARTEMENTS</label>
            <select name="department" id="department" class="form-control" onchange="displayTeachers(this.value)">
                <option value="">Choisir...</option>
                <?php foreach ($departments as $department): ?>
                    <option value="<?= $department["id_departement"] ?>"> <?= $department["nom_departement"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <?php include "textbook/include/teacher-block.php"?>
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