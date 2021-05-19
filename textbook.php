<?php session_start(); ?>
<?php

$typeUtilisateur = (int)$_SESSION["id_type_utilisateur"];
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Cahier de texte</h3>
    </div>
    <div class="card-body">

<!--        <form action="" method="POST">-->
            <div class="container">
                <?php
                    switch ($typeUtilisateur){
                        case 1:
                            # Super Administrateur
                            include ("textbook/interfaces/superUtilisateur.php");
                            break;
                        case 2:
                            # Présidence de l'université
                            include ("textbook/interfaces/presidence.php");
                            break;
                        case 3:
                            # Directeur d'UFR
                            include ("textbook/interfaces/directeurEtablissement.php");
                            break;
                        case 4:
                            # Formateur
                            include ("textbook/interfaces/formateur.php");
                            break;
                        case 5:
                            # Directeur d'Unité de formation
                            include ("textbook/interfaces/directeurUniteFormation.php");
                            break;
                        default:
                            break;
                    }
                ?>
            </div>
<!--        </form>-->
    </div>
</div>

