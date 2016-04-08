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

  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input disabled value="SophieO" id="disabled" type="text" class="validate">
            <label for="disabled">Login</label>
          <!--<input placeholder="Placeholder" id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>-->
        </div>
        <!--<div class="input-field col s6">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>-->
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password1" type="password" class="validate">
          <label for="password">Nouveau mot de passe</label>          
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="password2" type="password" class="validate">
          <label for="password">Nouveau mot de passe</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email">Email</label>
        </div>
      </div>
    </form>
  </div>




        <a class="waves-effect waves-light btn" href="home.html/#saved"><i class="material-icons left">done</i>Sauvegarder</a>

            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>
</html>
