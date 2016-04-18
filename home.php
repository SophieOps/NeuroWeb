<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=127.0.0.1;port=8889;dbname=Neuro;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //'mysql:host=localhost;dbname=Neuro;charset=utf8', ...'
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
        <?php
        // si il tente de se connecter
        if (isset($_POST['login']) AND isset($_POST['password']))
        {
        ?> 
        <script>
            alert("ouverture de session avec les variables _POST");
        </script>
        <?php 
            // On récupère les user avec le même login
            //$reponse = $bdd->query('SELECT * FROM user');
            //quand on veut utiliser des variables pour composer la requête : 
            $req = $bdd->prepare('SELECT * FROM User WHERE login = ?');
            $req->execute(array($_POST['login']));

            $i = 0;
            $data;
            while ($dta = $req->fetch())
            {
                $i++;
                $data['firstname'] = $dta['firstname'];
                $data['name'] = $dta['name'];
                $data['login'] = $dta['login'];
                $data['pswd'] = $dta['pswd'];
                $data['ID'] = $dta['ID'];  
                $data['FK_statut'] = $dta['FK_statut'];
            }
            echo "i = ".$i."</p>";
            if ($i == 1)
            {
                if(($_POST['login'] === $data['login']) AND ($_POST['password'] === $data['pswd']))
                {
                    /*unset($_SESSION);
                    session_unset();
                    session_destroy(); // On quitte la session en court*/

                    $_SESSION['prenom'] = $data['firstname'];
                    $_SESSION['nom'] = $data['name'];
                    $_SESSION['login'] = $data['login'];
                    $_SESSION['id_login'] = $data['ID'];  
                    $_SESSION['statut_login'] = $data['FK_statut'];     
                    //setcookie('login', $_SESSION['login'], time() + 365*24*3600, null, null, false, true);
                    echo "<p>session créée.</p>";
                }else{
                    echo "<p> session non créée. LOG".$_POST['login'].$data['login']."PASS".$_POST['password'].$data['pswd']."</p>";
                }
            }
            $req->closeCursor(); // Termine le traitement de la requête
        }
        ?>
        <?php include("header.php"); ?>
        <div class="row">
            <div class="col s12 m4 l3" id="nav">
                <?php include("menu.php"); ?>
            </div> <!-- class="col s12 m4 l3" id="nav" -->
            <div class="col s12 m8 l9 offset-m4 offset-l3" id="section">
                <p>
                Bienvenue à toutes et à tous.<br />
                Vous voici sur le site de simlation d'examen pour le cours de Neurohpysiologie générale.
                Le volet de navigation à gauche permet d'accéder aux différents éléments du site.<br />
                <br />
                NB : Si certains éléments s'affiche mal, favoriser des navigateurs à jours.<br />
                </p>
            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>
</html>