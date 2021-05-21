<?php
session_start();

$query = $bdd->query("SELECT id_enseignant FROM  enseignant WHERE id_utilisateur = " . $_SESSION["connecte"]);
$_SESSION["teacher"] = $query->fetchColumn();

/* Sélection de tous les UE auquels appartient l'utilisateur connecté */
$listUe = array();
$query = $bdd->query("SELECT DISTINCT ue.id_ue, ue.intitule_ue FROM ue 
                                    WHERE id_ue IN (
                                    SELECT DISTINCT attribuer.id_ue FROM attribuer 
                                    WHERE attribuer.id_enseignant = ". $_SESSION["teacher"] ." 
                                    AND attribuer.id_annee_academique = ". $_SESSION["id_annee_academique"].")");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $listUe[] = $data;
};

?>

<form action="./textbook/process.php" method="POST" onsubmit="onFormSubmit(this)">
    <div id="teacher" hidden><?= $_SESSION["teacher"]?></div>
    <div class="row form-group">
        <div class="col-sm">
            <label for="ue">UE</label>
            <select name="ue" id="ue" class="form-control" onchange="afficherEcue(this.value)">
                <?php foreach ($listUe as $ue): ?>
                    <option value="<?= $ue["id_ue"] ?>"> <?= $ue["intitule_ue"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm">
            <label for="ecue">ECUE</label>
            <select name="ecue" id="ecue" class="form-control" onchange="afficherNiveau(this.value)">
                <option value=""></option>
            </select>
        </div>
    </div>

    <?php include "textbook/include/form.php"?>

</form>


<script>
    // Tout selectionner
    $('#all').click(function (){
        $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
    });


    function onFormSubmit(form){
        // Créer un tableau d'objet avec toutes les valeurs
        var data = {
            "teacher"       : $("#teacher").text(),
            "ue"            : form.ue.value,
            "ecue"          : form.ecue.value,
            "niveau"        : form.niveau.value,
            "specialite"    : form.specialite.value,
            "cm_checked"    : $('#cm_value').is(':checked'),
            "cm_group"      : $('#cm label span').text(),
            "td_checked"    : $('#td_value').is(':checked'),
            "td_group"      : $('#td label span').text(),
            "tp_checked"    : $('#tp_value').is(':checked'),
            "tp_group"      : $('#tp label span').text(),
        }

        // Convertion en format JSON
        var jsonData = JSON.stringify(data);

        // Sauvegarde des données dans les cookies
        document.cookie = "formateur=" + jsonData;

        // Redirection vers la page de traitement de la form
        window.location.href = from.getAttribute("action");

        // Eviter de soumettre les données
        return false;
    }


    function afficherEcue(ue){
        $("#ecue, #niveau, #specialite")
            .empty()
            .append('<option value=""></option>');
        resetValues();
        $('#ecue').load('textbook/fetchData/get_ecue.php',
            {
                value : ue,
                teacher : $('#teacher').text()
            });
    }

    function resetValues(){
        $("#cm label span, #td label span, #tp label span")
            .empty()
            .append('0');
    }

    function afficherNiveau(value){
        $("#niveau, #specialite")
            .empty()
            .append('<option value=""></option>');
        resetValues();
        $('#niveau').load('textbook/fetchData/get_niveau.php',
            {
                value : value,
                teacher : $("#teacher").text()
            });
    }

    function afficherGroupe(parcours){

        $('#cm span').load('textbook/fetchData/get_cm.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val(),
                teacher : $("#teacher").text()
            }
        );
        $('#td span').load('textbook/fetchData/get_td.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue :   $('#ecue').val(),
                teacher : $("#teacher").text()
            }
        );
        $('#tp span').load('textbook/fetchData/get_tp.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val(),
                teacher : $("#teacher").text()
            }
        );
    }

    function afficherSpecialites(value){
        $('#specialite').load('textbook/fetchData/get_parcours.php',
            {
                value: value,
                ecue : $('#ecue').val(),
                teacher : $("#teacher").text()
            }
        );
    }

</script>