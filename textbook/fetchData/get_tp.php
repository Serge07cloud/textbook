<?php
session_start();
include "../../config/connexion.php";

/*
 * Selection de tous les CM */
$query = $bdd->query("SELECT groupe_tp FROM attribuer
                                INNER JOIN semestre
                                ON semestre.id_semestre = attribuer.id_semestre
                                INNER JOIN niveau
                                ON semestre.id_niveau = niveau.id_niveau
                                AND attribuer.id_specialite = " .(int)$_POST["parcours"]."
                                AND niveau.id_niveau = ".(int)$_POST["niveau"]."
                                AND attribuer.id_ecue = ".(int)$_POST["ecue"]."
                                AND attribuer.id_enseignant = ".intval($_POST['teacher'])."
                                AND attribuer.id_annee_academique = ".$_SESSION["id_annee_academique"]." ");
while ($data = $query->fetch(PDO::FETCH_ASSOC)){
    $specialites[] = $data;
}
$value = (int)$specialites[0]["groupe_tp"];

if ($value < 10) echo ("0".$value);
else echo $value;
?>