<?php
    session_start();

    $teachers = array();
    $query = $bdd->query("SELECT id_enseignant, nom_enseignant, prenom_enseignant FROM enseignant WHERE id_departement = " . (int)$_SESSION["id_departement"]);
    while ($data = $query->fetch(PDO::FETCH_ASSOC)){
        $teachers[] = $data;
    };

?>

<form action="./textbook/process.php" method="POST" onsubmit="onFormSubmit(this)">
    <div class="row form-group">
        <div class="col-sm-6">
            <label for="ue">ENSEIGNANTS</label>
            <select name="teacher" id="teacher" class="form-control" onchange="afficherUe(this.value)">
                <option value=""></option>
                <?php foreach ($teachers as $teacher): ?>
                    <option value="<?= $teacher["id_enseignant"] ?>"> <?= $teacher["nom_enseignant"] . " " . $teacher["prenom_enseignant"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-sm">
            <label for="ue">UE</label>
            <select name="ue" id="ue" class="form-control" onchange="afficherEcue(this.value)">
                <option value=""></option>
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
    //Tout selectionner
    $('#all').click(function (){
        $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
    });

    function onFormSubmit(form){
        // Créer un tableau d'objet avec toutes les valeurs
        var data = {
            "teacher"       : form.teacher.value,
            "ue"            : form.ue.value,
            "ecue"          : form.ecue.value,
            "niveau"        : form.niveau.value,
            "specialite"    : form.specialite.value,
            "cm_checked"    : $('#cm_value').is(':checked'),
            "cm_group"     : $('#cm label span').text(),
            "td_checked"    : $('#td_value').is(':checked'),
            "td_group"     : $('#td label span').text(),
            "tp_checked"    : $('#tp_value').is(':checked'),
            "tp_group"     : $('#tp label span').text()
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

    function resetValues(){
        $("#cm label span, #td label span, #tp label span")
            .empty()
            .append('0');
    }

    function afficherUe(teacher){
        $("#ue ,#ecue, #niveau, #specialite")
            .empty()
            .append('<option value=""></option>');
        resetValues();
        $('#ue').load('textbook/fetchData/get_ue.php', { value : teacher });
    }

    function afficherEcue(ue){
        $("#ecue, #niveau, #specialite")
            .empty()
            .append('<option value=""></option>');
        resetValues();
        $('#ecue').load('textbook/fetchData/get_ecue.php',
            {
                value : ue,
                teacher : $('#teacher').val()
            });
    }

    function afficherNiveau(value){
        $("#niveau, #specialite")
            .empty()
            .append('<option value=""></option>');
        resetValues();
        $('#niveau').load('textbook/fetchData/get_niveau.php',
            {
                value : value,
                teacher : $('#teacher').val()
            });
    }

    function afficherGroupe(parcours){
        $('#cm span').load('textbook/fetchData/get_cm.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val(),
                teacher : $("#teacher").val()
            }
        );
        $('#td span').load('textbook/fetchData/get_td.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val(),
                teacher : $("#teacher").val()
            }
        );
        $('#tp span').load('textbook/fetchData/get_tp.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val(),
                teacher : $("#teacher").val()
            }
        );

    }

    function afficherSpecialites(value){

        $('#specialite').load('textbook/fetchData/get_parcours.php',
            {
                value: value,
                ecue : $('#ecue').val(),
                teacher : $("#teacher").val()
            }
        );
    }
</script>