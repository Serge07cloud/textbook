<?php
require_once ('dbtest.php');
if(!empty($_POST["keyword"])) {
    //affichage
    $key = $_POST["keyword"];
    $stmt = $bdtest->prepare("SELECT * FROM etudiant WHERE matricule_etudiant LIKE '%".$key."%' ORDER BY id_etudiant ASC");
    $stmt->execute();
// Fetch the records so we can display them in our template.
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($result)) {
        ?>
        <ul id="country-list">
            <?php
            foreach($result as $country) {
                ?>
                <li onClick="selectEtudiant('<?php echo $country["matricule_etudiant"]; ?>');"><?php echo $country["matricule_etudiant"]; ?></li>
            <?php } ?>
        </ul>
    <?php } } ?>
