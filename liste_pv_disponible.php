<?php
$SQL = "SELECT DISTINCT etablissement.id_etablissement , departement.id_departement , specialite.id_specialite , pv_annuel.id_niveau , niveau.libelle_niveau , mention.id_mention , specialite.libelle_specialite , departement.nom_departement , 
  mention.libelle_mention , etablissement.nom_etablissement
FROM `pv_annuel` 
JOIN specialite ON specialite.id_specialite = pv_annuel.id_specialite
JOIN departement ON departement.id_departement = pv_annuel.id_departement
JOIN niveau ON niveau.id_niveau = pv_annuel.id_niveau
JOIN mention ON mention.id_mention = specialite.id_mention
JOIN etablissement On departement.id_etablissement = etablissement.id_etablissement
WHERE id_annee_academique = '".$_SESSION['id_annee_academique']."'";
$resultat = $bdd->query($SQL);
$liste = $resultat->fetchAll();
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des PV disponible</h6>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Etablissement</th>
                    <th>Département</th>
                    <th>Sépicialté</th>
                    <th>Niveau</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if (isset($liste) && !empty($liste)): ?>
                    <?php foreach ($liste as $li): ?>
                        <tr>
                            <td><?= $li['nom_etablissement']; ?></td>
                            <td><?= $li['nom_departement']; ?></td>
                            <td><?= $li['libelle_specialite']; ?></td>
                            <td><?= $li['libelle_niveau']; ?></td>
                            <td>
                                <button class="btn btn-primary" type="button"  onclick="consulterTest(<?= $li['id_etablissement']; ?>,<?= $li['id_departement']; ?>,<?= $li['id_specialite']; ?>,<?= $li['id_niveau']; ?>,<?=$_SESSION['id_annee_academique']?>)">consulter</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-5">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Consultation des PV ANNUEL</h6>
    </div>
    <div class="card-body">
        <!-- spinner -->
        <div>
            <div id="spinner-test" class="text-center d-none">
                <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;"
                     role="status">
                </div>
            </div>
            <h2 id="spinner-text-test"
                class="d-none text-uppercase font-weight-light text-center text-primary mt-2">veuillez
                patienter s'il vous plaît</h2>
        </div>

        <!-- position tableau de donnée -->
        <div id="afficherElementTest">

        </div>

    </div>
</div>


<script type="text/javascript">
    /* charger les données du tableau */
    loadDonneTest = function loadDonneTest(page,id_etab,id_depart,id_specialite,id_niv,id_annne) {
        $.ajax({
            url: "pvdispo/dispopv.php",
            type: "POST",
            cache: false,
            data: {page_no: page, etab: id_etab,depart:id_depart,speci:id_specialite,niv:id_niv,annetest:id_annne},
            beforeSend: function () {
                $("#afficherElementTest").hide();
                $('#spinner-test').removeClass("d-none").show();
                $('#spinner-text-test').removeClass("d-none").show();
            },
            success: function (response) {
                $("#afficherElementTest").html(response);
            },
            complete: function (response) {
                $("#afficherElementTest").show();
                $('#spinner-test').addClass("d-none");
                $('#spinner-text-test').addClass("d-none");
            }
        });
    }
    function consulterTest(id_etab,id_depart,id_specialite,id_niv,id_annne) {
        loadDonneTest(1,id_etab,id_depart,id_specialite,id_niv,id_annne)
    }
    $(document).on("change", "#taille_police", function (e) {
        var taille = parseInt($(this).val());
        $("#table-test").css('font-size', taille);
        e.preventDefault();
    });
</script>
