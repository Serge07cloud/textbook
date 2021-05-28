
<form action="" method="POST">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if (isset($label)) echo $label; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <!-- Head -->
                    <thead>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                    </tr>
                    </thead>

                    <!-- Footer -->
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                    </tr>
                    </tfoot>

                    <!-- Body -->
                    <tbody>
                    <?php
                    foreach ($list as $enseignant)
                    {
                        ?>
                        <tr>
                            <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $enseignant->id_enseignant(); ?>"></td>
                            <td><?php echo $enseignant->id_enseignant(); ?></td>
                            <td><?php echo $enseignant->nom_enseignant();?></td>
                            <td><?php echo $enseignant->prenom_enseignant();?></td>
                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>

                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#EditEvaluationModal" style="margin: 20px;"><i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i> Edition</a>
            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#DeleteEvaluationModal" style="margin: 20px;"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i> Supprimer la sélection</a>
        </div>

        <!-- Deletion -->
        <?php include "teacher/modals/deleteModal.php" ?>

        <!-- Edition -->
        <?php include "teacher/modals/editModal.php" ?>

    </div>

</form>