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
$debug = false;
/*
?>
<!--
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Neurophysiologie générale</title>
    </head>
    <body>
-->



<?php
*/
$_SESSION['question']++;
//echo '<p>les valeurs de _POST : '.$_POST['group1'].$_POST['group2'].$_POST['group3'].'</p>';
if (isset($_POST['group1']) AND isset($_POST['group2']) AND isset($_POST['group3']))
{
    $aff1 = $_POST['group1'];
    $aff2 = $_POST['group2'];
    $aff3 = $_POST['group3'];
    //echo '<p> les valeur de affXX : '.$aff1.$aff2.$aff3.'</p>';

    //echo '<p> les var de sessions : '.$_SESSION['affirmation1'].$_SESSION['affirmation2'].$_SESSION['affirmation3'].' et les réponse en bdd : <br />';

    $req0 = $bdd->prepare('SELECT ID, answer FROM Question WHERE ID = ? OR ID = ?  OR ID = ?');
    $req0->execute(array($_SESSION['affirmation1'], $_SESSION['affirmation2'], $_SESSION['affirmation3']));
    $i = 0;
    $rep;
    while ($data = $req0->fetch())
    {
        $rep[$i]['id'] = $data['ID'];
        $rep[$i]['answer'] = $data['answer'];
        //echo '- '.$data['ID'].$data['answer'].'_'.$rep[$i]['id'].$rep[$i]['answer'].'<br />';
        $i++;
    }
    //echo '.</p>';
    $req0->closeCursor();

    if($i === 3)
    {
        //echo '<p> on a 3 reponses de la bdd </p>';
        $answer;
        for($j = 0; $j < 3; $j++)
        {
            if ($rep[$j]['answer'] == 0)
            {
                $answer[$j] = "false";
            }elseif(($rep[$j]['answer'] == 1))// OR ($rep[$j]['answer'] == '1'))
            {
                $answer[$j] = "true";
            }
            //echo '<p> traductions n:'.$j.' de '.$rep[$j]['answer'].'vers '.$answer[$j].'<br />';
        }
        if(($aff1 === $answer[0]) AND ($aff2 === $answer[1]) AND ($aff3 === $answer[2]))
        {
            $_SESSION['score']++;
            //echo '<p> Le score est augmenté : '.$_SESSION['score'].'. <br />';

            $req1 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 1)');
            $req1->execute(array($_SESSION['id_simu'], $_SESSION['affirmation1']));
            $req2 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 1)');
            $req2->execute(array($_SESSION['id_simu'], $_SESSION['affirmation2']));
            $req3 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 1)');
            $req3->execute(array($_SESSION['id_simu'], $_SESSION['affirmation3']));

        }else
        {
            //echo '<script> alert("Les réponses de l\'utilisateur :'.$aff1.$aff2.$aff3.' et les réponses de la bdd : '.$answer[0].$answer[1].$answer[2].'."); </script>';
            //echo 'Les réponses de l\'utilisateur :'.$aff1.$aff2.$aff3.' et les réponses de la bdd : '.$answer[0].$answer[1].$answer[2].'</p>';

            if($aff1 === $answer[0]) 
            {
                $req4 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 1)');
                $req4->execute(array($_SESSION['id_simu'], $_SESSION['affirmation1']));
            }else
            {
                $req5 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 0)');
                $req5->execute(array($_SESSION['id_simu'], $_SESSION['affirmation1']));
            }
            if($aff2 === $answer[1]) 
            {
                $req4 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 1)');
                $req4->execute(array($_SESSION['id_simu'], $_SESSION['affirmation2']));
            }else
            {
                $req5 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 0)');
                $req5->execute(array($_SESSION['id_simu'], $_SESSION['affirmation2']));
            }
            if($aff3 === $answer[2]) 
            {
                $req4 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 1)');
                $req4->execute(array($_SESSION['id_simu'], $_SESSION['affirmation3']));
            }else
            {
                $req5 = $bdd->prepare('INSERT INTO `Answer`(`FK_simu`, `FK_quest`, `successful`) VALUES (?, ?, 0)');
                $req5->execute(array($_SESSION['id_simu'], $_SESSION['affirmation3']));
            }
        }
    }else
    {
        //echo '<script> alert("Erreur lors de la transmission des informations.'.$i.' réponses ont été reçue de la bdd."); </script>';
        //echo 'Erreur lors de la transmission des informations.'.$i.' réponses ont été reçue de la bdd.</p>';
    }
}else
{
    //echo '<script> alert("Erreur lors de la transmission des informations. aff1 : '.$_POST['group1'].' aff2 : '.$_POST['group2'].'aff3 : '.$_POST['group3'].'."); </script>';
    //echo '<p> Erreur lors de la transmission des informations. aff1 : '.$_POST['group1'].' aff2 : '.$_POST['group2'].'aff3 : '.$_POST['group3'].'.</p>';
}

if ($_SESSION['question'] > $_SESSION['sum_question'])
{
    header('Location: simu_end.php');
    exit();
}else
{
    header('Location: simulation.php');
    exit();
}
/*<!--<p>
    Traitement fini.
</p>
</body>
</html>-->
*/
?>
