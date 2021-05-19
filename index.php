<?php
error_reporting(0);
session_start();

setlocale(LC_TIME, 'french.UTF-8', 'fr_FR.UTF-8');
include "function.php";
require 'config/connexion.php';
if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] === "") {
    header("Location:connexion.php");
}else{

    $info = $bdd->query('select * from utilisateur where id_utilisateur ="' . $_SESSION['connecte'] . '" ');
    $information = $info->fetch();
    $nom_etablissement = $bdd->query("SELECT nom_etablissement FROM etablissement WHERE id_etablissement = '" . $_SESSION['id_etablissement'] . "'")->fetchColumn();
    $nom_departement = $bdd->query("SELECT nom_departement FROM departement WHERE id_departement = '" . $_SESSION['id_departement_grand'] . "'")->fetchColumn();

}
if(!isset($_SESSION['id_annee_academique']))
{
    $annee_en_cours=$bdd->query("select * from annee_academique ORDER BY id_annee_academique DESC LIMIT 1 ");
    $annee_en_cours = $annee_en_cours ->fetch();
    $_SESSION['id_annee_academique']=$annee_en_cours['id_annee_academique'];
}

//Gestion des tarifs
if(isset($_POST['choisir_annee']))
{
    extract($_POST);
    $_SESSION['id_annee_academique']=$annee;
}
$annee_en_cours=$bdd->query("select * from annee_academique WHERE id_annee_academique='".$_SESSION['id_annee_academique']."'");
$annee_en_cours = $annee_en_cours ->fetch();
?>

<!-- header -->
<?= template_header() ?>
<!-- Main Content -->
<div id="content">

    <!-- Top bar -->
    <?=top_bar($information['nom_utilisateur'],$information['prenom_utilisateur'],$nom_etablissement,$nom_departement)?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <form action="" method="POST">
            <div align="right">
                <h1 class="h6 mb-0 text-gray-800 text-right mr-4">ANNEE ACADEMIQUE</h1>
                <div class="mb-2 mr-4">
                    <select class=" form-control col-2 text-center" name="annee" >
                        <?php
                        $req=$bdd->query('SELECT * FROM annee_academique');
                        while ($rep=$req->fetch())
                        {
                            if ($annee_en_cours['id_annee_academique']==$rep['id_annee_academique'])
                            {
                                ?>
                                <option selected value="<?=$rep['id_annee_academique']?>"> <?=$rep['libelle_annee_academique']?></option>
                                <?php

                            }
                            else
                            {

                                ?>
                                <option value="<?=$rep['id_annee_academique']?>"> <?=$rep['libelle_annee_academique']?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <button class="btn btn-primary btn-sm" type="submit"  name="choisir_annee"> Choisir une année académique </button>
            </div>
        </form>
        <br>
        <div class="row">


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a href="index.php"> NOMBRES DE DEMANDES EN ATTENTE</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="?query=NOMBRE_DE_DEMANDES_ACCEPTEES">NOMBRES DE DEMANDE ACCEPTEES</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="?query=NOMBRE_DE_DEMANDES_REFUSEE">DEMANDES REFUSEES</a></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-1">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">TOTAL DEMANDES</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="container-fluid">

        <?php
        if (isset($_GET['page']))
        {
            switch ($_GET['page']) {
                case 'group_util':
                    include 'group_util.php';
                    break;
                case'anne_aca': include "anne_academique.php";
                    break;
                case'como': include "commodite.php";
                    break;
                case'const': include "constante.php";
                    break;
                case'etat': include "etat.php";
                    break;
                case'form_ens': include "forme_enseignement.php";
                    break;
                case'act': include "action.php";
                    break;
                case'labo': include "laboratoire.php";
                    break;
                case'sem':
                    include "semestre.php";
                    break;
                case 'etablissement':
                    include 'etablissement.php';
                    break;

                case 'specialite':
                    include 'specialite.php';
                    break;

                case 'mention':
                    include 'mention.php';
                    break;

                case 'suppaudit':
                    include 'suppaudit.php';
                    break;

                case 'type_util':
                    include 'type_util.php';
                    break;

                case 'niveau_acces':

                    include 'niveau_acces.php';

                    break;
                case 'type_formulaire':

                    include 'type_formulaire.php';

                    break;
                case 'pays':

                    include 'pays.php';

                    break;

                case 'deliberation':

                    include 'deliberation.php';

                    break;

                case 'type_etablissement':

                    include 'type_etablissement.php';

                    break;

                case 'domaine':

                    include 'domaine.php';

                    break;
                case 'disponibilite':

                    include 'disponibilite.php';

                    break;
                case 'batiment':

                    include 'batiment.php';

                    break;
                case 'type_salle':

                    include 'type_salle.php';

                    break;
                case 'type_jure':

                    include 'type_jure.php';

                    break;

                case 'type_enseignement':
                    include 'type_enseignement.php';
                    break;

                case 'enseignant':
                    include 'enseignant.php';
                    break;

                case 'textbook':
                    include 'textbook.php';
                    break;

                case 'personnel':
                    include 'personnel.php';
                    break;

                case 'tronc_commun':

                    include 'tronc_commun.php';

                    break;
                case 'type_diplome':

                    include 'type_diplome.php';

                    break;
                case 'statut':

                    include 'statut.php';

                    break;
                case 'specialite_labo':

                    include 'specialite_labo.php';

                    break;
                case 'qualite_utilisateur':

                    include 'qualite_utilisateur.php';

                    break;
                case 'niveau':

                    include 'niveau.php';

                    break;
                case 'nationalite':

                    include 'nationalite.php';

                    break;
                case 'test':

                    include 'test.php';

                    break;

                case 'type_piece':

                    include 'type_piece.php';

                    break;
                case 'type_inscription':

                    include 'type_inscription.php';

                    break;




                case 'autouf':

                    include 'autoristion_uf.php';

                    break;

                case 'autoufr':

                    include 'autorisation_ufr.php';

                    break;

                case 'autosco':

                    include 'autorisation_scolarite.php';

                    break;
                case 'pv_disponible':
                    include 'liste_pv_disponible.php';
                    break;

                case 'pv_semestriel':
                    include 'pv_semestriel.php';
                    break;
                case 'pv_annuel':
                    include 'pv_annuel.php';
                    break;



                default:
                    # code...
                    break;
            }
        }


        ?>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?=template_footer()?>
<!-- footer -->


