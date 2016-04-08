<?php
unset($_SESSION);
session_unset();
session_destroy(); // On quitte la session en court

        if (isset($_SESSION['login']))
        {
        ?>
        	<script>
        		alert("var non vide	")
        	</script>
        <?php
        }/*else{
        ?>
        	<script>
        		alert("var vide	")
        	</script>
        <?php
        }*/
// Redirection du visiteur vers la page d'acceuil
header('Location: index.php');
?>