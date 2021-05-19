<?php 
if (isset($_POST['enregistrer'])) 
{
  for ($i=0; $i <sizeof($_POST['identifiant']) ; $i++)
   { 
    $gu = $bdd->query('SELECT * FROM groupe_utilisateur WHERE libelle_groupe_utilisateur="'.$_POST['libelle_groupe_utilisateur'][$i].'" OR id_groupe_utilisateur="'.$_POST['identifiant'][$i].'"')   ;
if ($res = $gu->fetch()) 
{
  ?>
     <div><span id="" class="form-text text-warning font-weight-bold"><i class="fas fa-ban fa-md fa-fw mr-2"></i>Information(s) existante(s) .</span></div>
  <?php
}
else
{
  $bdd->query("INSERT INTO groupe_utilisateur (id_groupe_utilisateur,libelle_groupe_utilisateur) VALUES ('$_POST[identifiant][$i]', '$_POST[libelle_groupe_utilisateur][$i]')")   ;
?>
<div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-check-square fa-md fa-fw mr-2"></i>Informations enrégistrées avec succès .</span></div>
<?php
  }
  


}


   
 } 


 if ( isset($_POST['modifier'])) {
  
  $bdd->exec('UPDATE groupe_utilisateur SET libelle_groupe_utilisateur = "'.$_POST['libelle_groupe_utilisateur'].'" WHERE id_groupe_utilisateur = "'.$_GET['id'].'"')   ;
  ?>
<div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations modifiées avec succès .</span></div>
<?php
   # code...
 }

 if (isset($_GET['id'])) {
  $gu = $bdd->query('SELECT * FROM groupe_utilisateur WHERE id_groupe_utilisateur="'.$_GET['id'].'"')   ;
$res = $gu->fetch();
 }



//Suppression
if (isset($_POST['supprimer'])) {
  if (!empty($_POST["cocher"])) {
    foreach ($_POST["cocher"] as $c) {

      $bdd->exec("DELETE FROM groupe_utilisateur WHERE id_groupe_utilisateur = '$c'")   ;
    }
    ?>
<div><span id="" class="form-text text-success font-weight-bold"><i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>Informations supprimées avec succès .</span></div>
    <?php
  }
}


 ?>
 <div class="card shadow mb-4">
  <div class="card-header py-3">
    <center><h3 class="m-0 font-weight-bold text-primary">Groupe utilisateur</h3></center>
  </div>
  <div class="card-body">
    <form action="" method="POST">
      <div class="form-row">
      <div id="upload">
      
            <button class="btn btn-info  btn-xs"  id="add"><i class="fa fa-user " ></i> Ajouter ligne</button>
              <button class="btn btn-danger btn-xs" id="Sup" type="submit" value="Supprimer" /><i class="fa fa-trash-o "></i>Supprimer ligne</button> <br> <br>
              <table class="table table-bordered table-striped table-condensed cf " id="t" >
                
                <thead>
                  <tr>
                    <th></th>
                    <th > Identifiant</th>
                    <th>Libéllé</th>
                    
                  </tr>
                </thead>
                <tbody >

                  <?php

                  if (isset($_GET['id'])) 
                  {
            $_req= $bdd->query('SELECT * FROM groupe_utilisateur WHERE id_groupe_utilisateur="'.$_GET['id'].'"')   ;

            while ($res = $gu->fetch())
             {
              ?>
             
            
             
               <tr>
                <td><div class="form-group col-md-4">
          <label for="Identifiant">Identifiant</label>
          <input type="text" class="form-control " id="identifiant"  name="identifiant" required="" autofocus="" value="<?php echo@ $res['id_groupe_utilisateur']?>" <?php if (isset($_GET['id'])){  echo "disabled";}?>>
        </div>
      </td>
      <td>
        <div class="form-group col-md-8">
          <label for="Libellé">Libellé</label>
          <input type="text" class="form-control " id="libelle_groupe_utilisateur"   name="libelle_groupe_utilisateur" required="" value="<?php echo @$res['libelle_groupe_utilisateur']?>">
        </div>
      </td>
                </tr>
              <?php
             } 
           }
           else{
            ?>
            <td></td>
            <td class="hidden-phone"><input type="text" required class="form-control" name="identifiant[]"></td><td class="hidden-phone"><input type="text"class="form-control" required name="libelle_groupe_utilisateur[]"></td>
            <?php
           }
             ?>
              
                </tbody>
              </table>



             
             


              <div >
                

              </div>
              <br>
              
  </div > 
</div>
  
              <!-- settings end 
              <input type="file" name="fichier" id="fichier" /> <br>
             <button class="btn btn-success btn-xs"  onclick="upload()" /><i class="fa fa-download "></i>Upload</button>-->


 

   
    <script type="text/javascript" src="Script/jquery-2.1.3.js"> </script>
    <script>
        $(function () {

            $("#add").click(function () {                

                $("#t>tbody:last").append('<tr><td><input class="ch"type="checkbox" /></td><td class="hidden-phone"><input type="text" required class="form-control" name="identifiant[]"></td><td class="hidden-phone"><input type="text"class="form-control" required name="libelle_groupe_utilisateur[]"></td></tr>');});
        
        
    


 
            $("#Sup").click(function () {
                
                if(confirm("Voulez vous vraiment supprimer ce(s) champ(s) ?")==true)
                $("tr:has(input:checked)").remove();        
            });
            var c={
                'diplay':'inline-block'
                };
                
            $("ul li").css(c);
            



 });
         


    </script>
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

    <?php   
    if (!isset($_GET[id])) 
    {
      ?>
      <button  class="btn btn-primary" data-toggle="modal" data-target="#saveClasseModal">Soumettre</button>
<button  class="btn btn-danger" type="reset">Annuler</button>
      <?php
     }
     else if(isset($_GET[id]))
      {?>
<button  class="btn btn-primary" data-toggle="modal" data-target="#updateClasseModal">Soumettre</button>
<a  class="btn btn-danger"  href="index.php?page=group_util">Annuler</a>

        <?php

     } ?>
  </div>
</div>













<?php 

$gu = $bdd->query("SELECT * FROM groupe_utilisateur")   ;

?>
<form action="" method="POST">
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Liste des groupes utilisateurs</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th></th>
            <th>Identifiant</th>
            <th>Libéllé</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
           <th>Identifiant</th>
           <th>Libéllé</th>
         </tr>
       </tfoot>
       <tbody>
        <?php 
        while($res = $gu->fetch())
        {
          ?>
          <tr>
             <td align="center"><input type="checkbox"  id="cocher[]" name="cocher[]" value="<?php echo $res['id_groupe_utilisateur']; ?>"></td>
            <td><a href="index.php?page=group_util&id=<?php echo $res['id_groupe_utilisateur'];?>"><?php echo $res['id_groupe_utilisateur'];?></a></td>
            <td><?php echo $res['libelle_groupe_utilisateur'];?></td>

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





              

 