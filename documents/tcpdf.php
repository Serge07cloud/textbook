<?php
include('library/tcpdf/tcpdf.php');
class MYTCPDF extends TCPDF
{

    public function Header()
    {
        $this->SetFont('Helvetica', '', 10);
        // Logo de gauche
        $this->Image('../img/logo-ufhb.png', 3, 2, 35, 10, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
        // Logo de droite
        // Logo de droite
        $logo_etablissement = $_SESSION['imprimer']['logo_etablissement'];
        if (!empty($logo_etablissement) && !is_null($logo_etablissement)) {
            $this->Image('../img/' . $logo_etablissement, 275, 2, 15, 10, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
        }

        //First Line
        $left = "UFR <br>Unité de Formation ";
        $this->WriteHTMLCell(275, 10, 2, 14, $left, 0);

        $nom_ufr = $_SESSION['imprimer']['nom_ufr'];
        $left = ": $nom_ufr ";
        $this->WriteHTMLCell(275, 10, 34, 14, $left, 0);

        $left = ": " . $_SESSION['imprimer']['nom_departement'];
        $this->WriteHTMLCell(275, 10, 34, 18.5, $left, 0);

        $pv = "<b>PV de Validation des examens</b>";
        $this->WriteHTMLCell(275, 10, 100, 10, $pv, 0);

        $annee = '2017 - 2018';
        if ($_SESSION['imprimer']['annee'] == 3) {
            $annee = '2018 - 2019';
        } elseif ($_SESSION['imprimer']['annee'] == 4) {
            $annee = '2019 - 2020';
        }elseif ($_SESSION['imprimer']['annee'] == 1) {
            $annee = '2016 - 2017';
        }elseif ($_SESSION['imprimer']['annee'] == 2) {
            $annee = '2017 - 2018';
        }

        $center = "<b>Année académique : $annee</b>";
        $this->WriteHTMLCell(275, 10, 170, 10, $center, 0);

        $right = "Date d'édition " . date("d/m/Y");
        $this->WriteHTMLCell(275, 10, 253, 15, $right, 0);


        //Second Line
        $left = "Niveau ";
        $this->WriteHTMLCell(275, 10, 2, 23, $left, 0);

        //Second Line
        $niveau = $_SESSION['imprimer']['niveau'];
        $left = ": $niveau";

        if ($niveau === '1') {
            $left = ": Licence 1";
        } else if ($niveau === '2') {
            $left = ": Licence 2";
        } else if ($niveau === '3') {
            $left = ": Licence 3";
        } else if ($niveau === '4') {
            $left = ": Master 1";
        } else if ($niveau === '5') {
            $left = ": Master 2";
        } else {
            $left = ": Doctorat";
        }

        $this->WriteHTMLCell(275, 10, 34, 23, $left, 0);

        $nom_p = $_SESSION['imprimer']['nom_parcours'];

        // on trunc le texte si c'est trop long
        $right = "Parcours : $nom_p";
        $this->WriteHTMLCell(300, 10, 70, 23, $right, 0);

        $center = "Statut du Parcours : Ouvert";
        $this->WriteHTMLCell(275, 10, 70, 26.5, $center, 0);

        $nom_m = $_SESSION['imprimer']['nom_mention'];
        $mention = "Mention : $nom_m";
        $this->WriteHTMLCell(275, 10, 210, 23, $mention, 0);


        $level = (int)$_SESSION['imprimer']['niveau'];
        $n = "L";
        $le = $level;
        if ($level > 3) {
            $n = "M";
            if ($level == 4) {
                $le = 1;
            } elseif ($level == 5) {
                $le = 2;
            } else {
                $le = $level;
            }
        }

        $an = $_SESSION['imprimer']['annee'];
        $num = "N° <b>VE-" . $_SESSION['imprimer']['code_parcours'] . "-$n$le-" . "AN-$an</b>";
        $this->WriteHTMLCell(275, 10, 251, 26.5, $num, 0);
    }

    public function Footer()
    {
        $this->SetFont('Helvetica', '', 7);
        /* explication */
        $exp1 = "<b>LEGENDE</b>";
        $this->WriteHTMLCell(275, 10, 2, 180, $exp1, 0);
        $exp2 = "Les nouveaux étudiants ont le statut <b>EN</b> ou <b>FN</b>";
        $this->WriteHTMLCell(275, 10, 2, 184, $exp2, 0);
        $exp3 = "Les étudiants Ajournés (2018-2019) et Rédoublants (2019-2020)  ont le statut <b>ERS</b> ou <b>FRS</b>";
        $this->WriteHTMLCell(275, 10, 2, 189, $exp3, 0);
        $exp3 = "Les étudiants Autorisés (2018-2019) et Rédoublants (2019-2020)  ont le statut <b>ERU</b> ou <b>FRU</b>";
        $this->WriteHTMLCell(275, 10, 2, 194, $exp3, 0);

        /* régulier */
        $gn = "<b>EN</b>  Régulier nouveau ";
        $this->WriteHTMLCell(275, 10, 200, 184, $gn, 0);
        $grs = "<b>ERS</b> Régulier Redoublant sans UE validé";
        $this->WriteHTMLCell(275, 10, 200, 189, $grs, 0);
        $gru = "<b>ERU</b> Régulier Redoublant avec UE validé";
        $this->WriteHTMLCell(275, 10, 200, 194, $gru, 0);

        /* FIP */
        $gn = "<b>FN</b>  FIP Nouveau";
        $this->WriteHTMLCell(275, 10, 250, 184, $gn, 0);
        $grs = "<b>FRS</b> FIP Rédoublant sans UE validé";
        $this->WriteHTMLCell(275, 10, 250, 189, $grs, 0);
        $gru = "<b>FRU</b> FIP Rédoublant avec UE validé";
        $this->WriteHTMLCell(275, 10, 250, 194, $gru, 0);

        $this->SetFont('Helvetica', '', 8);
        // pagination
        $pagingtext = "Page N ° " . $this->PageNo() . "/" . $this->getAliasNbPages();
        //WriteHTMLCell
        $this->WriteHTMLCell(275, 10, 275, 199, $pagingtext, 0);
    }
}

