<?php
ob_start();
?>
    <br>
    <h1>Oups vous vous êtes perdu :(</h1>

    <h4><a href="index.php?action=home">Revenir à l'accueil</a></h4>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>