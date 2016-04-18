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


if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $req = $bdd->prepare('DELETE FROM Theme WHERE ID = ? ');
    $req0->execute(array($id));
    
    header('Location: manage.php');
    exit();
}
?>
