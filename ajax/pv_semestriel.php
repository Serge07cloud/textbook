<?php
/* connexion à la base de donnée */
require "../config/connexion.php";
/* les fonctions de recherche */
require_once "../fonctions/index.php";
require "../fonctions/pv_sem.php";


/* insertiion des données dans une variable */
if (isset($_POST['form']) && !empty($_POST['form'])) {
    /* les paramètres */
    $annee = $_POST['form'][0]['value'];
    $id_etablissement = $_POST['form'][1]['value'];
    $id_departement = $_POST['form'][2]['value'];
    $niveau = $_POST['form'][3]['value'];
    $id_parcours = $_POST['form'][4]['value'];
    $id_semestre = $_POST['form'][6]['value'];
}

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
$etudiants = ListeEtdPVSEM($annee, $id_departement, $niveau, $id_semestre, $offset, $limit);
$ue = ListeUE($annee, $id_departement, $id_semestre);

$total = compterEtdPVSEM($annee, $id_departement, $id_parcours, $niveau);
$total_pages = (int)ceil($total['nb'] / $limit);

$tt = 54 / (count($ue) + 2);
$div = round($tt, 2);

/* sortie */
$output = "";

$output .= "<table id='table' class='table-responsive' style='font-size: 10px;'  nobr='true' border='1' cellspacing='0' cellpadding='3'>
                            <tr>
                                <td style='text-align:center;' colspan='7' width='36%'>Informations Etudiant</td>
                                <td style='text-align:center;' rowspan='2' width='5%'>session</td>
                                <td style='text-align:center;' colspan='9' width='54%'>Informations UE</td>
                                <td style='text-align:center;' rowspan='2' width='5%'>Delibération</td>
                            </tr>
                            <tr nobr='true' class=' font-weight-bold text-uppercase'>
                                <td width='7%'>N carte étudiant</td>
                                <td width='5%'>Nom</td>
                                <td width='8%'>Prénom</td>
                                <td width='5%'>Date de naissance</td>
                                <td width='3%'>Genre</td>
                                <td width='5%'>Nationalité</td>
                                <td width='3%'>Statut</td>";
/* INFO UE */
foreach ($ue as $liste):
    $output .= "<td width='" . $div . "%'>" . $liste['code_ue'] . "</td>";
endforeach;
$output .= "<!-- informations annuelle -->
                                <td width='" . $div . "%'>Moyenne</td>
                                <td width='" . $div . "%'>Mention</td>
                            </tr>";
if (isset($etudiants) && count($etudiants) > 0):
    foreach ($etudiants as $et):
        $info = InfoEtdPVSEM($et['matricule']);
        /* info */
        $nom = exist($info['nom'], $et['nom']);
        $prenom = exist($info['prenoms'], $et['prenoms']);
        $sexe = ($info['sexe'] == '1') ? 'M' : 'F';
        $pays = exist($info['pays']);
        $date_naissance = exist($info['date_naissance']);
        $nationalite = exist($info['pays']);

        $output .= "
            <tr>
        <!-- informations etudiants -->
        <td rowspan='3'>{$et['matricule']}</td>
        <td rowspan='3'>{$nom}</td>
        <td rowspan='3'>{$prenom}</td>
        <td rowspan='3'>{$date_naissance}</td>
        <td rowspan='3'>{$sexe}</td>
        <td rowspan='3'>{$nationalite}</td>
        <td rowspan='3'></td>
        <!-- session -->
        <td rowspan='2'>normal</td>
        <!-- info ue -->";
        /* INFO UE */
        foreach ($ue as $liste):
            $id_ue = $liste['id_ue'];
            $mat = $et['matricule'];
            $moy = getMoySEM($mat, $id_ue, $niveau, $id_semestre);
            $output .= "<td width='" . $div . "%'>" . $moy['moy'] . "</td>";
        endforeach;
        $output .= "
        <!-- MOY -->
        <td rowspan='3'></td>
        <!-- MENTION -->
        <td rowspan='3'></td>
        <!-- Delibération -->
        <td rowspan='3' colspan='3'></td>
    </tr>
    <tr></tr>
    <tr>
        <!-- informations etudiants -->
        <td>rattrapage</td>";
        foreach ($ue as $liste):
            $output .= "<td></td>";
        endforeach;
        $output .= "</tr>";
    endforeach;
endif;
$output .= "</table>";

/* pagination */
if ($page_no >= $total_pages):
    $output .= "
<div class='clearfix mt-3'>
    <div class='float-left'>
        <ul class='pagination'>
            <li class='page-item' onclick='loadData({$prev_no})'>
                <span class='page-link'>Précédente</span>
            </li>
        </ul>
    </div>
    ";
else:
    $output .= "
    <div class='clearfix mt-3'>
        <div class='float-left'>
            <ul class='pagination'>
                <li class='page-item' onclick='loadData({$prev_no})'>
                    <span class='page-link'>Précédente</span>
                </li>
                <li class='page-item' onclick='loadData({$next_no})'>
                    <span class='page-link'>Suivante</span>
                </li>
            </ul>
        </div>
        ";
endif;

/* taille de la police d'écriture */
$output .= "
        <div class='float-right'>
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
    </div>
    ";
echo $output;
?>
