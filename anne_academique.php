<?php

//insertion
if (isset($_POST['enregistrer'])) {
    $gu = $bdd->query('SELECT * FROM annee_academique WHERE libelle_annee_academique="'.$_POST['libelle_annee_academique'].'" OR identifiant="'.$_POST['identifiant'].'" ')   ;
    if ($res = $gu->fetch())
    {
        ?>
        <div><span id="" class="form-text text-warning font-weight-bold"><i class="fas fa-ban fa-md fa-fw mr-2"></i>Information(s) existante(s) .</span></div>
        <?php
    }
    else
    {
        $identifiant = $_POST['identifiant'];
        $libelle = $_POST['libelle'];
        $date_ouverture = $_POST['date_ouverture'];
        $date_fermeture = $_POST['date_fermeture'];
        $type_regime = $_POST['regime'];
        $bdd->query("INSERT INTO annee_academique (identifiant,libelle_annee_academique,date_ouverture,date_fermeture,type_regime) VALUES ('$identifiant','$libelle','$date_ouverture','$date_fermeture','$type_regime')")   ;
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-check-square fa-md fa-fw mr-2"></i>Informations enrégistrées avec succès .</span></div>
        <?php
    }

}

if (isset($_POST['modifier'])) {
    $libelle = $_POST['libelle'];
    $date_ouverture = $_POST['date_ouverture'];
    $date_fermeture = $_POST['date_fermeture'];
    $type_regime = $_POST['regime'];
    $resultat = $bdd->exec("UPDATE annee_academique SET libelle_annee_academique='$libelle',date_ouverture='$date_ouverture',date_fermeture='$date_fermeture',type_regime='$type_regime' WHERE identifiant ='$_GET[id]'")   ;
    if ($resultat){
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations modifiées avec succès .</span></div>
        <?php
        header("Location:index.php?page=anne_aca");
    }else{
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Erreur lors de la modification .</span></div>
        <?php
    }
    # code...
}

if (isset($_GET['id'])) {
    $id = $_GET[id];
    $g= $bdd->query("SELECT * FROM annee_academique,type_regime WHERE type_regime=id_type_regime AND identifiant='$id'")   ;
    $rep = $g->fetch();
}



//Suppression
if (isset($_POST['supprimer'])) {
    if (!empty($_POST["cocher"])) {
        foreach ($_POST["cocher"] as $c) {
            $bdd->exec("DELETE FROM annee_academique WHERE identifiant = '$c'")   ;
        }
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations supprimées avec succès .</span></div>
        <?php
    }
}



?>

<?php
//affichage
$stmt = $bdd->prepare("SELECT * FROM annee_academique,type_regime WHERE type_regime=id_type_regime ORDER BY id_annee_academique DESC");
$stmt->execute();
// Fetch the records so we can display them in our template.
$annees = $stmt->fetchAll(PDO::FETCH_ASSOC);



$reg = $bdd->prepare('SELECT * FROM type_regime ORDER BY id_type_regime DESC ');
$reg->execute();
// Fetch the records so we can display them in our template.
$regs = $reg->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <center><h4 class="m-0 font-weight-bold text-primary">Annee Academique</h4></center>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-row">
                <div class="form-group col-md-3 mr-4">
                    <label for="inputEmail4">Identifiant</label>
                    <input type="text" name="identifiant" required="" autofocus="" value="<?php echo@ $rep['identifiant']?>" <?php if (isset($_GET['id'])){  echo "disabled";}?> class="form-control" id="inputEmail4">
                </div>
                <div class="form-group col-md-4 mr-4">
                    <label for="inputPassword4">Libelle</label>
                    <input type="text" name="libelle" required="" autofocus="" class="form-control" value="<?php echo@ $rep['libelle_annee_academique']?>">
                </div>
                <div class="form-group col-md-4 mr-4" >
                    <label for="inputPassword4">Type de regime</label>
                    <select id="inputState" name="regime" required class="form-control">
                        <option selected>Choisir...</option>
                        <?php
                        foreach ($regs as $reg1){
                            if ($reg1['id_type_regime'] == $rep['type_regime']){
                                ?>
                                <option selected value="<?=$reg1['id_type_regime']?>"><?=$rep['libelle_type_regime']?></option>
                                <?php
                            }else{
                                ?>
                                <option value="<?=$reg1['id_type_regime']?>"><?=$reg1['libelle_type_regime']?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4 mr-4">
                    <label for="inputEmail4">Date ouverture</label>
                    <input type="date" name="date_ouverture" required autofocus class="form-control" value="<?php echo@ $rep['date_ouverture']?>" id="inputEmail4">
                </div>
                <div class="form-group col-md-4 mr-4">
                    <label for="inputPassword4">Date fermeture</label>
                    <input type="date" class="form-control" required autofocus name="date_fermeture" value="<?php echo@ $rep['date_fermeture']?>" id="inputPassword4">
                </div>
            </div>


            <div class="modal fade" id="saveClasseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment enregistrer ces informations ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Cliquez sur le bouton "Enregistrer" ci-dessous si vous voulez valider ces informations.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <!--<a class="btn btn-primary" href="index.php?page=aj_etab&amp;act=save">Enregistrer</a>-->
                            <button type="submit" class="btn btn-primary" name="enregistrer" data-toggle="modal" data-target="#saveClasseModal" ><i class="fas fa-plus-square fa-sm fa-fw mr-2 text-gray-400"></i> Enregister </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="updateClasseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment modifier ces informations ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Cliquez sur le bouton "Modifier" ci-dessous si vous voulez valider ces informations.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <!--<a class="btn btn-primary" href="index.php?page=aj_etab&amp;act=save">Enregistrer</a>-->
                            <button type="submit" class="btn btn-primary" name="modifier" data-toggle="modal" data-target="#saveClasseModal" ><i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Modifier </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div align="right">
            <?php
            if (!isset($_GET['id']))
            {
                ?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#saveClasseModal">Valider</button>
                <button  class="btn btn-danger" type="reset">Annuler</button>
                <?php
            }
            else if(isset($_GET['id']))
            {?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#updateClasseModal">Valider</button>
                <a class="btn btn-danger"  href="index.php?page=anne_aca">Annuler</a>

                <?php

            } ?>

        </div>
    </div>
</div>





<!-- Listes -->
<form action="" method="post">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listes des annees academiques</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Libelle</th>
                        <th>Type Regime</th>
                        <th>Date ouverture</th>
                        <th>Date fermeture</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Libelle</th>
                        <th>Type Regime</th>
                        <th>Date ouverture</th>
                        <th>Date fermeture</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    // On boucle sur tous les articles
                    foreach($annees as $annee){
                        ?>
                        <tr>
                            <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $annee['identifiant']; ?>"></td>
                            <td><a href="index.php?page=anne_aca&id=<?php echo $annee['identifiant'];?>"><?= $annee['identifiant'] ?></a></td>
                            <td><?= $annee['libelle_annee_academique'] ?></td>
                            <td><?= $annee['libelle_type_regime'] ?></td>
                            <td><?= $annee['date_ouverture'] ?></td>
                            <td><?= $annee['date_fermeture'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#DeleteEvaluationModal" style="margin: 20px;"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Supprimer la sélection</a></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DeleteEvaluationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment supprimer la sélection ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Cliquez sur le bouton "Supprimer" ci-dessous si vous voulez supprimer les éléments sélectionnés.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <!--<a class="btn btn-primary" href="index.php?page=aj_etab&amp;act=save">Enregistrer</a>-->
                    <button type="submit" class="btn btn-danger" name="supprimer"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Supprimer </button>
                </div>
            </div>
        </div>
    </div>


</form>


