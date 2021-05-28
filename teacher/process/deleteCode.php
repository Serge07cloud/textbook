<?php

if (!empty($_POST["cocher"])) {

    foreach ($_POST["cocher"] as $id) {

        $id = (int) $id;

        // Enseignant sélectionné
        if (isset($teacherManager)) {
            $selectedTeacher = $teacherManager->get($id);
        }

        // Suppression de l'utilisateur
        if (isset($userManager)) {
            $userManager->delete($selectedTeacher->id_utilisateur());
        }

        // Suppression de l'enseignant de la table des enseignant
        $teacherManager->delete($id);

    }
    ?>
    <div>
        <span id="" class="form-text text-success font-weight-bold">
            <i class="fas fa-fa-check-square fa-md fa-fw mr-2"></i>
            Informations supprimées avec succès .
        </span>
    </div>
    <?php
}
