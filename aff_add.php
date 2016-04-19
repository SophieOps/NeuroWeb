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
                if (isset($_POST['theme']) AND isset($_POST['affirmation']))//AND isset($_POST['true']))
                {
                    $th_id = $_POST['theme'];
                    $txt = $_POST['affirmation'];
                    $answer= "";
                    if (isset($_POST['true']) && $_POST['true'] == 'yes')
                    {
                        $answer = 1;
                    }else{
                        $answer = 0;
                    }
                    $req = $bdd->prepare('INSERT INTO Question (textQuestion, answer, FK_theme ) VALUES (?, ?, ?)');
                    $req->execute(array($txt, $answer, $th_id));
                    $req->closeCursor();


                echo '<p> Les données ont correctemet été ajoutées. </p>';
            //}else{
              //echo '<p> Les données n\'ont pas été correctemet ajoutées.</p>'; // num : '.$number.' name : '.$name.'open : '.$open.'id : '.$_GET['id'].' <br /> et les données POST : '.$_POST['number'].$_POST['name'].$_POST['open'].'
            }
            ?>
            <h2> Affirmation </h2>
            <div class="row">
                <form class="col s12" method="post" action="aff_add.php">
                    <div class="row">
                      <div class="input-field col s12">


                            <select name="theme" class="browser-default">
                            <option value="" disabled selected>Choisissez parmi les thèmes existants</option>
                            <?php
                            $req_th = $bdd->query('SELECT * FROM Theme ORDER BY number ASC');
                            $i = 0;
                            $theme;
                            while ($data = $req_th->fetch())
                            {
                                $theme[$i]['id'] = $data['ID'];
                                $theme[$i]['number'] = $data['number'];
                                $theme[$i]['name'] = $data['name'];
                                //$theme['open'] = $data['openToSimulation'];
                                $i++;
                            }
                            $req_th->closeCursor();

                            for ($j = 0; $j < $i; $j++)
                            {
                                echo '<option value="'.$theme[$j]['id'].'" > Theme '.$theme[$j]['number'].' : '.$theme[$j]['name'].'</option>';
                            }  
                            ?>
                            </select>
                          </div>
                          <div class="input-field col s12">
                            <textarea name="affirmation" ></textarea>
                            <label for="affrmation">Texte de l'affirmation :</label>
                          </div>
                          <div class="input-field col s12">
                            <div class="switch">
                              <p><label>Faux
                              <input id="true" name="true" value="yes" type="checkbox" enable>
                              <span class="lever"></span>
                              Vrai</label></p>
                            </div>
                            <!--<label for="open">Est-il ouvert ?</label>-->
                          </div>
                          <div class="input-field col s12">
                            <input type="submit" class="btn waves-effect waves-light teal lighten-2 right" id="btnSave" value="Enregistrer" ></input>
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
