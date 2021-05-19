<?php
require_once ('dbtest.php');
if(isset($_POST['id']))
{
    $id = $_POST['id'];
    $g= $bdtest->query("SELECT * FROM etudiant WHERE matricule_etudiant='$id'") or die(print_r($bdtest->errorInfo()));
    $rep = $g->fetch();
    if ($rep) :
        ?>
        <div class="form-group col-md-3 mr-3 ">
            <label for="ndemande">Nom</label>
            <input type="text" name="nom" class="form-control">
        </div>
        <div class="form-group col-md-5 mr-3">
            <label>Prenoms</label>
            <input type="text" name="prenoms" class="form-control">
        </div>
        <div class="form-group col-md-3 mr-3">
            <label>Date de naissance</label>
            <input type="date" name="date" class="form-control">
        </div>
        <div class="form-group col-md-4 mr-3">
            <label>Lieu de naissance</label>
            <input type="text" name="lieu" class="form-control">
        </div>
        <div class="form-group col-md-1 mr-3">
            <label>Genre</label>
            <input type="text" name="genre" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>Pays</label>
            <input type="text" name="genre" class="form-control">
        </div>
    <?php
    else:
        echo "Etudiant inexistant";
    endif;
}

?>
