<?php
include_once 'database.php';
if($_POST['tag']=='ufrList')
{
    $query = "select * from etablissement";

    $result = mysqli_query($con,$query);

    $arr =[];
    $i=0;

    while($row = mysqli_fetch_assoc($result))
    {
        $arr[$i] = $row;
        $i++;
    }

    echo json_encode($arr);
}


// Getting item list on the basis of ufr_id
if($_POST['tag']=='uflist')
{
    $ufr_id = $_POST['ufr_id'];

    $query = "select id_departement,nom_departement from departement where id_etablissement ='".$ufr_id."'" ;

    $result = mysqli_query($con,$query);

    $arr =[];
    $i=0;

    while($row = mysqli_fetch_assoc($result))
    {
        $arr[$i] = $row;
        $i++;
    }

    echo json_encode($arr);
}

?>
