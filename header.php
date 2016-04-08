<header class="teal lighten-2">
    <img src="font/LogoFacMed.jpg" />
    <h1>Neurophysiologie générale</h1>
    <?php 
    if(isset($_SESSION['prenom']) AND isset($_SESSION['nom']))
    {
    ?>
        <a class="right" href='close.php' >
            <div class="chip">
                <i class="material-icons right">power_settings_new</i> 
                <?php
            	   echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
                ?> 
    		</div>
        </a>
    <?php
    }
    ?>
</header>