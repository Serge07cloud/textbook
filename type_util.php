<?php
if (isset($_POST['enregistrer']))
{



    $gu = $bdd->query('SELECT * FROM type_utilisateur WHERE libelle_type_utilisateur="'.$_POST['libelle_type_utilisateur'].'" OR id_type_utilisateur="'.$_POST['identifiant'].'" ')   ;



    if ($res = $gu->fetch())
    {
        ?>
        <div><span id="" class="form-text text-warning font-weight-bold"><i class="fas fa-ban fa-md fa-fw mr-2"></i>Information(s) existante(s) .</span></div>
        <?php

    }
    else
    {

        $bdd->query('INSERT INTO type_utilisateur (id_type_utilisateur, libelle_type_utilisateur, id_qualite_utilisateur) VALUES ("'.$_POST['identifiant'].'", "'.$_POST['libelle_type_utilisateur'].'","'.$_POST['id_qualite_utilisateur'].'")')   ;

        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-check-square fa-md fa-fw mr-2"></i>Informations enrégistrées avec succès .</span></div>
        <?php
    }
//Pour gerer le systeme de boucle
    $g= $bdd->query("SELECT * FROM type_utilisateur AS t INNER JOIN groupe_utilisateur AS g WHERE t.id_qualite_utilisateur=g.id_groupe_utilisateur AND t.id_qualite_utilisateur='$_POST[id_qualite_utilisateur]'")   ;
    $re = $g->fetch();

}
if ( isset($_POST['modifier'])) {

    $bdd->exec('UPDATE type_utilisateur SET libelle_type_utilisateur = "'.$_POST['libelle_type_utilisateur'].'",id_qualite_utilisateur = "'.$_POST['id_qualite_utilisateur'].'" WHERE id_type_utilisateur = "'.$_GET[id].'"')   ;
    ?>
    <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations modifiées avec succès .</span></div>
    <?php
    # code...
}

if (isset($_GET['id'])) {
    $g= $bdd->query("SELECT * FROM type_utilisateur AS t INNER JOIN groupe_utilisateur AS g WHERE t.id_qualite_utilisateur=g.id_groupe_utilisateur AND t.id_type_utilisateur='$_GET[id]'")   ;
    $rep = $g->fetch();
}



//Suppression
if (isset($_POST['supprimer'])) {
    if (!empty($_POST["cocher"])) {
        foreach ($_POST["cocher"] as $c) {

            $bdd->exec("DELETE FROM type_utilisateur WHERE id_type_utilisateur = '$c'")   ;
        }
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations supprimées avec succès .</span></div>
        <?php
    }
}


?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <center><h3 class="m-0 font-weight-bold text-primary">Type utilisateur</h3></center>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Groupe utilisateur">Groupe utilisateur</label>
                    <select class="form-control " name="id_qualite_utilisateur">
                        <?php
                        $r = $bdd->query("
            SELECT * FROM groupe_utilisateur ORDER BY libelle_groupe_utilisateur ASC")   ;

                        while($d = $r->fetch())
                        {
                            if ($d['id_groupe_utilisateur']==$rep['id_qualite_utilisateur'] OR $d['id_groupe_utilisateur']==$re['id_qualite_utilisateur'])
                            {
                                ?>
                                <option selected value="<?php echo $d['id_groupe_utilisateur'];?>"> <?=$d['libelle_groupe_utilisateur']?></option>
                                <?php
                                break;
                            }
                            else
                            {

                                ?>
                                <option value="<?php echo $d['id_groupe_utilisateur'];?>" > <?php echo $d['libelle_groupe_utilisateur'];?> </option>
                                <?php
                            }

                        }

                        ?>
                    </select>


                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2 mr-4">
                    <label for="Identifiant">Identifiant</label>
                    <input type="text" class="form-control " id="identifiant"  name="identifiant" required="" autofocus="" value="<?php echo@ $rep['id_type_utilisateur']?>" <?php if (isset($_GET['id'])){  echo "disabled";}?>>
                </div>
                <div class="form-group col-md-6">
                    <label for="Libellé">Libellé</label>
                    <input type="text" class="form-control " id="libelle_type_utilisateur"   name="libelle_type_utilisateur" required="" value="<?php echo @$rep['libelle_type_utilisateur']?>">
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
            if (!isset($_GET[id]))
            {
                ?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#saveClasseModal">Valider</button>
                <button  class="btn btn-danger" type="reset">Annuler</button>
                <?php
            }
            else if(isset($_GET[id]))
            {?>
                <button  class="btn btn-primary" data-toggle="modal" data-target="#updateClasseModal">Valider</button>
                <a  class="btn btn-danger"  href="index.php?page=type_util">Annuler</a>

                <?php

            } ?>
        </div>

    </div>
</div>













<?php

$gu = $bdd->query("SELECT * FROM type_utilisateur AS t INNER JOIN groupe_utilisateur AS g WHERE t.id_qualite_utilisateur=g.id_groupe_utilisateur ORDER BY id_type_utilisateur ASC")   ;

?>
<form action="" method="POST">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des types utilisateurs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Libéllé</th>
                        <th>Groupe utilisateur</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Libéllé</th>
                        <th>Groupe utilisateur</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    while($res = $gu->fetch())
                    {
                        ?>
                        <tr>
                            <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $res['id_type_utilisateur']; ?>"></td>
                            <td><a href="index.php?page=type_util&id=<?php echo $res['id_type_utilisateur'];?>"><?php echo $res['id_type_utilisateur'];?></a></td>
                            <td><?php echo $res['libelle_type_utilisateur'];?></td>
                            <td><?php echo $res['libelle_groupe_utilisateur'];?></td>

                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#DeleteEvaluationModal" style="margin: 20px;"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Supprimer la sélection</a></div>

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
    </div>

    </div>
    <!-- /.container-fluid -->

    </div>


</form>