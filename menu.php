<?php 
if(isset($_SESSION['login']))
{ 
	//$monUrl = dirname($_SERVER['SERVER_PROTOCOL']) . "://" .$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	// ex : http:// . localhost:8888 . /NeuroWeb/index.php
	//echo $monUrl;
	echo '<div class="collection">';
    //pour supprimer les paramètres éventuels qui serait passé dans l'url
    $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

	switch ($uri_parts[0]) {
	    case "/NeuroWeb/home.php":
	        echo '<a href="#" class="collection-item active">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
    		';
    		if ($_SESSION['statut_login'] == 1)
    		{
    			echo '<a href="manage_theme.php" class="collection-item">Gestion des thèmes</a>
                <a href="manage_aff.php" class="collection-item">Gestion des affirmations</a>';
    		}
	        break;
	    case "/NeuroWeb/simulation.php":
	    case "/NeuroWeb/simulation_end.php":
	        echo '<a href="home.php" class="collection-item">Accueil</a>
    		<a href="#" class="collection-item active">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
    		';
    		if ($_SESSION['statut_login'] == 1)
    		{
    			echo '<a href="manage_theme.php" class="collection-item">Gestion des thèmes</a>
                <a href="manage_aff.php" class="collection-item">Gestion des affirmations</a>';
    		}
	        break;
	    case "/NeuroWeb/stat.php":
	        echo '<a href="home.php" class="collection-item">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="#" class="collection-item active">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
    		';
    		if ($_SESSION['statut_login'] == 1)
    		{
    			echo '<a href="manage_theme.php" class="collection-item">Gestion des thèmes</a>
                <a href="manage_aff.php" class="collection-item">Gestion des affirmations</a>';
    		}
	        break;
	    case "/NeuroWeb/config.php":
	        echo '<a href="home.php" class="collection-item">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="#" class="collection-item active">Paramètre</a>
    		';
    		if ($_SESSION['statut_login'] == 1)
    		{
    			echo '<a href="manage_theme.php" class="collection-item">Gestion des thèmes</a>
                <a href="manage_aff.php" class="collection-item">Gestion des affirmations</a>';
    		}
	        break;
	    case "/NeuroWeb/manage_theme.php":
            echo '<a href="home.php" class="collection-item">Accueil</a>
            <a href="simulation.php" class="collection-item">Simulation</a>
            <a href="stat.php" class="collection-item">Statistiques</a>
            <a href="config.php" class="collection-item">Paramètre</a>
            <a href="#" class="collection-item active">Gestion des thèmes</a>
            <a href="manage_aff.php" class="collection-item">Gestion des affirmations</a>';
            break;
        case "/NeuroWeb/theme.php":
        case "/NeuroWeb/theme_add.php":
	        echo '<a href="home.php" class="collection-item">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
            <a href="manage_theme.php" class="collection-item active">Gestion des thèmes</a>
            <a href="manage_aff.php" class="collection-item">Gestion des affirmations</a>';
	        break;
        case "/NeuroWeb/manage_aff.php":
            echo '<a href="home.php" class="collection-item">Accueil</a>
            <a href="simulation.php" class="collection-item">Simulation</a>
            <a href="stat.php" class="collection-item">Statistiques</a>
            <a href="config.php" class="collection-item">Paramètre</a>
            <a href="manage_theme.php" class="collection-item">Gestion des thèmes</a>
            <a href="#" class="collection-item active">Gestion des affirmations</a>';
            break;
	    default:
	        echo '<a href="index.php" class="collection-item">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
    		';
	}
	echo '</div>';
}
?>