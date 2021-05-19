<?php
if (isset($_POST['enregistrer']))
{


    $gu = $bdd->query('SELECT * FROM mention WHERE libelle_mention="'.$_POST['libelle_mention'].'" OR id_mention="'.$_POST['identifiant'].'" ')   ;
    if ($res = $gu->fetch())
    {
        ?>
        <div><span id="" class="form-text text-warning font-weight-bold"><i class="fas fa-ban fa-md fa-fw mr-2"></i>Information(s) existante(s) .</span></div>
        <?php
    }
    else
    {

        $bdd->query('INSERT INTO mention (id_mention, libelle_mention, code_mention,id_etablissement,id_departement,id_domaine) VALUES ("'.$_POST['identifiant'].'", "'.$_POST['libelle_mention'].'","'.$_POST['code_mention'].'" , "'.$_POST['id_etablissement'].'","'.$_POST['id_departement'].'" ,"'.$_POST['id_domaine'].'")')   ;
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-check-square fa-md fa-fw mr-2"></i>Informations enrégistrées avec succès .</span></div>
        <?php
    }


    $g= $bdd->query("SELECT * FROM mention AS m INNER JOIN etablissement AS e, domaine AS d , departement AS de WHERE m.id_etablissement=e.id_etablissement AND m.id_domaine=d.id_domaine AND m.id_departement=de.id_departement AND  m.id_etablissement='$_POST[id_etablissement]'")   ;
    $re = $g->fetch();

    $ge= $bdd->query("SELECT * FROM mention AS m INNER JOIN etablissement AS e, domaine AS d , departement AS de WHERE m.id_etablissement=e.id_etablissement AND m.id_domaine=d.id_domaine AND m.id_departement=de.id_departement AND  m.id_domaine='$_POST[id_domaine]'")   ;
    $ree = $ge->fetch();

    $gee= $bdd->query("SELECT * FROM mention AS m INNER JOIN etablissement AS e, domaine AS d , departement AS de WHERE m.id_etablissement=e.id_etablissement AND m.id_domaine=d.id_domaine AND m.id_departement=de.id_departement AND  m.id_departement='$_POST[id_departement]'")   ;
    $reee = $gee->fetch();
}
if ( isset($_POST['modifier'])) {

    $bdd->exec('UPDATE mention SET libelle_mention = "'.$_POST['libelle_mention'].'",code_mention = "'.$_POST['code_mention'].'", id_etablissement = "'.$_POST['id_etablissement'].'",id_departement = "'.$_POST['id_departement'].'" ,id_domaine = "'.$_POST['id_domaine'].'" WHERE id_mention = "'.$_GET[id].'"')   ;
    ?>
    <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations modifiées avec succès .</span></div>
    <?php
    # code...
}

if (isset($_GET['id'])) {
    $g= $bdd->query("SELECT * FROM mention AS m INNER JOIN etablissement AS e, domaine AS d , departement AS de WHERE m.id_etablissement=e.id_etablissement AND m.id_domaine=d.id_domaine AND m.id_departement=de.id_departement AND  m.id_mention='$_GET[id]'")   ;
    $rep = $g->fetch();
}



//Suppression
if (isset($_POST['supprimer'])) {
    if (!empty($_POST["cocher"])) {
        foreach ($_POST["cocher"] as $c) {

            $bdd->exec("DELETE FROM mention WHERE id_mention = '$c'")   ;
        }
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations supprimées avec succès .</span></div>
        <?php
    }
}


?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <center><h3 class="m-0 font-weight-bold text-primary">Mention</h3></center>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="Groupe utilisateur">Etablissement</label>
                    <select class="form-control " name="id_etablissement">
                        <?php
                        $r = $bdd->query("
            SELECT * FROM etablissement ORDER BY  nom_etablissement ASC")   ;

                        while($d = $r->fetch())
                        {
                            if ($d['id_etablissement']==$rep['id_etablissement'] OR $d['id_etablissement']==$re['id_etablissement'] )
                            {
                                ?>
                                <option selected value="<?php echo $d['id_etablissement'];?>"> <?=$d['nom_etablissement']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option  value="<?php echo $d['id_etablissement'];?>"> <?=$d['nom_etablissement']?></option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="Groupe utilisateur">Domaine</label>
                    <select class="form-control " name="id_domaine">
                        <?php
                        $r = $bdd->query("
            SELECT * FROM domaine ORDER BY  libelle_domaine ASC")   ;

                        while($d = $r->fetch())
                        {
                            if ($d['id_domaine']==$rep['id_domaine'] OR $d['id_domaine']==$ree['id_domaine'] )
                            {
                                ?>
                                <option selected value="<?php echo $d['id_domaine'];?>"> <?=$d['libelle_domaine']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option  value="<?php echo $d['id_domaine'];?>"> <?=$d['libelle_domaine']?></option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="Groupe utilisateur">Département</label>
                    <select class="form-control " name="id_departement">
                        <?php
                        $r = $bdd->query("
            SELECT * FROM departement ORDER BY  nom_departement ASC")   ;

                        while($d = $r->fetch())
                        {
                            if ($d['id_departement']==$rep['id_departement'] OR $d['id_departement']==$reee['id_departement'])
                            {
                                ?>
                                <option selected value="<?php echo $d['id_departement'];?>"> <?=$d['nom_departement']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option  value="<?php echo $d['id_departement'];?>"> <?=$d['nom_departement']?></option>
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
                    <input type="text" class="form-control " id="identifiant"  name="identifiant" required="" autofocus="" value="<?php echo@ $rep['id_mention']?>" <?php if (isset($_GET['id'])){  echo "disabled";}?>>
                </div>
                <div class="form-group col-md-4 mr-4">
                    <label for="Libellé">Code mention</label>
                    <input type="text" class="form-control " id="code_mention"   name="code_mention" required="" value="<?php echo @$rep['code_mention']?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="Libellé">Libellé</label>
                    <input type="text" class="form-control " id="libelle_mention"   name="libelle_mention" required="" value="<?php echo @$rep['libelle_mention']?>">
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
                <a  class="btn btn-danger"  href="index.php?page=mention">Annuler</a>

                <?php

            } ?>
        </div>

    </div>
</div>













<?php

$gu = $bdd->query("SELECT * FROM mention AS m INNER JOIN etablissement AS e, domaine AS d , departement AS de WHERE m.id_etablissement=e.id_etablissement AND m.id_domaine=d.id_domaine AND m.id_departement=de.id_departement ORDER BY id_mention ASC ")   ;

?>
<form action="" method="POST">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des mentions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Libéllé</th>
                        <th>Code mention</th>
                        <th>Etablissement</th>
                        <th>Departement</th>
                        <th>Domaine</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Libéllé</th>
                        <th>Code mention</th>
                        <th>Etablissement</th>
                        <th>Departement</th>
                        <th>Domaine</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    while($res = $gu->fetch())
                    {
                        ?>
                        <tr>
                            <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $res['id_mention']; ?>"></td>
                            <td><a href="index.php?page=mention&id=<?php echo $res['id_mention'];?>"><?php echo $res['id_mention'];?></a></td>
                            <td><?php echo $res['libelle_mention'];?></td>
                            <td><?php echo $res['code_mention'];?></td>
                            <td><?php echo $res['nom_etablissement'];?></td>
                            <td><?php echo $res['nom_departement'];?></td>
                            <td><?php echo $res['libelle_domaine'];?></td>

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