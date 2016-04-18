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
            
            <?php 
            if (isset($_POST['number']) AND isset($_POST['name']) )//AND isset($_POST['open']))
            {
                $number = $_POST['number'];
                $name = $_POST['name'];
                $open= "";
                if (isset($_POST['open']) && $_POST['open'] == 'yes')
                {
                    $open = 1;
                }else{
                    $open = 0;
                }
                //echo 'INSERT INTO Theme (`number`,`name`,`openToSimulation`) VALUES('.$number.','.$name.','.$open.')';
                $req = $bdd->prepare('INSERT INTO Theme (`number`,`name`,`openToSimulation`) VALUES (?, ?, ?)');
                $req->execute(array($number, $name, $open));
                //$req->closeCursor();

                echo '<p> Les données ont correctemet été ajoutées. </p>';
            //}else{
              //echo '<p> Les données n\'ont pas été correctemet ajoutées.</p>'; // num : '.$number.' name : '.$name.'open : '.$open.'id : '.$_GET['id'].' <br /> et les données POST : '.$_POST['number'].$_POST['name'].$_POST['open'].'
            }
            ?>
            <h2> Thème </h2>
            <div class="row">
                <form class="col s12" method="post" action="theme_add.php">
                    <div class="row">
                      <div class="input-field col s12">
                        <input  id="number" name="number" type="number" class="validate">
                        <label for="number">Numéro : </label>
                      </div>
                      <div class="input-field col s12">
                        <input id="name" name="name" type="text" class="validate">
                        <label for="name">Nom du thème :</label>
                      </div>
                      <div class="input-field col s6">
                        <div class="switch">
                          <p><label>Fermé
                          <input id="open" name="open" value="yes" type="checkbox" enable>
                          <span class="lever"></span>
                          Ouvert</label></p>
                        </div>
                      </div>
                      <div class="input-field col s12">
                        <input type="submit" class="btn waves-effect waves-light teal lighten-2 right" id="btnVerify1" value="Enregistrer" ></input>
                      </div>
                    </div>
                </form>
            </div>

            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
