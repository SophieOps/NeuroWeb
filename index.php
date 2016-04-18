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
                <p>
                Bienvenue à toutes et à tous. <br />
                Veillez vous identifer. <br />
                En attendant que ce module soit mis en place, veillez accéder à la page <strong>home.php </strong> .
                </p>
                <p>
                    <form method="post" action="home.php">
                        <p>
                            <label for="login">Votre login : </label>
                            <input type="text" name="login" id="login" placeholder="Login" autofocus required/>
                            <br />
                            <label for="password">Votre mot de passe : </label>
                            <input type="password" name="password" id="password" placeholder="Mot de passe" required/>
                            <br />
                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit <i class="material-icons right">send</i>
                            </button>
                            <!--<input type="submit" value="Valider" />-->
                        </p>
                    </form>
                </p>
            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>
</html>
