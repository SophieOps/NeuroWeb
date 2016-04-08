<?php 
if(isset($_SESSION['login']))
{ 
	//$monUrl = dirname($_SERVER['SERVER_PROTOCOL']) . "://" .$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
	// ex : http:// . localhost:8888 . /NeuroWeb/index.php
	//echo $monUrl;
	echo '<div class="collection">';
	switch ($_SERVER['REQUEST_URI']) {
	    case "/NeuroWeb/home.php":
	        echo '<a href="#" class="collection-item active">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
    		';
	        break;
	    case "/NeuroWeb/simulation.php":
	        echo '<a href="home.php" class="collection-item">Accueil</a>
    		<a href="#" class="collection-item active">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
    		';
	        break;
	    case "/NeuroWeb/stat.php":
	        echo '<a href="home.php" class="collection-item">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="#" class="collection-item active">Statistiques</a>
    		<a href="config.php" class="collection-item">Paramètre</a>
    		';
	        break;
	    case "/NeuroWeb/config.php":
	        echo '<a href="home.php" class="collection-item">Accueil</a>
    		<a href="simulation.php" class="collection-item">Simulation</a>
    		<a href="stat.php" class="collection-item">Statistiques</a>
    		<a href="#" class="collection-item active">Paramètre</a>
    		';
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