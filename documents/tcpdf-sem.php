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
        $logo_etablissement = $_SESSION['imprimer']['logo_etablissement'];
        if (!empty($logo_etablissement) && !is_null($logo_etablissement)) {
            $this->Image('../img/' . $logo_etablissement, 275, 2, 15, 10, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
        }


        //First Line
        $left = "UFR <br>Unité de Formation ";
        $this->WriteHTMLCell(275, 10, 2, 14, $left, 0);

        $left = ": " . $_SESSION['imprimer']['nom_ufr'];
        $this->WriteHTMLCell(275, 10, 34, 14, $left, 0);

        $left = ": " . $_SESSION['imprimer']['nom_departement'];
        $this->WriteHTMLCell(275, 10, 34, 18.5, $left, 0);

        $pv = "<b>PV de Validation des examens</b>";
        $this->WriteHTMLCell(275, 10, 100, 10, $pv, 0);

        $annee = '2017 - 2018';
        if ($_SESSION['imprimer']['annee'] == '21918') {
            $annee = '2018 - 2019';
        }
        $center = "<b>Année académique : $annee</b>";
        $this->WriteHTMLCell(275, 10, 170, 10, $center, 0);

        $right = "Date d'édition " . date("d/m/Y");
        $this->WriteHTMLCell(275, 10, 255, 15, $right, 0);


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
        } else {
            $left = ": Master 2";
        }
        $this->WriteHTMLCell(275, 10, 34, 23, $left, 0);

        $nom_p = $_SESSION['imprimer']['nom_parcours'];
        // on trunc le texte si c'est trop long
        $out = strlen($nom_p) > 20 ? substr($nom_p, 0, 28) . "..." : $nom_p;
        $right = "Parcours : $out";
        $this->WriteHTMLCell(275, 10, 70, 23, $right, 0);

        $center = "Statut du Parcours : Ouvert";
        $this->WriteHTMLCell(275, 10, 145, 23, $center, 0);

        $nom_m = $_SESSION['imprimer']['nom_mention'];
        $mention = "Mention : $nom_m";
        $this->WriteHTMLCell(275, 10, 210, 23, $mention, 0);

        $mention = "Semestre : " . $_SESSION['imprimer']['id_semestre'];;
        $this->WriteHTMLCell(275, 10, 275, 23, $mention, 0);

        $level = (int)$_SESSION['imprimer']['niveau'];
        $n = "L";
        if ($level > 3) {
            $n = "M";
        }
        $an = $_SESSION['imprimer']['annee'];
        $num = "N° <b>VE-" . $_SESSION['imprimer']['code_parcours'] . "-$n$level-" . "S-$an</b>";
        $this->WriteHTMLCell(275, 10, 255.5, 27.5, $num, 0);
    }

    public function Footer()
    {
        $this->SetFont('Helvetica', '', 8);
        // pagination
        $pagingtext = "Page N ° " . $this->PageNo() . "/" . $this->getAliasNbPages();
        //WriteHTMLCell
        $this->WriteHTMLCell(275, 10, 270, 195, $pagingtext, 0);
    }
}

