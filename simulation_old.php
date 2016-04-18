<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=Neuro;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
// si c'est la première question
if (!isset($_POST['score']))
{
  $score = 0;
  $question = 1;
  $next = "simulation.php";
  $req = $bdd->query('SELECT * FROM Theme WHERE openToSimulation ORDER BY number ASC');
  $i = 0;
  $theme;
  while ($data = $req->fetch())
  {
    $theme[$i]['id'] = $data['ID'];
    $theme[$i]['number'] = $data['number'];
    $theme[$i]['name'] = $data['name'];
    $i++;
  }
  $req->closeCursor();
  $sum_question = $i;
  $sum_for = $sum_question-1;
  $current_theme_id = $theme[0]['id'];
}else
{
  $score = $_POST['score'];
  $question = $_POST['question'] +1;
  $theme = $_POST['theme'];
  $sum_question = $_POST['sum_question'];
  $next_theme = false;
  $current_theme_id = 0;
  $sum_for = $sum_question-1;
  for($j = 0; $j<=$sum_for; $j++)
  {
    if($next_theme){
      $current_theme_id = $theme[$j]['id'];
    }elseif($theme[$j]['id'] == $_POST['current_theme_id']){
      $next_theme = true;
    }
  }

//TODO : vérifier les réponses et indiquer si la question précédente était réussie ou non
  if ($_POST['group1'] AND $_POST['group2'] AND $_POST['group3'])
  {
    $score ++;
    echo '<p> <img src="font/emo_).png" id="happy"/> </p>';
  }else{
    echo'<p> <img src="font/emo_(.png" id="sad"/> </p>';
  }
  if ($question >= $sum_question)
  {
    $next = "simulation_end.php";
  }else
  {
    $next = "simulation.php";
  }
}
echo "<p>".$score." ".$question." ".$next." ".$sum_question." ".$sum_for." ".$current_theme_id." .</br>";
for($x = 0; $x <= $sum_for; $x++){
  echo $theme[$x]['id']." ".$theme[$x]['number']." ".$theme[$x]['name'].".<br/>";
}
echo "</p>";

// les questions du thème numero 1 : 
  //SELECT * FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE number = 1

            //$questions = $bdd->query('SELECT * FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE number = ?');
/*
            $rep = $bdd->prepare('SELECT id, textQuestion AS txt FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE Theme.ID = ?');
            $rep->execute(array($current_theme_id));
*/
            $rep = $bdd->query('SELECT Question.ID, textQuestion AS txt FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE Theme.ID = 1');
            
            $i = 0;
            $questions;
            echo "<p>";
            while ($data = $rep->fetch())
            {
                $questions[$i]['text'] = $data['txt'];
                //$questions[$i]['answer'] = $data['answer'];
                $questions[$i]['id'] = $data['ID'];
                echo $data['txt']." - ".$questions[$i]['text']."..<br/>";
                $i++;
            }
            $rep->closeCursor();
            echo $i."<br/> </p>";

            //echo '<form method="post" action='.$next.'>'; ?>
            <form method="post" action="traitement.php">
  	            <h2>Question <?php echo $question; ?> : </h2>
  	            <p> 
  	            	Votre score actuel : <h3 id="score"> <?php echo $score; ?>/<?php echo $sum_question; ?> </h3>
  	            </p>
                <fieldset id="a1">
                  <legend>1 : <?php echo $questions[0]['text']; ?></legend> <!-- Titre du fieldset --> 
  	            	<div class"radio">
                  <!-- l'att for dans le label doit-être le même que l'id de l'input-->
          					<input name="group1" type="radio" id="test1true" value="true" />
          					<label for="test1true"><div class="chip">Correct</div></label>
  				        	<input name="group1" type="radio" id="test1false" value="false" />
  				        	<label for="test1false"><div class="chip">Erroné</div></label>
                	</div>
                  <!-- l'attribut 'id' de l'input doit être identique à l'attribut 'for' du label-->
  	            </fieldset>
  	            <fieldset id="a1">
                  <legend>2 : <?php echo $questions[1]['text']; ?></legend> <!-- Titre du fieldset --> 
  	            	<div class"radio">
        					  <input name="group2" type="radio" id="test2true" value="true"  />
           					<label for="test2true"><div class="chip">Correct</div></label>
  	   			      	<input name="group2" type="radio" id="test2false" value="false" />
  		  		      	<label for="test2false"><div class="chip">Erroné</div></label>
                	</div>
  	            </fieldset>
                <fieldset id="a1">
                  <legend>3 : <?php echo $questions[2]['text']; ?></legend> <!-- Titre du fieldset --> 
                  <div class"radio">
        					 <input name="group3" type="radio" id="test3true" value="true"  />
        					 <label for="test3true"><div class="chip">Correct</div></label>
  				      	 <input name="group3" type="radio" id="test3false" value="false" />
  				      	 <label for="test3false"><div class="chip">Erroné</div></label>
                  </div>
  	            </fieldset>   
                <!--<bouton class="btn waves-effect waves-light teal lighten-2 disabled" id="btnVerify" type="submit">Vérifier les réponses <i class="material-icons right">send</i>
                </bouton>-->
                <input type="submit" class="btn waves-effect waves-light teal lighten-2" id="btnVerify1" value="Vérifier les réponses !" ></input>


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
