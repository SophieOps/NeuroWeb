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
                //echo '<p> id (get) : '.$_GET['id'].'</p>';
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
                    $req = $bdd->prepare('UPDATE Question SET textQuestion = ?, answer = ?, FK_theme = ? WHERE ID = ?');
                    $req->execute(array($txt, $answer, $th_id, $_GET['id']));
                    $req->closeCursor();

                    echo '<p> Les données ont correctemet été mises à jours. </p>';
                }else{
                  echo '<p> Les données n\'ont pas été correctemet mises à jours.id : '.$_GET['id'].' <br /> et les données POST : '.$_POST['theme'].$_POST['affirmation'].$_POST['true'].'</p>'; // 
                }


                //SELECT Question.ID AS ID, textQuestion AS txt, answer, Theme.number AS th_number FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID ORDER BY Theme.number ASC');

                $req = $bdd->prepare('SELECT Question.ID AS ID, textQuestion AS txt, answer, Theme.number AS th_number, Theme.name AS th_name, Theme.ID AS th_id FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE Question.ID = ?');
                $req->execute(array($_GET['id']));
                $i = 0;
                $aff;
                while ($data = $req->fetch())
                {
                    $aff['id'] = $data['ID'];
                    $aff['txt'] = $data['txt'];
                    $aff['answer'] = $data['answer'];
                    $aff['th_number'] = $data['th_number'];
                    $aff['th_name'] = $data['th_name'];
                    $aff['th_id'] = $data['th_id'];
                    $i++;
                }
                $req->closeCursor();
                //echo "i = ".$i."</p>";
                if ($i == 1)
                {
                    //echo '<p> id : '.$aff['id'].' txt : '.$aff['txt'].'</p>';
                ?>
                    <h2> Affirmation </h2>
                    <div class="row">
                    <form class="col s12" method="post" <?php echo 'action="aff.php?id='.$aff['id'].'&amp;send=ok"'; ?> >
                        <div class="row">
                            <div class="input-field col s12">
                            <!--<label for="theme">Theme : </label>-->
                            <select name="theme" class="browser-default">
                            <option value="" disabled >Choisissez parmi les thèmes existants</option>
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
                                echo '<option value="'.$theme[$j]['id'].'" ';
                                if($theme[$j]['id'] == $aff['th_id'])
                                {
                                    echo 'selected';
                                }
                                echo '> Theme '.$theme[$j]['number'].' : '.$theme[$j]['name'].'</option>';
                            }  
                            ?>
                            </select>
                          </div>
                          <div class="input-field col s12">
                            <!--<input placeholder="Placeholder" id="first_name" type="text" class="validate">
                            rows="30" cols="45"-->
                            <textarea name="affirmation" ><?php
                              echo $aff['txt'];
                            ?></textarea>
                            <label for="affrmation">Texte de l'affirmation :</label>
                          </div>
                          <div class="input-field col s12">
                            <div class="switch">
                              <p><label>Faux
                              <input id="true" name="true" value="yes" type="checkbox" <?php if($aff['answer']){echo 'checked';}?> enable>
                              <span class="lever"></span>
                              Vrai</label></p>
                            </div>
                            <!--<label for="open">Est-il ouvert ?</label>-->
                          </div>
                          <div class="input-field col s12">
                            <a <?php echo 'href="aff_del.php?id='.$af['id'].'"'; ?> type="bouton" class="btn waves-effect waves-light teal lighten-2 right" id="btnDel" >Supprimer</a>
                            <input type="submit" class="btn waves-effect waves-light teal lighten-2 right" id="btnSave" value="Enregistrer" ></input>
                          </div>
                        </div>
                      </form>
                    </div>
                <?php
                }else{
                    echo '<p> il y a eu un probème lors de la requête, plusieurs résultats sont sorti. i = '.$i.'.';
                }
            }else{
              echo '<p> Il y a eu un problème lors de la navgation vers cette page. merci de bien vouloir retourner vers la page de gestions des affirmations pour tenter d\'accéder à la page souhaitée </p>';
            }
            ?>

            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
