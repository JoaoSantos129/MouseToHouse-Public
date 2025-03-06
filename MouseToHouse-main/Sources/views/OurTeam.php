
<?php
ob_start();
?>
<h1>Notre Équipe </h1>
<h2>Cette équipe est composée de trois membres, les voici;</h2><br>
<h5>Notre membre le plus proffesionnel, il n'as pas besoin de debugger, il est le debugger. Voici : <b>João !</b></h5><br>
<h5>Notre Scrum Master et aussi pro de l'html,c'est un jeune homme plein de potentiel. J'ai nomé ici : <b>Evann !</b></h5><br>
<h5>Et enfin, last but not least, Il passe ses nuits sur du php, ce jeune developeur, ce n'est autre que : <b>Alex !</b></h5>


<?php
$content = ob_get_clean();
require "gabarit.php";
?>
