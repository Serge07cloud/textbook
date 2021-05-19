<?php
require ('../tcpdf/tcpdf.php');


class MYPDF extends TCPDF {

    private $ufrImage;
    private $departmentImage;
    private $ufr;
    private $department;
    private $teacher;
    private $schoolYear;
    private $ue;
    private $ecue;
    private $level;
    private $career;
    private $cmHour;
    private $tdHour;
    private $tpHour;
    private $timeCM;
    private $timeTD;
    private $timeTP;


    public function Header() {
        $image_file_left = $this->getUfrImage();
        $image_file_right = $this->getDepartmentImage(); //Departement
        $this->Image($image_file_left, 15, 8, 18, 18, 'JPG', '', 'M', false, 300, '', false, false, 1, false, false, false);
        $this->SetFont('helvetica', 'B', 20);
        $this->writeHTMLCell(210, 10, 45, 12, 'RÉCAPITULATIF DES COURS DISPENSÉS PAR ENSEIGNANT', 1, 1, 0, true, 'C', true);
        $x = $this->GetPageWidth() - 36 ;
        $this->Image($image_file_right, $x, 8, 18, 18, 'JPG', '', 'N', false, 300, '', false, false, 1, false, false, false);

        $ufr = $this->getUfr();
        $department = $this->getDepartment();
        $schoolYear = $this->getSchoolYear();
        $teacher = $this->getTeacher();
        $html = <<<EOD
<table cellpadding="2">
    <tr>
        <td width="12%">UFR</td>
        <td width="68%">: $ufr</td>
        <td width="20%" align="right">Année scolaire</td>
    </tr>
    <tr>
        <td>Département</td>
        <td>: $department</td>
        <td align="right" rowspan="2">$schoolYear</td>
    </tr>
    <tr>
        <td>Enseignant</td>
        <td>: $teacher</td>
        <td></td>
    </tr>
    
</table>
EOD;
        $this->SetFont('helvetica', '', 10);
        $this->writeHTMLCell(0, 0, 16, 26, $html, 0, 1, 0, true, '', true);

        $ue = $this->getUe();
        $ecue = $this->getEcue();
        $level = $this->getLevel();
        $career = $this->getCareer();
        $html = <<<EOD
        <table cellpadding="2" border="0">
            <tr>
                <td align="left"    width="3%">UE:</td>
                <td align="left"    width="20%"><b>$ue</b></td>
                <td align="left"  width="26%">ECUE : <b>$ecue</b></td>
                <td align="right"  width="17%">NIVEAU : <b>$level</b></td>
                <td align="right"   width="34%">PARCOURS : <b>$career</b></td>
            </tr>
        </table>
EOD;

        $this->writeHTMLCell(0, 0, 16, 43, $html, 0, 1, 0, true, '', true);

        $timeCM = $this->getTimeCM();
        $timeTD = $this->getTimeTD();
        $timeTP = $this->getTimeTP();
        $html = <<<EOD
        <table cellpadding="2" border="0">
            <tr>
                <td width="35%">Volumes horaires Attribués par type d'enseignement : </td>
                <td width="32%"></td>
                <td align="right" width="11%">CM : <b>$timeCM</b> H</td>
                <td align="right" width="11%">TD : <b>$timeTD</b> H</td>
                <td align="right" width="11%">TP : <b>$timeTP</b> H</td>
            </tr>
        </table>
EOD;
        $this->writeHTMLCell(0, 0,16 , 53, $html, 0, 1, 0, true, '', true);

    }


    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $pagingtext = "Page N ° " . $this->PageNo() . "/" . $this->getAliasNbPages();
        $this->WriteHTMLCell(50, 10, 270, 195, $pagingtext, 0);
        $editDate = "Date d'édition " . date("d/m/Y");
        $this->WriteHTMLCell('', 10, 10, 195, $editDate, 0);

    }




    /**
     * @return mixed
     */
    public function getUfr()
    {
        return $this->ufr;
    }

    /**
     * @param mixed $ufr
     */
    public function setUfr($ufr)
    {
        $this->ufr = $ufr;
    }

    /**
     * @return mixed
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param mixed $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * @return mixed
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param mixed $teacher
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }

    /**
     * @return mixed
     */
    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    /**
     * @param mixed $schoolYear
     */
    public function setSchoolYear($schoolYear)
    {
        $this->schoolYear = $schoolYear;
    }

    /**
     * @return mixed
     */
    public function getUe()
    {
        return $this->ue;
    }

    /**
     * @param mixed $ue
     */
    public function setUe($ue)
    {
        $this->ue = $ue;
    }

    /**
     * @return mixed
     */
    public function getEcue()
    {
        return $this->ecue;
    }

    /**
     * @param mixed $ecue
     */
    public function setEcue($ecue)
    {
        $this->ecue = $ecue;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getCareer()
    {
        return $this->career;
    }

    /**
     * @param mixed $career
     */
    public function setCareer($career)
    {
        $this->career = $career;
    }

    /**
     * @return mixed
     */
    public function getCmHour()
    {
        return $this->cmHour;
    }

    /**
     * @param mixed $cmHour
     */
    public function setCmHour($cmHour)
    {
        $this->cmHour = $cmHour;
    }

    /**
     * @return mixed
     */
    public function getTdHour()
    {
        return $this->tdHour;
    }

    /**
     * @param mixed $tdHour
     */
    public function setTdHour($tdHour)
    {
        $this->tdHour = $tdHour;
    }

    /**
     * @return mixed
     */
    public function getTpHour()
    {
        return $this->tpHour;
    }

    /**
     * @param mixed $tpHour
     */
    public function setTpHour($tpHour)
    {
        $this->tpHour = $tpHour;
    }

    /**
     * @return mixed
     */
    public function getUfrImage()
    {
        return $this->ufrImage;
    }

    /**
     * @param mixed $ufrImage
     */
    public function setUfrImage($ufrImage)
    {
        $this->ufrImage = $ufrImage;
    }

    /**
     * @return mixed
     */
    public function getDepartmentImage()
    {
        return $this->departmentImage;
    }

    /**
     * @param mixed $departmentImage
     */
    public function setDepartmentImage($departmentImage)
    {
        $this->departmentImage = $departmentImage;
    }

    /**
     * @return mixed
     */
    public function getTimeCM()
    {
        return $this->timeCM;
    }

    /**
     * @param mixed $timeCM
     */
    public function setTimeCM($timeCM)
    {
        $this->timeCM = $timeCM;
    }

    /**
     * @return mixed
     */
    public function getTimeTD()
    {
        return $this->timeTD;
    }

    /**
     * @param mixed $timeTD
     */
    public function setTimeTD($timeTD)
    {
        $this->timeTD = $timeTD;
    }

    /**
     * @return mixed
     */
    public function getTimeTP()
    {
        return $this->timeTP;
    }

    /**
     * @param mixed $timeTP
     */
    public function setTimeTP($timeTP)
    {
        $this->timeTP = $timeTP;
    }



}

