<?php
session_start();
include "../../config/connexion.php";

$type           = $_POST["type"];
$idCareer       = intval($_POST["career"]);
$idGrade        = intval($_POST["grade"]);
$idEcue         = intval($_POST["ecue"]);
$idTeacher      = intval($_POST["teacher"]);
$idDepartment   = intval($_POST["department"]);
$idInstitution  = intval($_POST["institution"]);
/*
 * Selection de tous les CM */
$groups = array();
$query = $bdd->query("SELECT groupe_cm,groupe_td,groupe_tp FROM attribuer
                                INNER JOIN semestre
                                ON semestre.id_semestre = attribuer.id_semestre
                                INNER JOIN niveau
                                ON semestre.id_niveau = niveau.id_niveau
                                AND attribuer.id_specialite         = " . $idCareer         . "
                                AND niveau.id_niveau                = " . $idGrade          . "
                                AND attribuer.id_ecue               = " . $idEcue           . "
                                AND attribuer.id_enseignant         = " . $idTeacher        . "
                                AND attribuer.id_departement        = " . $idDepartment     . "
                                AND attribuer.id_etablissement      = " . $idInstitution    . "
                                AND attribuer.id_annee_academique   = " . $_SESSION["id_annee_academique"]." ");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $groups[] = $data;
}
switch ($type){
    case "CM":
        $value = (int)$groups[0]["groupe_cm"];
        break;
    case "TD":
        $value = (int)$groups[0]["groupe_td"];
        break;
    case "TP":
        $value = (int)$groups[0]["groupe_tp"];
        break;
}

if ($value < 10) echo ("0".$value);
else echo $value;
?>

<?php if ($type === "CM") :?>
    <p id="valCM" hidden><?=  $value ?></p>
<?php endif;?>

<?php if ($type === "TD") :?>
    <p id="valTD" hidden><?=  $value ?></p>
<?php endif;?>

<?php if ($type === "TP") :?>
    <p id="valTP" hidden><?=  $value ?></p>
<?php endif;?>


<script>
    $(function (){
        if (Number($("#valCM").text() > 0)) $("#cm input").removeAttr("disabled");
        if (Number($("#valTD").text() > 0)) $("#td input").removeAttr("disabled");
        if (Number($("#valTP").text() > 0)) $("#tp input").removeAttr("disabled");

        if (Number($('#valCM').text() > 0) &&
            Number($('#valTD').text() > 0) &&
            Number($('#valTP').text() > 0)){
            $("#all").removeAttr("disabled");
        }

        if (Number($('#valCM').text() > 0) ||
            Number($('#valTD').text() > 0) ||
            Number($('#valTP').text() > 0)){
            $("#summary").removeAttr("disabled");
        }
    });

</script>
