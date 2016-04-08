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
                $i++;
                $theme[$i]['id'] = $data['ID'];
                $theme[$i]['number'] = $data['number'];
                $theme[$i]['name'] = $data['name'];
            }
            $req->closeCursor();
            $sum_question = $i;
            $current_theme = $theme[1]['number'];

}else
{
  $score = $_POST['score'];
  $question = $_POST['question'] ++;
  $theme = $_POST['theme'];
  $sum_question = $_POST['sum_question'];
  $current_theme = $theme[$_POST['current_theme']++]['id'];


//TODO : vérifier les réponses
  if ($_POST['group1'] AND $_POST['group2'] AND $_POST['group3'])
  {
    $score ++;
  }
  if ($question >= $sum_question)
  {
    $next = "simulation_end.php";
  }
}
//aller chercher les questions : 
// les questions du thème numero 1 : 
  //SELECT * FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE number = 1



            //$questions = $bdd->query('SELECT * FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE number = ?');

            $req = $bdd->prepare('SELECT textQuestion FROM Question INNER JOIN Theme ON Question.FK_theme = Theme.ID WHERE number = ?');
            $req->execute(array($current_theme));

            $i = 0;
            $question;
            while ($data = $req->fetch())
            {
                $i++;
                $question[$i]['text'] = $data['textQuestion'];
            }
            $req->closeCursor();
?>           
              <form method="post" action=<?php echo $next ?>>
  	            <h2>Question <?php echo $question; ?> : </h2>
  	            <p> 
  	            	Votre score actuel : <span id="score"> <?php echo $score; ?>/<?php echo $sum_question; ?> </span>
  	            </p>
  	            <h5>1 : </h5>
  	            <p> <div id="a1">
  	            	  <?php echo $question[1]['text']; ?>
                  </div>
  	            	<div class"radio">
          					<input name="group1" type="radio" id="test1true" value="true" />
          					<label for="test1true"><div class="chip">Correct</div></label>
  				        	<input name="group1" type="radio" id="test1false" value="false" />
  				        	<label for="test1false"><div class="chip">Erroné</div></label>
                	</div>
                  <!-- l'attribut 'id' de l'input doit être identique à l'attribut 'for' du label-->
  	            </p>
  	            <h5>2 : </h5>
  	            <p> <div id="a2">
                    <?php echo $question[2]['text']; ?>
                  </div>
  	            	<div class"radio">
        					<input name="group2" type="radio" id="test2true" value="true"  />
        					<label for="test2true"><div class="chip">Correct</div></label>
  				      	<input name="group2" type="radio" id="test2false" value="false" />
  				      	<label for="test2false"><div class="chip">Erroné</div></label>
                  	</div>
  	            </p>
  	            <h5>3 : </h5>
  	            <p> <div id="a3">
                    <?php echo $question[3]['text']; ?>
                  </div>
  	            	<div class"radio">
        					<input name="group3" type="radio" id="test3true" value="true"  />
        					<label for="test3true"><div class="chip">Correct</div></label>
  				      	<input name="group3" type="radio" id="test3false" value="false" />
  				      	<label for="test3false"><div class="chip">Erroné</div></label>
                  	</div>
  	            </p>
                <input type="submit" class="waves-effect waves-light btn disabled" value="Valider" id="btnVerify"/>
              </form>
            <!--<input type="submit" value="Valider" /> 
  				<a class="waves-effect waves-light btn disabled" href="<?php echo $next ?>" id="btnVerify" ><i class="material-icons left">done</i>Vérifier</a>-->
  				<p>
  					<!--pour indiquer si la question est réussie ou non -->
  				</p>

  	            <a class="waves-effect waves-light btn right disabled" href="simulation2.html/"><i class="material-icons left">done_all</i>Passer à la question suivante</a> <!-- not_interested-->
                <!-- après un submit, il faut veillez à échaper ce qui est reçu pour éviter les injections XSS avec la fonction : htmlspecialchars ou strip_tags (qui retire les balises html) -->

            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->




        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      	<script type="text/javascript" src="js/materialize.min.js"></script>
      	<script type="text/javascript" src="js/simu.js"></script>

    </body>
</html>
