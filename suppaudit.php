<?php
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <center><h3 class="m-0 font-weight-bold text-primary">Suppression audit</h3></center>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group col-md-2 mr-4">
                    <label for="Identifiant">Identifiant</label>
                    <input type="text" class="form-control " id="identifiant"  name="identifiant">
                </div>
                <div class="form-group col-md-4">
                    <label for="Libellé">Date Suppression</label>
                    <input type="date" class="form-control " name="datesupp">
                </div>
            </div>

            <div class="modal fade" id="saveClasseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment supprimer ces informations ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Cliquez sur le bouton "Valider" ci-dessous si vous voulez supprimer ces informations.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <!--<a class="btn btn-primary" href="index.php?page=aj_etab&amp;act=save">Enregistrer</a>-->
                            <button type="submit" class="btn btn-primary" name="enregistrer" data-toggle="modal" data-target="#saveClasseModal" ><i class="fas fa-plus-square fa-sm fa-fw mr-2 text-gray-400"></i> Valider </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div align="right">

            <button  class="btn btn-primary" data-toggle="modal" data-target="#saveClasseModal">Valider</button>
            <button  class="btn btn-danger" type="reset">Annuler</button>

        </div>
    </div>
</div>
