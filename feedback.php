<?php
session_start(); // On démarre la session AVANT toute chose
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
        </header>
        <div class="row">
            <div class="col s12 m4 l3" id="nav">
                <div class="collection">
                    <a href="index.php" class="collection-item">Accueil</a>
                    <a href="simulation.php" class="collection-item">Simulation</a>
                    <a href="#" class="collection-item active">Statistiques</a>
                    <a href="config.php" class="collection-item">Paramètre</a>
                </div>
            </div> <!-- class="col s12 m4 l3" id="nav" -->
            <div class="col s12 m8 l9 offset-m4 offset-l3" id="section">

                <h2> Envoyer un feedback </h2>
                <table >
                    <thead>
                        <tr>
                            <th data-field="key1"></th>
                            <th data-field="value1"></th>
                            <th data-field="key2"></th>
                            <th data-field="value2"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Titre</td>
                            <td><input /></td>
                            <td>Date</td>
                            <td><input type="date" class="datepicker"></td>
                        </tr>
                        <tr>
                            <td>Vous êtes : </td>
                            <td>    
                                <ul class="collection">
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test1" />
                                        <label for="test1"><div class="chip"><img src="images/Student.jpg" alt="Contact Person">Un étudiant</div></label>
                                    </li>
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test2" />
                                        <label for="test2"><div class="chip"><img src="images/Teacher.jpg" alt="Contact Person">Un professeur</div></label>
                                    </li>
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test2" />
                                        <label for="test2"><div class="chip"><img src="images/Other.jpg" alt="Contact Person">Autre</div></label>
                                    </li>
                                </ul>
                            </td>
                            <td>Cela concerne : </td>
                            <td>    
                                <ul class="collection">
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test1" />
                                        <label for="test1"><div class="chip"><img src="images/Android.jpg" alt="Contact Person">L'application sous android</div></label>
                                    </li>
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test2" />
                                        <label for="test2"><div class="chip"><img src="images/IOS.jpg" alt="Contact Person">L'application sous Ios</div></label>
                                    </li>
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test1" />
                                        <label for="test1"><div class="chip"><img src="images/WP.jpg" alt="Contact Person">L'application sous Windows Phone</div></label>
                                    </li>
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test2" />
                                        <label for="test2"><div class="chip"><img src="images/Web.jpg" alt="Contact Person">Le site internet</div></label>
                                    </li>
                                    <li class="collection-item">
                                        <input name="group1" type="radio" id="test2" />
                                        <label for="test2"><div class="chip"><img src="images/Other.jpg" alt="Contact Person">Autre</div></label>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Commentaires</td>
                            <td colspan="3">
                                <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                                    <label for="textarea1"></label>
                                </div> 
                            </td>
                        </tr>
                    </tbody>
                </table>


                 <a class="waves-effect waves-light btn" href="home.html/#send"><i class="material-icons left">done</i>Envoyer</a>

            </div> <!-- class="col s12 m4 l9" id="section" -->
        </div> <!-- class="row" -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

    </body>
</html>
