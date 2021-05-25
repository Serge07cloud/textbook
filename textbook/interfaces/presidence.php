<?php
session_start();

/* SELECTION OF ALL INSTITUTIONS */
$institutions = array();
$query = $bdd->query("SELECT id_etablissement, nom_etablissement FROM etablissement WHERE 1");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $institutions[] = $data;
};
?>

<form action="./textbook/process.php" method="POST" onsubmit="onFormSubmit(this)">

    <div class="row form-group">
        <div class="col-sm-6">
            <label for="ue">ETABLISSEMENT</label>
            <select name="institution" id="institution" class="form-control" onchange="displayDepartments(this.value)">
                <option value="">Choisir...</option>
                <?php foreach ($institutions as $institution) :?>
                <option value="<?= $institution["id_etablissement"]?>"><?= $institution["nom_etablissement"]?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <?php include "textbook/include/department-block.php"?>
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
        <?php require "textbook/include/educationType-block.php"?>
    </div>

    <div class="container text-right">
        <input type="submit" class="btn btn-primary" value="Resume" name="resume">
    </div>

</form>

<script src="textbook/script/mainScript.js"></script>