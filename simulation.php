<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=127.0.0.1;port=8889;dbname=Neuro;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
    //$bdd = new PDO('mysql:host=localhost;dbname=Neuro;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
// Si tout va bien, on peut continuer

// si il n'est pas connecter, go index.php
if (!isset($_SESSION['login']))
{
    header('Location: index.php');
}
$DEBUG = false;
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
            $req = $bdd->query('SELECT * FROM Theme WHERE openToSimulation ORDER BY number ASC');
            $i = 0;
            $theme;
if($DEBUG){ echo '<p>'; }
            while ($data = $req->fetch())
            {
                $theme[$i]['id'] = $data['ID'];
                $theme[$i]['number'] = $data['number'];
                $theme[$i]['name'] = $data['name'];
                $i++;
            }
if($DEBUG){ echo '</p>'; }
            $req->closeCursor();
            // si c'est la première question
            if (!isset($_SESSION['score']))
            {
                $_SESSION['score'] = 0;
                $_SESSION['question'] = 1;
                $_SESSION['sum_question'] = $i;
                $_SESSION['theme_id'] = $theme[0]['id'];

                /*$ip = "127.0.0.1";
                if ($_SERVER['REMOTE_ADDR'] != null)
                {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }else
                {
                    echo '<script> alert("Il n\'y a pas d\'ip pour la machine."); </script>';
                }
if($DEBUG){ echo '<p> adresse IP : "'.$ip.'".</p>'; }
                $rep = $bdd->prepare('INSERT INTO `Source`(`FK_type`, `IPAddress`) VALUES (2, ?)');//(avec FK_type = 2 ordinateur)
                $rep->execute(array($ip));*/
                $id_log = 2;
                if ($_SESSION['id_login'] != null)
                {
                    $id_log = $_SESSION['id_login'];
                }else
                {
                    echo '<script> alert("Il n\'y a pas d\'id pour le login."); </script>';
                }
if($DEBUG){ echo '<p> id login : "'.$id_log.'".</p>'; }
                /*$req0 = $bdd->prepare('INSERT INTO `Simulation`(`FK_User`) VALUES (?)');
                $req0->execute(array($id_log));
                $_SESSION['id_simu'] = $bdd->lastInsertId();
                $req0->closeCursor();*/

if($DEBUG){ echo '<p> Les données ont bien été enregistrée en bdd : id simu : '.$_SESSION['id_simu'].'.</p>' ; }

            }else
            {
if($DEBUG){ echo '<p> Ce n\'est pas la première question.</p>'; }
                $previous_theme = $_SESSION['theme_id'];
                $next_theme = false;
                for ($j = 0; $j < $_SESSION['sum_question']; $j++)
                {
                    if($next_theme)
                    {
                        $_SESSION['theme_id'] = $theme[$j]['id'];
                        $next_theme = false;
                    }elseif($theme[$j]['id'] == $_SESSION['theme_id'])
                    {
                        $next_theme = true;
                    }
                }
            }
if($DEBUG) 
{ 
    $sum_for = $_SESSION['sum_question']-1;
    echo "<p>".$_SESSION['score']." ".$_SESSION['question']." "." ".$_SESSION['sum_question']." ".$sum_for." ".$_SESSION['theme_id']." .</br>";
    for($x = 0; $x <= $sum_for; $x++)
    {
        echo $theme[$x]['id']." ".$theme[$x]['number']." ".$theme[$x]['name'].".<br />";
    }
    echo "</p>"; 
}
/* on sélectionne les affirmations à afficher */
            $rep = $bdd->prepare('SELECT Question.ID, textQuestion AS txt FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE Theme.ID = ?');
            $rep->execute(array($_SESSION['theme_id']));

//            $rep = $bdd->query('SELECT Question.ID, textQuestion AS txt FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE Theme.ID = 1');
            
            $i = 0;
            $questions;
            //echo "<p>";
            while ($data = $rep->fetch())
            {
                $questions[$i]['text'] = $data['txt'];
                //$questions[$i]['answer'] = $data['answer'];
                $questions[$i]['id'] = $data['ID'];
if($DEBUG){ echo $data['txt']." - ".$questions[$i]['text']."..<br/>";}
                $i++;
            }
            $rep->closeCursor();
            //echo $i."<br/> </p>";
            //TODO : choisir aléatoirement les questions
            //setCookie("affirmationXX", ID de la question);
            /*setCookie("affirmation1", "0", time() + 24*3600);
            setCookie("affirmation2", "1", time() + 24*3600);
            setCookie("affirmation3", "3", time() + 24*3600);*/

            $i--;
            $aff1 = $aff2 = $aff3 = 0;
            $aff1 = rand(0, $i);
            do {
                $aff2 = rand(0, $i);
            }while ($aff2 == $aff1);
            do {
                $aff2 = rand(0, $i);
            }while (($aff3 == $aff1) OR ($aff3 == $aff2));

            $_SESSION["affirmation1"] = $questions[$aff1]['id'];
            $_SESSION["affirmation2"] = $questions[$aff2]['id'];
            $_SESSION["affirmation3"] = $questions[$aff3]['id'];

            echo 'les valeurs aléatoire des questions sont : '.$aff1.$aff2.$aff3.' et les id corrspondant : '.$_SESSION["affirmation1"].$_SESSION["affirmation2"].$_SESSION["affirmation3"];
            //echo '<form method="post" action='.$next.'>';

            ?>
            <form method="post" action="traitement.php">
  	            <h2>Question <?php echo $_SESSION['question']; ?> : </h2>
  	            <p> 
  	            	  Votre score actuel : <span id="score"> <?php echo $_SESSION['score']; ?>/<?php echo $_SESSION['sum_question']; ?> </span>
  	            </p>
                <fieldset id="a1">
                    <legend>1 : <?php echo $questions[$aff1]['text']; ?></legend> <!-- Titre du fieldset --> 
  	            	  <div class"radio">
                    <!-- l'att for dans le label doit-être le même que l'id de l'input-->
          					    <input name="group1" type="radio" id="test1true" value="true" />
          					    <label for="test1true"><div class="chip">Correct</div></label>
  				        	    <input name="group1" type="radio" id="test1false" value="false" />
  				        	    <label for="test1false"><div class="chip">Erroné</div></label>
                	  </div>
  	            </fieldset>
  	            <fieldset id="a1">
                    <legend>2 : <?php echo $questions[$aff2]['text']; ?></legend> <!-- Titre du fieldset --> 
  	            	  <div class"radio">
        					      <input name="group2" type="radio" id="test2true" value="true"  />
           					    <label for="test2true"><div class="chip">Correct</div></label>
  	   			      	    <input name="group2" type="radio" id="test2false" value="false" />
  		  		      	   <label for="test2false"><div class="chip">Erroné</div></label>
                	  </div>
  	            </fieldset>
                <fieldset id="a1">
                    <legend>3 : <?php echo $questions[$aff3]['text']; ?></legend> <!-- Titre du fieldset --> 
                    <div class"radio">
        					      <input name="group3" type="radio" id="test3true" value="true"  />
        					      <label for="test3true"><div class="chip">Correct</div></label>
  				      	      <input name="group3" type="radio" id="test3false" value="false" />
  				      	      <label for="test3false"><div class="chip">Erroné</div></label>
                    </div>
  	            </fieldset>   
                <!--<bouton class="btn waves-effect waves-light teal lighten-2 disabled" id="btnVerify" type="submit">Vérifier les réponses <i class="material-icons right">send</i>
                </bouton>-->
                <input type="submit" class="btn waves-effect waves-light teal lighten-2" id="btnVerify1" value="Question suivante" ></input>
                <?php
                //TODO : vérifier les réponses et indiquer si la question précédente était réussie ou non
                    if ($_SESSION['pass_ok'])
                    {
                        echo '<p> <img src="font/emo_).png" id="happy"/> </p>';
                    }
                    if ($_SESSION['pass_nok'])
                    {
                        echo'<p> <img src="font/emo_(.png" id="sad"/> </p>';
                    }
                ?>

                <!-- 
                <bouton type="submit" class="waves-effect waves-light btn right disabled" href="simulation2.html/"><i class="material-icons left">done_all</i>Passer à la question suivante</bouton> 
                <input type="submit" value="Valider" /> 
                <a class="waves-effect waves-light btn disabled" href="<?php echo $next ?>" id="btnVerify" ><i class="material-icons left">done</i>Vérifier</a>
                après un submit, il faut veillez à échaper ce qui est reçu pour éviter les injections XSS avec la fonction : htmlspecialchars ou strip_tags (qui retire les balises html) -->
            </form>
  				

        </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->




        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      	<script type="text/javascript" src="js/materialize.min.js"></script>
      	<script type="text/javascript" src="js/simu.js"></script>

    </body>
</html>
