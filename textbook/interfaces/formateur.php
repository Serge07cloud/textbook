<?php
session_start();
if ($_SESSION['id_type_utilisateur'] == 4){
    # It' a teacher
    # Selection of his ID
    $query = $bdd->query("SELECT id_enseignant FROM  enseignant WHERE id_utilisateur = " . $_SESSION["connecte"]);
    $_SESSION["teacher"] = $query->fetchColumn();
}
var_dump($_SESSION);
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
<!-- UE and ECUE -->
<form action="./textbook/process.php" method="POST" onsubmit="onFormSubmit(this)">
    <div class="row form-group">
        <div class="col-sm">
            <label for="ue">UE</label>
            <select name="ue" id="ue" class="form-control" onchange="afficherEcue(this.value)">
                <option value=""></option>
                <?php foreach ($listUe as $ue): ?>
                    <option value="<?= $ue["id_ue"] ?>"> <?= $ue["intitule_ue"],$ue["id_ue"] ?></option>
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
    <!-- NIVEAU ET PARCOURS -->
    <div class="row form-group">
        <div class="col-sm">
            <label for="niveau">NIVEAU</label>
            <select name="niveau" id="niveau" class="form-control" onchange="afficherSpecialites(this.value)">
                <option value=""></option>
            </select>
        </div>
        <div class="col-sm">
            <label for="specialite">PARCOURS</label>
            <select name="specialite" id="specialite" class="form-control" onchange="afficherGroupe(this.value)">
                <option value=""></option>
            </select>
        </div>
    </div>
    <!-- GROUPE -->
    <div class="form-group">
            <p class="card-header">GROUPES</p>
            <div class="card-body">
                <div class="form-check" id="cm">
                    <input type="checkbox" class="form-check-input" id="cm_value" name="cm_value">
                    <label for="cm_value" class="form-check-label">CM  (<span>00</span>)</label>
                </div>
                <div class="form-check" id="td">
                    <input type="checkbox" class="form-check-input" id="td_value" name="td_value">
                    <label for="td_value" class="form-check-label">TD (<span>00</span>)</label>
                </div>
                <div class="form-check" id="tp">
                    <input type="checkbox" class="form-check-input" id="tp_value" name="tp_value">
                    <label for="tp_value" class="form-check-label">TP (<span>00</span>)</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="all">
                    <label for="tp_value" class="form-check-label">SELECTIONNER TOUT</label>
                </div>

                <div class="container text-right">
                    <input type="submit" class="btn btn-primary" value="Resume" name="resume">
                </div>
            </div>

    </div>
</form>



<script>
    /*
    * Tout selectionner */
    $('#all').click(function (){
        $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
    });

    // $("form").on('DOMSubtreeModified', "#cm label span", function() {
    //     alert("changed");
    // });

    function onFormSubmit(form){
        // Créer un tableau d'objet avec toutes les valeurs
        var data = {
            "ue"            : form.ue.value,
            "ecue"          : form.ecue.value,
            "niveau"        : form.niveau.value,
            "specialite"    : form.specialite.value,
            "cm_checked"    : $('#cm_value').is(':checked'),
            "cm_group"     : $('#cm label span').text(),
            "td_checked"    : $('#td_value').is(':checked'),
            "td_group"     : $('#td label span').text(),
            "tp_checked"    : $('#tp_value').is(':checked'),
            "tp_group"     : $('#tp label span').text(),
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
        $('#ecue').load('textbook/fetchData/get_ecue.php', { value : ue });
    }

    function afficherNiveau(value){
        $('#niveau').load('textbook/fetchData/get_niveau.php', { value : value });
    }

    function afficherGroupe(parcours){
        $('#cm span').load('textbook/fetchData/get_cm.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val()
            }
        );
        $('#td span').load('textbook/fetchData/get_td.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val()
            }
        );
        $('#tp span').load('textbook/fetchData/get_tp.php',
            {
                parcours : parcours,
                niveau : $('#niveau').val(),
                ecue : $('#ecue').val()
            }
        );
    }

    function afficherSpecialites(value){
        $('#specialite').load('textbook/fetchData/get_parcours.php',
            {
                value: value,
                ecue : $('#ecue').val()
            }
        );
    }



</script>