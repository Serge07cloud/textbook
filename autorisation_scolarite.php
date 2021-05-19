<div class="card shadow mb-4">
    <div class="card-header py-3">
        <center><h4 class="m-0 font-weight-bold text-primary"> RECEPTION AVIS AUTORISATION D'INSCRIPTION PAR LA SCOLARITE</h4></center>
    </div>
</div>
<form action="" method="post">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">STRUCTURE D'ACCUEIL</h5></center>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-5 mr-3">
                    <label for="ufr">UFR</label>
                    <select class="form-control" name="ufr">
                        <option>Selectionner l'UFR</option>
                    </select>
                </div>
                <div class="form-group col-md-5 mr-3">
                    <label for="uf">Unite Formation</label>
                    <select class="form-control" name="uf">
                        <option>Selectionner unite formation</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">SOUHAIT ETUDIANT</h5></center>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-3 mr-3">
                    <label for="ndemande">Numero Demande</label>
                    <input type="text" name="ndemande" class="form-control">
                </div>
                <div class="form-group col-md-5 mr-3">
                    <label for="type_ins">Type Inscription</label>
                    <select class="form-control" name="type_ins">
                        <option selected>Designer le type d'inscription</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label>Date Demande</label>
                    <input type="date" name="date_demande" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Motivation</label>
                    <textarea class="form-control" name="motivation" rows="6"></textarea>
                </div>

            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">IDENTITE ETUDIANT</h5></center>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Numero Carte Etudiant</label>
                    <input type="text" name="carte" id="numCarte" required="required" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3 mr-3 ">
                    <label for="ndemande">Nom</label>
                    <input type="text" name="nom" class="form-control">
                </div>
                <div class="form-group col-md-5 mr-3">
                    <label>Prenoms</label>
                    <input type="text" name="prenoms" class="form-control">
                </div>
                <div class="form-group col-md-3 mr-3">
                    <label>Date de naissance</label>
                    <input type="date" name="date" class="form-control" >
                </div>
                <div class="form-group col-md-4 mr-3">
                    <label>Lieu de naissance</label>
                    <input type="text" name="lieu" class="form-control">
                </div>
                <div class="form-group col-md-1 mr-3">
                    <label>Genre</label>
                    <select class="form-control" name="type_ins">
                        <option selected>Designer le genre</option>
                    </select>

                </div>
                <div class="form-group col-md-3">
                    <label>Pays</label>
                    <select class="form-control" name="type_ins">
                        <option selected>Designer le pays</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">INFORMATION CURSUS ETUDIANT ANNEE ACADEMIQUE N-1</h5></center>
        </div>
        <div class="card-body">
            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="uf">Origine UFR</label>
                    <select class="form-control" id="origine" name="mention">
                        <option value="-1">Designer la mention</option>
                    </select>

                </div>

                <div class="form-group col-md-4">
                    <label for="uf">Parcours</label>
                    <select class="form-control" id="parcours" name="parcours">
                        <option>Designer le parcours</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="ufr">Niveau</label>
                    <select class="form-control" name="niveau">
                        <option>Designer le niveau</option>
                    </select>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">AVIS RESPONSABLE UF</h5></center>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-2 mr-3">
                    <label for="ufr">Autorisation</label>
                    <select name="autorisation" id="" class="form-control">
                        <option value="1">Oui</option>
                        <option value="2">Non</option>
                    </select>
                </div>
                <div class="form-group col-md-5 mr-6">
                    <label for="uf">Avis Motive</label>
                    <input type="text" name="avismo" class="form-control">
                </div>
                <div class="form-group col-md-3 mr-5">
                    <label for="uf">Date avis</label>
                    <input type="date" name="dateavis" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <center><h5 class="m-0 font-weight-bold text-primary">AVIS RESPONSABLE <UFR></UFR></h5></center>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-2 mr-3">
                    <label for="ufr">Autorisation</label>
                    <select name="autorisation" id="" class="form-control">
                        <option value="1">Oui</option>
                        <option value="2">Non</option>
                    </select>
                </div>
                <div class="form-group col-md-5 mr-6">
                    <label for="uf">Avis Motive</label>
                    <input type="text" name="avismo" class="form-control">
                </div>
                <div class="form-group col-md-3 mr-5">
                    <label for="uf">Date avis</label>
                    <input type="date" name="dateavis" class="form-control">
                </div>
            </div>
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

</form>
<div align="right">
    <button  class="btn btn-primary" data-toggle="modal" data-target="#saveClasseModal">Valider</button>
    <button  class="btn btn-danger" type="reset">Annuler</button>

</div>



<br>

<form action="" method="post">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des demandes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tbody>
                    <tr>
                        <th rowspan="2">UFR</th>
                        <th rowspan="2">UF</th>
                        <th rowspan="2">NDemande</th>
                        <th rowspan="2">Netudiant</th>
                        <th rowspan="2">Etudiant</th>
                        <th rowspan="2">Type Inscription</th>
                        <th colspan="3">Directeur UF</th>
                        <th colspan="3">Directeur UFR</th>
                        <th ></th>
                    </tr>
                    <tr>
                        <th>Date Avis</th>
                        <th>Avis Motive</th>
                        <th>Autorisation</th>
                        <th>Date Avis</th>
                        <th>Avis Motive</th>
                        <th>Autorisation</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><th>
                        <th>Dossier</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
