<?php
require "../config/connexion.php";
require "../fonction.php";

if (isset($_GET['id_departement']) && !empty($_GET['id_departement'])):
    $id_departement = (int)$_GET['id_departement'];
    global $bdd;
    $requete = "select * from composer_maquette
    join specialite s on composer_maquette.id_specialite = s.id_specialite
    join mention m on s.id_mention = m.id_mention
    join semestre s2 on composer_maquette.id_semestre = s2.id_semestre
    join niveau n on s2.id_niveau = n.id_niveau
where m.id_departement = $id_departement
group by n.id_niveau;";
    $resultat = $bdd->query($requete);
    $liste = $resultat->fetchAll();
    if (count($liste) > 0):
        foreach ($liste as $res):
            ?>
            <option value="<?= $res['id_niveau'] ?>"><?= $res['libelle_niveau'] ?></option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="0">selectionner</option>
    <?php endif; ?>
<?php endif; ?>


