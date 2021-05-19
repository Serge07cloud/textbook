<?php
try
{
  $bdd = new PDO('mysql:host=localhost:3308; dbname=test; charset=utf8', 'root', '');
} catch (Exception $e) {
  //die('Erreur : ' . $e->getMessage());
  echo $e->getMessage();
}

$gu = $bdd->query("SELECT * FROM inscription")   ;
$i=0;
while($res = $gu->fetch())
{
  
  if (trim($res['id_ufr'])!='') {
    echo $res['id_ufr'].' <br>';

    $g = $bdd->query('SELECT * FROM ufr WHERE libelle_ufr="'.$res['id_ufr'].'"')   ;
    if ($re = $g->fetch())
     {
      echo 'Existant';
    }
    else
    {
      $i++;
       $bdd->query('INSERT INTO ufr (id_ufr,libelle_ufr) VALUES ("'.$i.'","'.$res['id_ufr'].'")')   ;
        $bdd->exec('UPDATE inscription SET id_ufr = "'.$i.'" WHERE id_ufr = "'.$res['id_ufr'].'"')   ;
    }

   
  }
  
}

?>

