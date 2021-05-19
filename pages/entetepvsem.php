<?php
session_start();
require "config/connexion.php";
require "fonction.php";

$parcours = fetchParcours();
$etablissements = fetchETB();
$departements = fetchDEPARTEMENT();
$mentions = fetchMENTION();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* pour récuperer les valeurs $_POST */
    extract($_POST);

    /* récuperer l'info sur l'etablissement */
    $info = infoETB($id_etablissement);

    /* récuperer l'info sur le parcours */
    $nom_p = fetchParcours($id_parcours);

    /* récuperer info sur la mention */
    $nom_m = fetchOneMENTION($id_mention);

    /* récuperer info etablissement */
    $nom_d = fetchOneDEPARTEMENT($id_departement);


    $_SESSION['imprimer'] = [
        'id_etablissement' => $id_etablissement,
        'id_departement' => $id_departement,
        'id_parcours' => $id_parcours,
        'id_mention' => $id_mention,
        'id_session' => 1,
        'id_semestre' => $id_semestre,
        'niveau' => $niveau,
        'annee' => $annee,
        'logo_etablissement' => $info['logo_etablissement'],
        'nom_parcours' => $nom_p[0]['libelle_specialite'],
        'nom_ufr' => $info['nom_etablissement'],
        'nom_departement' => $nom_d['nom_departement'],
        'nom_mention' => $nom_m['libelle_mention'],
        'code_parcours' => $nom_p[0]['code_origine_specialite']
    ];


    header('location:documents/pvsem.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PV SEMESTRIELLE</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include "include/sidebar.php"; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include "include/topbar.php"; ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <div class="card shadow mb-2">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Proces verbal semestrielle</h6>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="d-flex">

                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Année académique</label>
                                    <select class="form-control" name="annee">
                                        <option value="21918" <?php if (isset($annee) && $annee === '21918') echo 'selected'; ?>>
                                            2018 - 2019
                                        </option>
                                        <option value="21817" <?php if (isset($annee) && $annee === '21817') echo 'selected'; ?>>
                                            2017 - 2018
                                        </option>
                                    </select>
                                </div>

                                <div class="col-8">
                                    <label for="exampleFormControlSelect1">Etablissements</label>
                                    <select class="form-control" name="id_etablissement" id="id_etablissement">
                                        <?php foreach ($etablissements as $p): ?>
                                            <option value="<?php echo $p['id_etablissement'] ?>"
                                                <?php if (isset($id_etablissement) && $id_etablissement === $p['id_etablissement']) echo 'selected'; ?>
                                            ><?php echo $p['nom_etablissement'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                            </div>
                            <div class="d-flex">

                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Départements</label>
                                    <select class="form-control" name="id_departement" id="id_departement">
                                        <option value="0">selectionner</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Parcours</label>
                                    <select class="form-control" name="id_parcours" id="id_parcours">
                                        <option value="0">parcours</option>
                                    </select>
                                </div>


                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Mention</label>
                                    <select class="form-control" name="id_mention" id="id_mention">
                                        <?php foreach ($mentions as $p): ?>
                                            <option value="<?php echo $p['id_mention'] ?>"
                                                <?php if (isset($id_mention) && $id_mention === $p['id_mention']) echo 'selected'; ?>
                                            ><?php echo $p['libelle_mention'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                            </div>
                            <div class="d-flex">

                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Niveau</label>
                                    <select class="form-control" name="niveau" id="id_niveau">
                                        <option value="1" <?php if (isset($niveau) && $niveau === '1') echo 'selected'; ?>>
                                            Licence 1
                                        </option>
                                        <option value="2" <?php if (isset($niveau) && $niveau === '2') echo 'selected'; ?>>
                                            Licence 2
                                        </option>
                                        <option value="3" <?php if (isset($niveau) && $niveau === '3') echo 'selected'; ?>>
                                            Licence 3
                                        </option>
                                        <option value="4" <?php if (isset($niveau) && $niveau === '4') echo 'selected'; ?>>
                                            Master 1
                                        </option>
                                        <option value="5" <?php if (isset($niveau) && $niveau === '5') echo 'selected'; ?>>
                                            Master 2
                                        </option>
                                        <option value="FIP 1" <?php if (isset($niveau) && $niveau === 'FIP 1') echo 'selected'; ?>>
                                            FIP 1
                                        </option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Semestre</label>
                                    <select class="form-control" name="id_semestre" id="id_semestre">
                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                            <option value="<?= $i; ?>" <?php if (isset($semestre) && $semestre === $i) echo 'selected'; ?>>
                                                Semestre <?= $i ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>


                            </div>
                            <div class="float-right mt-2 pr-2">
                                <button class="btn btn-primary" type="submit">valider</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include "include/footer.php"; ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


<script>
    $("#id_etablissement").on("change", function () {
        var id_etablissement = $(this).val();
        $.ajax({
            url: "fetch/fetch_departement.php",
            method: 'GET',
            data: {id_etablissement: id_etablissement},
            success: function (data) {
                $("#id_departement").html(data);

                var id_departement = $("#id_departement").val();
                $.ajax({
                    url: "fetch/fetch_parcours.php",
                    method: 'GET',
                    data: {id_departement: id_departement},
                    success: function (data) {
                        $("#id_parcours").html(data);
                    }
                });


            }
        });
    }).trigger("change");


    $("#id_departement").on("change", function () {
        var id_departement = $(this).val();
        $.ajax({
            url: "fetch/fetch_parcours.php",
            method: 'GET',
            data: {id_departement: id_departement},
            success: function (data) {
                $("#id_parcours").html(data);
            }
        });
    });


    $("#id_parcours").on("change", function () {
        var id_parcours = $(this).val();
        $.ajax({
            url: "fetch/fetch_mention.php",
            method: 'GET',
            data: {id_parcours: id_parcours},
            success: function (data) {
                $("#id_mention").html(data);
            }
        });
    });


</script>

</body>

</html>
