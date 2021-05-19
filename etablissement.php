<?php
if (isset($_POST['enregistrer']))
{


    $gu = $bdd->query('SELECT * FROM etablissement WHERE nom_etablissement="'.$_POST['nom_etablissement'].'" OR id_etablissement="'.$_POST['identifiant'].'" ')   ;
    if ($res = $gu->fetch())
    {
        ?>
        <div><span id="" class="form-text text-warning font-weight-bold"><i class="fas fa-ban fa-md fa-fw mr-2"></i>Information(s) existante(s) .</span></div>
        <?php
    }
    else
    {
        //declaring variables
        $filename = $_FILES['logo_etablissement']['name'];

        $filetmpname = $_FILES['logo_etablissement']['tmp_name'];

        $folder = 'images/logo/';

        move_uploaded_file($filetmpname, $folder.$filename);

        $id_etablissement = $_POST['identifiant'];
        $nomEtablissement = $_POST['nom_etablissement'];
        $codeEtablissement = $_POST['code_etablissement'];
        $logoEtablissement = $filename;
        $domaineEtabissement = $_POST['domaine_etablissement'];
        $affichage = $_POST['afficher'];
        $idTypeEtablissement = $_POST['id_type_etablissement'];
        $salleDeCours = $_POST['salle'];
        $groupeEcoleDoctorale = $_POST['groupeEcoleDoctorale'];
        $codeOrigineEtablissement = $_POST['codeEtablissement'];
        $bdd->query("INSERT INTO etablissement(
                          id_etablissement,
                          nom_etablissement,
                          code_etablissement,
                          logo_etablissement,
                          domaine_etablissement,
                          afficher,
                          id_type_etablissement,
                          salle_de_cours,
                          id_groupe_ecole_doc,
                          code_origine_etablissement
                          ) VALUES(
                                   '$id_etablissement',
                                   '$nomEtablissement',
                                   '$codeEtablissement',
                                   '$logoEtablissement',
                                   '$domaineEtabissement',
                                   '$affichage',
                                   '$idTypeEtablissement',
                                   '$salleDeCours',
                                   '$groupeEcoleDoctorale',
                                   '$codeOrigineEtablissement')");
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-check-square fa-md fa-fw mr-2"></i>Informations enrégistrées avec succès .</span></div>
        <?php
    }

    $g= $bdd->query("SELECT * FROM etablissement AS t INNER JOIN type_etablissement AS g INNER JOIN domaine AS d WHERE t.id_type_etablissement=g.id_type_etablissement AND t.domaine_etablissement = d.id_domaine AND t.id_type_etablissement='$_POST[id_type_etablissement]'")   ;
    $re= $g->fetch();


}

if ( isset($_POST['modifier'])) {
    //declaring variables
    $filename = $_FILES['logo_etablissement']['name'];
    $filetmpname = $_FILES['logo_etablissement']['tmp_name'];
    $folder = 'images/logo/';
    move_uploaded_file($filetmpname, $folder.$filename);
    $bdd->exec('UPDATE etablissement SET nom_etablissement = "'.$_POST['nom_etablissement'].'",code_etablissement = "'.$_POST['code_etablissement'].'",logo_etablissement = "'.$filename.'",domaine_etablissement = "'.$_POST['domaine_etablissement'].'",afficher = "'.$_POST['afficher'].'",salle_de_cours = "'.$_POST['salle'].'",id_type_etablissement = "'.$_POST['id_type_etablissement'].'" WHERE id_etablissement = "'.$_GET[id].'"')   ;
    ?>
    <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations modifiées avec succès .</span></div>
    <?php
    # code...
}

if (isset($_GET['id'])) {
    $g= $bdd->query("SELECT * FROM etablissement AS t INNER JOIN type_etablissement AS g INNER JOIN domaine AS d WHERE t.id_type_etablissement=g.id_type_etablissement AND t.domaine_etablissement = d.id_domaine AND t.id_etablissement='$_GET[id]'")   ;
    $rep = $g->fetch();
}


//Suppression
if (isset($_POST['supprimer'])) {
    if (!empty($_POST["cocher"])) {
        foreach ($_POST["cocher"] as $c) {

            $bdd->exec("DELETE FROM etablissement WHERE id_etablissement = '$c'")   ;
        }
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Information(s) supprimée(s) avec succès .</span></div>
        <?php
    }
}

?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <center><h3 class="m-0 font-weight-bold text-primary">Etablissement</h3></center>
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-4 ">
                    <label for="Identifiant">Identifiant</label>
                    <input type="text" class="form-control " id="identifiant"  name="identifiant" required="" autofocus="" value="<?php echo@ $rep['id_etablissement']?>" <?php if (isset($_GET['id'])){  echo "disabled";}?>>
                </div>
                <div class="form-group col-md-4">
                    <label>Type Etablissement</label>
                    <select class="form-control " name="id_type_etablissement">
                        <?php
                        $r = $bdd->query("SELECT * FROM type_etablissement ORDER BY libelle_type_etablissement ASC")   ;

                        while($d = $r->fetch())
                        {
                            if ($d['id_type_etablissement']==$rep['id_type_etablissement'] OR $d['id_type_etablissement']==$re['id_type_etablissement'])
                            {
                                ?>
                                <option selected value="<?php echo $d['id_type_etablissement'];?>"> <?=$d['libelle_type_etablissement']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option value="<?php echo $d['id_type_etablissement'];?>" > <?php echo $d['libelle_type_etablissement'];?> </option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="domaine">Domaine Etablissement</label>
                    <select class="form-control " name="domaine_etablissement">
                        <?php
                        $rd = $bdd->query("SELECT * FROM domaine ORDER BY id_domaine ASC")   ;

                        while($dr = $rd->fetch())
                        {
                            if ($dr['id_domaine']==$rep['domaine_etablissement'])
                            {
                                ?>
                                <option selected value="<?php echo $dr['id_domaine'];?>"> <?=$dr['libelle_domaine']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option value="<?php echo $dr['id_domaine'];?>" > <?php echo $dr['libelle_domaine'];?> </option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="Libellé">Nom Etablissement</label>
                    <input type="text" class="form-control " id="nom_etablissement"   name="nom_etablissement" required="" value="<?php echo @$rep['nom_etablissement']?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="Libellé">Code Etablissement</label>
                    <input type="text" class="form-control " id="code_etablissement"   name="code_etablissement" required="" value="<?php echo @$rep['code_etablissement']?>">
                </div>
                <!--      Groupe Ecole Doctoral      -->
                <div class="form-group col-md-4">
                    <label for="afficher">Groupe Ecole Doctorale</label>
                    <select class="form-control" name="groupeEcoleDoctorale" id="groupeEcoleDoctorale">
                        <?php
                        $response = $bdd->query("SELECT id_groupe_ecole_doc, libelle_groupe_ecole_doc FROM groupe_ecole_doctorale WHERE 1");
                        while ($result = $response->fetch()){
                            ?>
                            <option value="<?= $result['id_groupe_ecole_doc'];?>"><?= $result['libelle_groupe_ecole_doc'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="afficher">Salle de cours</label>
                    <select class="form-control" name="salle" id="salle">
                        <?php
                        if (isset($_GET['id'])){
                            ?>
                            <option value="<?= $rep['salle_de_cours']?>" selected><?= $rep['salle_de_cours'] ?></option>
                            <option value="OUI">OUI</option>
                            <option value="NON">NON</option>
                            <?php
                        }
                        else{
                            ?>
                            <option value="OUI">OUI</option>
                            <option value="NON">NON</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="afficher">Afficher</label>
                    <select class="form-control" name="afficher" id="afficher">
                        <?php
                        if (isset($_GET['id'])){
                            ?>
                            <option value="<?= $rep['afficher']?>" selected><?= $rep['afficher'] ?></option>
                            <option value="OUI">OUI</option>
                            <option value="NON">NON</option>
                            <?php
                        }
                        else{
                            ?>
                            <option value="OUI">OUI</option>
                            <option value="NON">NON</option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="domaine">Code Etablissement d'Origine</label>
                    <select class="form-control " name="codeEtablissement">
                        <?php
                        $qCode = $bdd->query("SELECT DISTINCT code_etablissement FROM etablissement ORDER BY code_etablissement ASC")   ;

                        while($rCode = $qCode->fetch())
                        {
                            ?>
                                <option value="<?= $rCode['code_etablissement'];?>"> <?=$rCode['code_etablissement']?></option>
                            <?php
                        }
                            ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="logo">Logo Etablissement</label>
                    <input type="file" class="form-control-file" id="logo" name="logo_etablissement" value="<?php echo @$rep['logo_etablissement']?>">
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
                <a  class="btn btn-danger"  href="index.php?page=etablissement">Annuler</a>

                <?php

            } ?>
        </div>

    </div>
</div>


<?php

$gu = $bdd->query("SELECT * FROM etablissement AS t INNER JOIN type_etablissement AS g INNER JOIN domaine AS d WHERE t.id_type_etablissement=g.id_type_etablissement AND t.domaine_etablissement = d.id_domaine ORDER BY id_etablissement ASC ")   ;

?>

<form action="" method="POST">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Etablissements</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Type Etablissement</th>
                        <th>Code</th>
                        <th>Nom </th>
                        <th>Domaine</th>
                        <th>Afficher</th>
                        <th>Salle de cours</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Type Etablissement</th>
                        <th>Code</th>
                        <th>Nom </th>
                        <th>Domaine</th>
                        <th>Afficher</th>
                        <th>Salle de cours</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    while($res = $gu->fetch())
                    {
                        ?>
                        <tr>
                            <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $res['id_etablissement']; ?>"></td>
                            <td><a href="index.php?page=etablissement&id=<?php echo $res['id_etablissement'];?>"><?php echo $res['id_etablissement'];?></a></td>
                            <td><?php echo $res['libelle_type_etablissement'];?></td>
                            <td><?php echo $res['code_etablissement'];?></td>
                            <td><?php echo $res['nom_etablissement'];?></td>
                            <td><?php echo $res['libelle_domaine'];?></td>
                            <td><?php echo $res['afficher'];?></td>
                            <td><?php echo $res['salle_de_cours'];?></td>
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