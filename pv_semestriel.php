<?php
require "fonction.php";
require "fetch/fetch_pvsem.php";
$parcours = fetchParcours();
$etablissements = fetchETB();
$departements = fetchDEPARTEMENT();
$mentions = fetchMENTION();
$niveaus = $bdd->query('select * from niveau')->fetchAll();

if (isset($_POST['valider'])) {
    /* pour récuperer les valeurs $_POST */
    extract($_POST);

    /* récuperer l'info sur l'etablissement */
    $info = InfoEtablissement($id_etablissement);

    /* récuperer l'info sur le parcours */
    $nom_p = InfoParcours($id_parcours);

    /* récuperer info sur la mention */
    $nom_m = InfoMention($id_mention);

    /* récuperer info etablissement */
    $nom_d = InfoDepartement($id_departement);


    $_SESSION['imprimer'] = [
        'id_etablissement' => $id_etablissement,
        'id_departement' => $id_departement,
        'id_parcours' => $id_parcours,
        'id_mention' => $id_mention,
        'id_session' => 1,
        'niveau' => (int)$niveau,
        'annee' => (int)$annee,
        'logo_etablissement' => $info['logo_etablissement'],
        'nom_parcours' => $nom_p[0]['libelle_specialite'],
        'nom_ufr' => $info['nom_etablissement'],
        'nom_departement' => $nom_d['nom_departement'],
        'nom_mention' => $nom_m['libelle_mention'],
        'code_parcours' => $nom_p[0]['code_origine_specialite']
    ];
}
?>
<div class="card shadow mb-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Proces verbal semestriel</h6>
    </div>
    <div class="card-body">
        <form method="post" id="form-data" action="documents/pvsem.php">
            <input type="hidden" id="id_annee" name="annee" value="<?= $_SESSION['id_annee_academique'] ?>">
            <div class="d-flex">
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
                <div class="col-4">
                    <label for="exampleFormControlSelect1">Départements</label>
                    <select class="form-control" name="id_departement" id="id_departement">

                    </select>
                </div>

            </div>
            <div class="d-flex">

                <div class="col-4 position-relative">
                    <label for="exampleFormControlSelect1">Niveau</label>
                    <select class="form-control" name="id_niveau" id="id_diplome">
                        <?php
                        foreach ($niveaus as $niv):
                            ?>
                            <option value="<?= $niv['id_niveau'] ?>"><?= $niv['libelle_niveau'] ?></option>
                        <?php
                        endforeach;
                        ?>
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
                    <select class="form-control" name="id_mention" id="id_mention" required>
                        <option value="0">selectionner</option>
                    </select>
                </div>


            </div>
            <div class="d-flex">

                <div class="col-4">
                    <label for="exampleFormControlSelect1">Semestre</label>
                    <select class="form-control" name="id_semestre" id="id_semestre">
                        <option value="1" <?php if (isset($id_semestre) && $id_semestre === '1') echo 'selected'; ?>>
                            Semestre 1
                        </option>
                        <option value="2" <?php if (isset($id_semestre) && $id_semestre === '2') echo 'selected'; ?>>
                            Semestre 2
                        </option>
                    </select>
                </div>
            </div>
            <div class="float-right mt-2 pr-2">
                <button class="btn btn-primary" type="submit" id="consulter-pvsem" name="consulter">consulter</button>
                <button class="btn btn-primary" type="submit" name="valider">imprimer</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-5">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Consultation des PV SEMESTRIEL</h6>
    </div>
    <div class="card-body">
        <!-- spinner -->
        <div>
            <div id="spinner" class="d-none  justify-content-center">
                <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;"
                     role="status">
                </div>
            </div>
            <h2 id="spinner-text"
                class="d-none text-uppercase font-weight-light text-center text-primary mt-2">veuillez
                patienter s'il vous plaît</h2>
        </div>

        <!-- position tableau de donnée -->
        <div id="table-data">
        </div>

    </div>
</div>
