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
            if (isset($_GET['id']))
            {
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
                    $req = $bdd->prepare('UPDATE Theme SET `number`= ? ,`name`= ? ,`openToSimulation`= ? WHERE ID = ?');
                    $req->execute(array($number, $name, $open, $_GET['id']));
                    $req->closeCursor();
                    echo '<p> Les données ont correctemet été mises à jours. </p>';
                }else{
                  echo '<p> Les données n\'ont pas été correctemet mises à jours.</p>'; // num : '.$number.' name : '.$name.'open : '.$open.'id : '.$_GET['id'].' <br /> et les données POST : '.$_POST['number'].$_POST['name'].$_POST['open'].'
                }
                

                $req = $bdd->prepare('SELECT * FROM Theme WHERE ID = ?');
                $req->execute(array($_GET['id']));
                $i = 0;
                $theme;
                while ($data = $req->fetch())
                {
                    $theme['id'] = $data['ID'];
                    $theme['number'] = $data['number'];
                    $theme['name'] = $data['name'];
                    $theme['open'] = $data['openToSimulation'];
                    $i++;
                }
                //echo "i = ".$i."</p>";
                if ($i == 1)
                {
                  //echo '<p> num : '.$theme['number'].' nom : '.$theme['name'].'</p>';
              ?>
                    <h2> Thème </h2>
                    <div class="row">
                      <?php
                        echo '<form class="col s12" method="post" action="theme.php?id='.$theme['id'].'&amp;send=ok">';
                      ?>
                        <div class="row">
                          <div class="input-field col s12">
                            <!--<input placeholder="Placeholder" id="first_name" type="text" class="validate">-->
                            <?php
                              echo '<input value="'.$theme['number'].'" id="number" name="number" type="text" class="validate">';
                            ?>
                            <label for="number">Numéro : </label>
                          </div>
                          <div class="input-field col s12">
                            <?php
                              echo '<input value="'.$theme['name'].'" id="name" name="name" type="text" class="validate">';
                            ?>
                            <label for="name">Nom du thème :</label>
                          </div>
                          <div class="input-field col s6">
                            <div class="switch">
                              <p><label>Fermé
                              <input id="open" name="open" value="yes" type="checkbox" <?php if($theme['open']){echo 'checked';}?> enable>
                              <span class="lever"></span>
                              Ouvert</label></p>
                            </div>
                            <!--<label for="open">Est-il ouvert ?</label>-->
                          </div>
                          <div class="input-field col s12">
                            <a <?php echo 'href="theme_del.php?id='.$theme['id'].'"'; ?> type="bouton" class="btn waves-effect waves-light teal lighten-2 right" id="btnVerify1" >Supprimer</a>
                            <input type="submit" class="btn waves-effect waves-light teal lighten-2 right" id="btnVerify1" value="Enregistrer" ></input>
                          </div>
                        </div>
                      </form>
                    </div>
                <?php
                }
            }else{
              echo '<p> Il y a eu un problème lors de la navgation vers cette page. merci de bien vouloir retourner vers la page de gestions des questions pour tenter d\'accéder à la page souhaitée </p>';
            }
            ?>

            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
