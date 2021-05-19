<?php
// Nouvel enregistrement
if (isset($_POST['enregistrer']))
{


    $gu = $bdd->query('SELECT * FROM specialite WHERE libelle_specialite="'.$_POST['libelle_specialite'].'" OR id_specialite="'.$_POST['identifiant'].'" ')   ;
    if ($res = $gu->fetch())
    {
        ?>
        <div><span id="" class="form-text text-warning font-weight-bold"><i class="fas fa-ban fa-md fa-fw mr-2"></i>Information(s) existante(s) .</span></div>
        <?php
    }
    else
    {
        $identifiant = $_POST['identifiant'];
        $libelle = $_POST['libelle_specialite'];
        $code = $_POST['code_specialite'];
        $mention = $_POST['id_mention'];
        $departement = $_POST['id_departement'];
        $troncCommun = $_POST['id_tronc_commun'];
        $statutSpecialite = $_POST['id_statut_specialite'];
        $codeOrigine = $_POST['code_origine_specialite'];

        $bdd->query("INSERT INTO specialite (
                        id_specialite, 
                        libelle_specialite, 
                        code_specialite,
                        id_mention,
                        id_departement,
                        id_tronc_commun,
                        id_statut_specialite,
                        code_origine_specialite
                        ) VALUES (
                                  '$identifiant',
                                  '$libelle',
                                  '$code',
                                  '$mention',
                                  '$departement',
                                  '$troncCommun',
                                  '$statutSpecialite',
                                  '$codeOrigine'
                        )");
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-check-square fa-md fa-fw mr-2"></i>Informations enrégistrées avec succès .</span></div>
        <?php
    }


    $g= $bdd->query("SELECT * FROM specialite AS s INNER JOIN mention AS m , statut_specialite AS ss WHERE s.id_mention=m.id_mention AND s.id_statut_specialite=ss.id_statut_specialite AND  s.id_mention='$_POST[id_mention]'")   ;
    $re = $g->fetch();

    $ge= $bdd->query("SELECT * FROM specialite AS s INNER JOIN mention AS m , statut_specialite AS ss WHERE s.id_mention=m.id_mention AND s.id_statut_specialite=ss.id_statut_specialite AND  s.id_statut_specialite='$_POST[id_statut_specialite]'")   ;
    $ree = $ge->fetch();
}

// Cas de mise à jour
if ( isset($_POST['modifier'])) {

    $bdd->exec('UPDATE specialite SET libelle_specialite = "'.$_POST['libelle_specialite'].'",code_specialite = "'.$_POST['code_specialite'].'", id_mention = "'.$_POST['id_mention'].'",id_statut_specialite = "'.$_POST['id_statut_specialite'].'" WHERE id_specialite = "'.$_GET[id].'"')   ;
    ?>
    <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations modifiées avec succès .</span></div>
    <?php
    # code...
}

if (isset($_GET['id'])) {
    $g= $bdd->query("SELECT * FROM specialite AS s INNER JOIN mention AS m , statut_specialite AS ss WHERE s.id_mention=m.id_mention AND s.id_statut_specialite=ss.id_statut_specialite AND  s.id_specialite='$_GET[id]'")   ;
    $rep = $g->fetch();
}

// Suppression
if (isset($_POST['supprimer'])) {
    if (!empty($_POST["cocher"])) {
        foreach ($_POST["cocher"] as $c) {

            $bdd->exec("DELETE FROM specialite WHERE id_specialite = '$c'")   ;
        }
        ?>
        <div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations supprimées avec succès .</span></div>
        <?php
    }
}


?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Parcours</h3>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-row" id="select-box">
                <div class="form-group col-md-4">
                    <label for="Identifiant">Identifiant</label>
                    <input type="text" class="form-control " id="identifiant"  name="identifiant" required="" autofocus="" value="<?php echo@ $rep['id_specialite']?>" <?php if (isset($_GET['id'])){  echo "disabled";}?>>
                </div>
                <div class="form-group col-md-4">
                    <label for="Libellé">Libellé</label>
                    <input type="text" class="form-control " id="libelle_specialite"   name="libelle_specialite" required="" value="<?php echo @$rep['libelle_specialite']?>">
                </div>
                <div class="form-group col-md-4">
                    <label for="Libellé">Code specialite</label>
                    <input type="text" class="form-control " id="code_specialite"   name="code_specialite" required="" value="<?php echo @$rep['code_specialite']?>">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="Groupe utilisateur">Mention</label>
                    <select class="form-control " name="id_mention" id="id_mention" onchange="">
                        <?php
                        $r = $bdd->query("SELECT * FROM mention ORDER BY  libelle_mention ASC")   ;

                        while($d = $r->fetch())
                        {
                            if ($d['id_mention']==$rep['id_mention'] OR $d['id_mention']==$re['id_mention'] )
                            {
                                ?>
                                <option selected value="<?php echo $d['id_mention'];?>"> <?=$d['libelle_mention']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option  value="<?php echo $d['id_mention'];?>"> <?=$d['libelle_mention']?></option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Departement</label>
                    <select class="form-control " name="id_departement" id="id_departement">
                        <?php
                            $query = $bdd->query("SELECT id_departement, nom_departement FROM departement WHERE 1")   ;

                            while($response = $query->fetch())
                            {
                                ?>
                                <option value="<?= $response['id_departement'];?>" ><?= $response['nom_departement']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Tronc Commun</label>
                    <select class="form-control " name="id_tronc_commun" id="id_tronc_commun">
                        <?php
                        $queryTronc = $bdd->query("SELECT id_tronc_commun, libelle_tronc_commun FROM tronc_commun WHERE 1")   ;

                        while($responseTronc = $queryTronc->fetch())
                        {
                            ?>
                            <option value="<?= $responseTronc['id_tronc_commun'];?>" ><?= $responseTronc['libelle_tronc_commun']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="Groupe utilisateur">Statut Specialite</label>
                    <select class="form-control " name="id_statut_specialite">
                        <?php
                        $r = $bdd->query("SELECT * FROM statut_specialite ORDER BY  libelle_statut_specialite ASC")   ;

                        while($d = $r->fetch())
                        {
                            if ($d['id_statut_specialite']==$rep['id_statut_specialite'] OR $d['id_statut_specialite']==$ree['id_statut_specialite'] )
                            {
                                ?>
                                <option selected value="<?php echo $d['id_statut_specialite'];?>"> <?=$d['libelle_statut_specialite']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option  value="<?php echo $d['id_statut_specialite'];?>"> <?=$d['libelle_statut_specialite']?></option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="Groupe utilisateur">Code Origine Spécialité</label>
                    <select class="form-control " name="code_origine_specialite">
                        <?php
                        $querySpecialite = $bdd->query("SELECT DISTINCT id_specialite, code_specialite FROM specialite ORDER BY id_specialite")   ;

                        while($responseSpecialite = $querySpecialite->fetch())
                        {
                            ?>
                            <option value="<?= $responseSpecialite['id_specialite'];?>" ><?= $responseSpecialite['code_specialite']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
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
                <a  class="btn btn-danger"  href="index.php?page=specialite">Annuler</a>

                <?php

            } ?>
        </div>

    </div>
</div>













<?php

$gu = $bdd->query("SELECT * FROM specialite AS m INNER JOIN mention AS e , statut_specialite AS de WHERE m.id_mention=e.id_mention AND m.id_statut_specialite=de.id_statut_specialite ORDER BY id_specialite ASC ")   ;

?>
<form action="" method="POST">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des parcours</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Mention</th>
                        <th>Statut Specialite</th>
                        <th>Code specialite</th>
                        <th>Libéllé</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Mention</th>
                        <th>Statut Specialite</th>
                        <th>Code specialite</th>
                        <th>Libéllé</th>

                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    while($res = $gu->fetch())
                    {
                        ?>
                        <tr>
                            <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $res['id_specialite']; ?>"></td>
                            <td><a href="index.php?page=specialite&id=<?php echo $res['id_specialite'];?>"><?php echo $res['id_specialite'];?></a></td>
                            <td><?php echo $res['libelle_mention'];?></td>
                            <td><?php echo $res['libelle_statut_specialite'];?></td>
                            <td><?php echo $res['code_specialite'];?></td>
                            <td><?php echo $res['libelle_specialite'];?></td>




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