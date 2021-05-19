<?php

function template_header()
{?>
    <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SYGE-SCO 2</title>

    <!-- Custom fonts for this template-->
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <script src="jquery/jquery.js"></script>
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-text mx-3">SYGE-SCO<sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBord" aria-expanded="true" aria-controls="collapseBord">
                <i class="fas fa-fw fa-cog"></i>
                <span>Tableau Administratif</span>
            </a>
            <div id="collapseBord" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="#">Constantes</a>
                    <a class="collapse-item" href="#">Tableau de bord pédagogique</a>
                    <a class="collapse-item" href="#">Tableau de bord Financier</a>
                    <a class="collapse-item" href="#">Historique</a>
                    <a class="collapse-item" href="#">Partenaires</a>
                </div>
            </div>
        </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBordPerso" aria-expanded="true" aria-controls="collapseBordPerso">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tableau Bord Personnel</span>
                </a>
                <div id="collapseBordPerso" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Constantes</a>
                        <a class="collapse-item" href="#">Tableau de bord pédagogique</a>
                        <a class="collapse-item" href="#">Tableau de bord Financier</a>
                        <a class="collapse-item" href="#">Historique</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEnse" aria-expanded="true" aria-controls="collapseEnse">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Enseignants</span>
                </a>
                <div id="collapseEnse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Enseignants</a>
                        <a class="collapse-item" href="#">Enseignants permanents</a>
                        <a class="collapse-item" href="#">Autorisation de dépassement de charge</a>
                        <a class="collapse-item" href="#">Historique</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMaket" aria-expanded="true" aria-controls="collapseMaket">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Maquettes pédagogique</span>
                </a>
                <div id="collapseMaket" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Gestion des troncs communs</a>
                        <a class="collapse-item" href="#">Gestion des UE</a>
                        <a class="collapse-item" href="#">Gestion des ECUE</a>
                        <a class="collapse-item" href="#">Mise a jour de maquette</a>
                        <a class="collapse-item" href="#">Copie contenue d'un semestre pour un parcours</a>
                        <a class="collapse-item" href="#">Recopier maquette autre année académique</a>
                        <a class="collapse-item" href="#">Affichage Maquette</a>
                    </div>
                </div>
            </li>



        <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnn" aria-expanded="true" aria-controls="collapseAnn">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Année académique</span>
                </a>
                <div id="collapseAnn" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Ouverture d'années</a>
                        <a class="collapse-item" href="#">Fermeture d'années</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEff" aria-expanded="true" aria-controls="collapseEff">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Effectifs et groupes</span>
                </a>
                <div id="collapseEff" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Enregistrement des effectifs</a>
                        <a class="collapse-item" href="#">Determination des groupes</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEns" aria-expanded="true" aria-controls="collapseEns">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Enseignements</span>
                </a>
                <div id="collapseEns" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Saisie d'un enseignement dispensé</a>
                        <a class="collapse-item" href="#">Saisie de mes enseignements</a>
                        <a class="collapse-item" href="#">Historique de mes enseignements dispensé</a>
                        <a class="collapse-item" href="#">Historique des séances d'enseignement</a>
                        <a class="collapse-item" href="#">Historique des séances des enseignants</a>
                        <a class="collapse-item" href="#">Validation des enseignements dispensé</a>
                        <a class="collapse-item" href="index.php?page=textbook">Consultation et édition d'un cahier de texte</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsultation" aria-expanded="true" aria-controls="collapseConsultation">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Scolarite</span>
                </a>
                <div id="collapseConsultation" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=pv_disponible">Liste Pv Disponible</a>
                        <a class="collapse-item" href="index.php?page=pv_semestriel">Pv Semestriel</a>
                        <a class="collapse-item" href="index.php?page=pv_annuel">Pv Annuel</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSous" aria-expanded="true" aria-controls="collapseSous">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Soutenances</span>
                </a>
                <div id="collapseSous" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Soutenance</a>
                        <a class="collapse-item" href="#">Soutenance effectuées</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePed" aria-expanded="true" aria-controls="collapsePed">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Etats pédagogiques</span>
                </a>
                <div id="collapsePed" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Liste des charges horaires attribuées</a>
                        <a class="collapse-item" href="#">Liste des charges horaires realisées</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFin" aria-expanded="true" aria-controls="collapseFin">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Etats financiers</span>
                </a>
                <div id="collapseFin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Liste prévisionnelle des heures complementaires</a>
                        <a class="collapse-item" href="#">Etat des HC realisé</a>
                        <a class="collapse-item" href="#">Tableau de paiement des HC realisé</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStruc" aria-expanded="true" aria-controls="collapseStruc">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Parametre de structure</span>
                </a>
                <div id="collapseStruc" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Gestion de domaine</a>
                        <a class="collapse-item" href="#">Gestion de mention</a>
                        <a class="collapse-item" href="#">Parcours</a>
                        <a class="collapse-item" href="#">Gestion des salles</a>
                        <a class="collapse-item" href="#">Structure associée</a>
                        <a class="collapse-item" href="#">Définition du nombre d'étudiant par groupe</a>
                    </div>
                </div>
            </li>
            <?php

            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsultation" aria-expanded="true" aria-controls="collapseConsultation">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Scolarite</span>
                </a>
                <div id="collapseConsultation" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=pv_disponible">Liste Pv Disponible</a>
                        <a class="collapse-item" href="index.php?page=pv_semestriel">Pv Semestriel</a>
                        <a class="collapse-item" href="index.php?page=pv_annuel">Pv Annuel</a>
                    </div>
                </div>



            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Parametre generaux</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?page=anne_aca">Annee academique</a>
                        <a class="collapse-item" href="index.php?page=como">Commodite</a>
                        <a class="collapse-item" href="index.php?page=const">Constante</a>
                        <a class="collapse-item" href="index.php?page=etat">Etat</a>
                        <a class="collapse-item" href="index.php?page=form_ens">Forme enseignement</a>
                        <a class="collapse-item" href="index.php?page=act">Action</a>
                        <a class="collapse-item" href="index.php?page=labo">Laboratoire</a>
                        <a class="collapse-item" href="index.php?page=sem">Semestre</a>
                        <a class="collapse-item" href="index.php?page=etablissement">Etablissement</a>
                        <a class="collapse-item" href="index.php?page=specialite">Parcours</a>
                        <a class="collapse-item" href="index.php?page=mention">Mention</a>
                        <a class="collapse-item" href="index.php?page=suppaudit">Suppression Audit</a>
                        <a class="collapse-item" href="index.php?page=group_util">Groupe utilisateur</a>
                        <a class="collapse-item" href="index.php?page=type_util">Type utilisateur</a>
                        <a class="collapse-item" href="index.php?page=niveau_acces">Niveau d'acces</a>
                        <a class="collapse-item" href="index.php?page=type_etablissement">Type etablissement</a>
                        <a class="collapse-item" href="index.php?page=enseignant">Enseignants</a>
                        <a class="collapse-item" href="index.php?page=personnel">Personnels</a>
                        <a class="collapse-item" href="index.php?page=type_formulaire">Type Formulaire</a>
                        <a class="collapse-item" href="index.php?page=domaine">Domaine</a>
                        <a class="collapse-item" href="index.php?page=type_inscription">Type inscription</a>
                        <a class="collapse-item" href="index.php?page=nationalite">Nationalite</a>
                        <a class="collapse-item" href="index.php?page=pays">Pays</a>
                        <a class="collapse-item" href="index.php?page=deliberation">Délibération</a>
                        <a class="collapse-item" href="index.php?page=disponibilite">Disponibilité</a>
                        <a class="collapse-item" href="index.php?page=batiment">Batiment</a>
                        <a class="collapse-item" href="index.php?page=type_salle">Type salle</a>
                        <a class="collapse-item" href="index.php?page=type_piece">Type piece</a>
                        <a class="collapse-item" href="index.php?page=type_jure">Type jure</a>
                        <a class="collapse-item" href="index.php?page=niveau">Niveau</a>
                        <a class="collapse-item" href="index.php?page=type_enseignement">Type enseignement</a>
                        <a class="collapse-item" href="index.php?page=tronc_commun">Tronc commun</a>
                        <a class="collapse-item" href="index.php?page=type_diplome">Type diplome</a>
                        <a class="collapse-item" href="index.php?page=statut">Statut</a>
                        <a class="collapse-item" href="index.php?page=specialite_labo">Specialite labo</a>
                        <a class="collapse-item" href="index.php?page=qualite_utilisateur">Qualite utilisateur</a>
                    </div>
                </div>



            </li>


        <!-- Nav Item - Dashboard -->


        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <?php
        }

        function top_bar($nom_utilisateur,$prenom_utilisateur,$nom_etablissement,$nom_departement){
            ?>
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <br>
                <div class="col-md-5">
                    <p class="mb-3"><h6 class="text-uppercase">NOM ET PRENOMS
                        : <?= $nom_utilisateur . ' ' . $prenom_utilisateur?></h6></p>
                    <?php

                    ?>
                    <p class="mb-3"><h6 class="text-uppercase">UFR : <?php echo @$nom_etablissement ?></h6></p>
                </div>

                <div class="col-md-5">
                    <p class="mb-5"> <h6 class="text-uppercase">UNITE DE FORMATION : <?php echo @$nom_departement ?></h6></p>

                </div>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item  no-arrow">
                        <a class="nav-link" href="logout.php">
                            <span class="mr-2 d-none d-lg-inline text-primary font-weight-bold text-uppercase small">Deconnexion</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <?php
        }

        function template_footer() {
        ?>
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; SYGE-SCO</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->

<script src="perso/ajax/js/parcours.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>


<!-- Page level plugins -->
<script src="datatables/jquery.dataTables.min.js"></script>
<script src="datatables/dataTables.bootstrap4.min.js"></script>
<script src="datatable_french.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script src="consultation/pvsem.js"></script>
<script src="consultation/pvannuel.js"></script>
<script src="consultation/information.js"></script>

<!-- sil demande autocomplete
  <script src="perso/ajax/js/etudiantAuto.js"></script>
   <script src="perso/ajax/js/rempEtudiant.js"></script>
 -->

<!-- sil demande remplissage auto des champs apres saisie de la carte etudiant

 -->




</body>

</html>
<?php
}
?>

