<?php
ob_start();
?>
    <h1>Hmmm... il semblerait que vous ne puissiez pas payer</h1>
    <br>
    <a href="index.php"
       <p>revenir a l'acceuil </p>
    </a>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>