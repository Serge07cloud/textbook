<?php
session_start();
require "../config/connexion.php";
require "../fonction.php";
if (isset($_GET['id_etablissement']) && !empty($_GET['id_etablissement'])):
    $id_etablissement = (int)$_GET['id_etablissement'];
    global $bdd;
    $requete = "select *
from departement where id_departement not in (39,40,41,52,53,28,29,30,31,32,33,34,38,25,26,27,91,36) and id_etablissement= $id_etablissement ";
    $resultat = $bdd->query($requete);
    $liste = $resultat->fetchAll();
    if (count($liste) > 0):
        foreach ($liste as $res):?>
            <option value="<?= $res['id_departement'] ?>"><?= $res['nom_departement'] ?></option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="0">selectionner</option>
    <?php endif; ?>
<?php endif; ?>


