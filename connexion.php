<?php
session_start();
require "config/connexion.php";
require "fonction.php";
//recuperer laddresse email
$adrip = getIp();
$erreur = '';
if(isset($_POST['go']))
{
    extract($_POST);

    extract($_POST);
    $requete = $bdd->query('select * from utilisateur where login_utilisateur = "' . $login . '" and mot_passe_utilisateur = "' . $mot_passe . '"');

    if ($stmt = $requete->fetch()) {
        $_SESSION['connecte'] = $stmt['id_utilisateur'];
        $_SESSION['id_etablissement'] = $stmt['id_etablissement'];
        $_SESSION['id_type_utilisateur '] = $stmt['id_type_utilisateur'];
        $_SESSION['id_groupe_utilisateur'] = $stmt['id_groupe_utilisateur'];
        $_SESSION['id_departement_grand'] = $stmt['id_departement'];
        $_SESSION['connecte'] = $stmt['id_utilisateur'];
        $_SESSION['id_etablissement'] = $stmt['id_etablissement'];
        $_SESSION['id_departement'] = $stmt['id_departement'];
        $_SESSION['id_type_utilisateur'] = $stmt['id_type_utilisateur'];
        $_SESSION['id_groupe_utilisateur'] = $stmt['id_groupe_utilisateur'];
        $_SESSION['id_annee_academique'] = 3;
        header('Location:index.php');
    } else {
        $_SESSION['connecte'] = "";
        $erreur = 'Désolé ! Vos accès sont erronés. Veullez vous connecter à nouveau.';
    }


}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SYGE2-UFHB</title>
    <link rel="shortcut icon" href="syge1/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="syge1/images/favicon.ico" type="image/x-icon">
    <link href="syge1/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body background="syge1/images/font.jpg" style="background-repeat:no-repeat">

<form action="" method="post">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
        <!--DWLayoutTable-->
        <tr>
            <td width="424" height="155">&nbsp;</td>
            <td width="661">&nbsp;</td>
            <td width="219">&nbsp;</td>
        </tr>
        <tr>
            <td height="46">&nbsp;</td>
            <td align="center" valign="top"><p class="ecriture_vert_1">SYGE2-UFHB<br />
                    <span class="ecriture_petit_vert">Système de Gestion des Enseignements - Université Félix Houphou&euml;t-Boigny</span></p></td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td height=""></td>
            <td valign="top">

                <?php
                ?>
                <table width="576" border="0" cellpadding="0" cellspacing="0" class="border_green" align="center">
                    <!--DWLayoutTable-->
                    <tr>
                        <td width="572" height="2"></td>
                    </tr>
                    <tr>
                        <td height="28" align="center" valign="top" class="ecriture_vert_2">Veuillez renseigner vos accès</td>
                    </tr>
                    <tr>
                        <td height="3"></td>
                    </tr>




                    <tr>
                        <td height="117" valign="top"><table width="100%" border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                    <td width="33%" rowspan="3"><div align="center"><img src="syge1/images/ufhb.jpg" width="141" height="105" /></div></td>
                                    <td width="67%">&nbsp;<input type="text" name="login" size="40" class="ecriture_formulaire_gris" placeholder=" Identifiant" style="border-color:#009900; border-style:solid" required></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;<input type="password" name="mot_passe" size="40" class="ecriture_formulaire_gris" placeholder=" Mot de passe" style="border-color:#009900; border-style:solid" required></td>
                                </tr>
                                <tr>
                                    <td height="27">&nbsp;<input name="go" type="submit" class="bouton_connexion" value="Connexion">&nbsp;&nbsp;<!--<input name="annuler" type="button" class="bouton_connexion" value="Annuler" onclick="document.location=('index.php')">--><a href="#" class="ecriture_sous_menu">Mot de passe oublié ?
                                        </a></td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr>
                        <td height="30" align="center" valign="middle"><span class="message_erreur2"><?php echo $erreur;?></span><br />

                        </td>
                    </tr>
                </table><?php
                ?></td>
            <td>&nbsp;</td>
        </tr>

        <tr>
            <td height="51"></td>
            <td valign="top" class=""><div align="center">
      <span class="ecriture_copyright">
        <br />
        Copyright © 2017. Université Félix Houphou&euml;t-Boigny. Tous Droits Réservés.<br />
        Powered by NIKKOSA COMMUNICATION.</span><br />
                </div></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td height="83"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>
</form>
</body>
</html>
