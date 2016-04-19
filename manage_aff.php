<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

try
{
    $bdd = new PDO('mysql:host=127.0.0.1;port=8889;dbname=Neuro;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //'mysql:host=localhost;dbname=Neuro;charset=utf8', ...'
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer
// si il n'est pas connecter, go index.php
if (!isset($_SESSION['login']) AND !isset($_SESSION['statut_login']) AND ($_SESSION['statut_login'] != 1))
{
header('Location: index.php');
}
unset($_SESSION['score']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <title>Neurophysiologie générale</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="row">
            <div class="col s12 m4 l3" id="nav">
                <?php include("menu.php"); ?>
            </div> <!-- class="col s12 m4 l3" id="nav" -->
            <div class="col s12 m8 l9 offset-m4 offset-l3" id="section">
            
                <h3> Les affirmations : </h3>
                <!--<h4> Les paramètres </h4>
                <p> </p>-->
                <a href="aff_add.php" class="btn-floating btn-large waves-effect waves-light teal lighten-2 right"><i class="material-icons">add</i></a>

                <ul class="collection">
                <?php

                    $req = $bdd->query('SELECT Question.ID AS ID, textQuestion AS txt, Theme.number AS th_number FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID ORDER BY Theme.number ASC');
            $i = 0;
            $aff;
            while ($data = $req->fetch())
            {
                $aff[$i]['id'] = $data['ID'];
                $aff[$i]['txt'] = $data['txt'];
                $aff[$i]['th_number'] = $data['th_number'];
                $i++;
            }
            $req->closeCursor();

            for ($j = 0; $j < $i; $j++)
            {
                ?>
                <li class="collection-item avatar">
                    <a <?php echo 'href="aff.php?id='.$aff[$j]['id'].'" ';?> class="collection-item">
                    <i class="material-icons circle">toc</i>
                    <span class="title"> Thème n° :<?php echo $aff[$j]['th_number']; ?> </span>
                    <p> <?php echo $aff[$j]['txt']; ?> </p></a></li>
                <?php      
            }
            ?>
            </ul>

            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>
</html>
