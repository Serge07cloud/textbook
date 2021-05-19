<?php
require_once 'dbtest.php';
if (isset($_POST['id_origine'])) {
    $id_origine = $_POST['id_origine'];
    $g= $bdtest->query("SELECT * FROM parcours WHERE id_mention='$id_origine'") or die(print_r($bdtest->errorInfo()));
    while ($rep = $g->fetch()){
        ?>
        <option value="<?=$rep['id_specialite']?>"><?=$rep['libelle_specialite']?></option>
    <?php  }
}
?>

