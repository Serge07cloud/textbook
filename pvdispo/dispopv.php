<?php
/* connexion à la base de donnée */
require "../config/connexion.php";
/* les fonctions de recherche */
require_once "../fonctions/index.php";
require_once "../fonctions/pv_annuel.php";


extract($_POST);
$annee = $annetest;
$id_etablissement = $etab;
$id_departement = $depart;
$id_parcours = $speci;
$niveau = $niv;

/* limite */
$limit = 14;

/* numero de la page */
if (isset($_POST['page_no'])) {
    $page_no = (int)$_POST['page_no'];
} else {
    $page_no = 1;
}

$next_no = $page_no + 1;
$prev_no = $page_no - 1;

$offset = ($page_no - 1) * $limit;


/* récuperation de la liste des étudiants */
$etudiants = ListeEtudiants($id_departement, $id_parcours, $niveau, $offset, $limit, $annee);
$total = compterEtudiants($annee, $id_departement, $id_parcours, $niveau);

$total_pages = (int)ceil($total['nb'] / $limit);


/* sortie */
$output = "";

$output .= "<table id='table-test' style='font-size: 11px;'  nobr='true' width='100%' border='1' cellspacing='0' cellpadding='3'>
                            <tr nobr='true' class='font-weight-bold text-white bg-primary text-uppercase'>
                                <td style='text-align:center;' colspan='7' width='65.5%'>Informations Etudiant</td>
                                <td style='text-align:center;' rowspan='2' width='5.5%'>semestre</td>
                                <td style='text-align:center;' colspan='3' width='14.5%'>Informations semestre</td>
                                <td style='text-align:center;' colspan='3' width='14.5%'>Informations Annuelle</td>
                            </tr>
                            <tr nobr='true' class=' font-weight-bold text-uppercase'>
                                <td width='7%'>N carte étudiant</td>
                                <td width='10%'>Nom</td>
                                <td width='23.5%'>Prénom</td>
                                <td width='5%'>Date de naissance</td>
                                <td width='3.1%''>Genre</td>
                                <td width='13.4%'>Nationalité</td>
                                <td width='3.5%'>Statut</td>

                                <td width='4.5%'>Moyenne</td>
                                <td width='4%'>Mention</td>
                                <td width='6%'>Délibération</td>

                                <td width='4.5%'>Moyenne</td>
                                <td width='4%'>Mention</td>
                                <td width='6%'>Délibération</td>
                            </tr>";
if (isset($etudiants) && count($etudiants) > 0):
    foreach ($etudiants as $et):
        $info = InfoEtudiant($et['matricule']);

        $moy_sem1 = moyEtudiant($et['matricule'], 1);
        $moy_sem2 = moyEtudiant($et['matricule'], 2);
        $moy_an = moyEtudiant($et['matricule'], 3);
        /* variables */
        $dec_sem1 = "";
        $dec_sem2 = "";
        $dec_an = "";
        if (isset($annee) && $annee !== '22019'):
            $dec_sem1 = deliberationEtudiant($et['matricule'], 1);
            $dec_sem2 = deliberationEtudiant($et['matricule'], 2);
            $dec_an = deliberationEtudiant($et['matricule'], 3);
        endif;
        $status = statusEtudiant($et['matricule'], $niveau);
        $libelle_status = exist(InfoStatut($status)['libelle_statut_etudiant']);
        /* info */
        $nom = exist($info['nom'], $et['nom']);
        $prenom = exist($info['prenoms'], $et['prenoms']);
        $sexe = exist($info['sexe']);
        $pays = exist($info['pays']);
        $date_naissance = exist($info['date_naissance']);
        $nationalite = exist($info['pays']);

        $output .= "<tr nobr='true'>
                                        <td rowspan='3'>{$et['matricule']}</td>
                                        <td rowspan='3'>{$nom}</td>
                                        <td rowspan='3'>{$prenom}</td>
                                        <td style='text-align: right' rowspan='3'>{$date_naissance}</td>
                                        <td rowspan='3'>{$sexe}</td>
                                        <td rowspan='3'>{$nationalite}</td>
                                        <td rowspan='3' data-toggle='tooltip' data-placement='bottom'  title='{$libelle_status}'>{$status}</td>

                                        <td rowspan='2'>Semestre 1</td>

                                        <td style='text-align: right' rowspan='2'>{$moy_sem1}</td>
                                        <td rowspan='2'></td>
                                        <td rowspan='2'>{$dec_sem1}</td>

                                        <td style='text-align: right' rowspan='3'>{$moy_an}</td>
                                        <td rowspan='3'></td>
                                        <td rowspan='3'>{$dec_an}</td>
                                    </tr>
                                    <tr nobr='true'>
                                    </tr>
                                    <tr nobr='true'>
                                        <td>Semestre 2</td>
                                        <td style='text-align: right'>{$moy_sem2}</td>
                                        <td></td>
                                        <td>{$dec_sem2}</td>
                                    </tr>";
    endforeach;
endif;
$output .= "</table>";

/* pagination */
if ($page_no >= $total_pages):
    $output .= "<div class='clearfix mt-3'>
<div class='float-left'>
<ul class='pagination'>
    <li class='page-item' onclick='loadDonneTest({$prev_no},{$id_etablissement},{$id_departement},{$id_parcours},{$niveau},{$annee})'>
        <span  class='page-link'>Précédente</span>
    </li>
</ul>
</div>";
else:
    $output .= "<div class='clearfix mt-3'>
<div class='float-left'>
<ul class='pagination'>
    <li class='page-item' onclick='loadDonneTest({$prev_no},{$id_etablissement},{$id_departement},{$id_parcours},{$niveau},{$annee})'>
        <span  class='page-link'>Précédente</span>
    </li>
    <li class='page-item' onclick='loadDonneTest({$next_no},{$id_etablissement},{$id_departement},{$id_parcours},{$niveau},{$annee})'>
        <span class='page-link' >Suivante</span>
    </li>
</ul>
</div>";
endif;

/* taille de la police d'écriture */
$output .= "<div class='float-right'>
                <label for='taille_police' class='pr-2 text-primary'>taille de la police d'écriture </label>
                <select id='taille_police' class='text-primary'>
                    <option value='7'>7 px</option>
                    <option value='8'>8 px</option>
                    <option value='9'>9 px</option>
                    <option value='10'>10 px</option>
                    <option value='11'>11 px</option>
                    <option value='12'>12 px</option>
                    <option value='13'>13 px</option>
                </select>
            </div>
</div>";
echo $output;
?>
