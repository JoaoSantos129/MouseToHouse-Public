<?php
ob_start();

?>
    <h1 class="pageTitle" style="font-size: 45px">Accueil</h1>
<?php

// Ouvrir le fichier des produits pour pouvoir le lire
$file = fopen('Data/items.csv', 'r');

// Stockage des codes où $file[7] = 1 dans un tableau $codes
$codes = array();
while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
    if ($data[7] == 1) {
        array_push($codes, $data[0]);
    }
}

// Choix aléatoire d'un code parmi les codes stockés dans $codes
$randCode = $codes[array_rand($codes)];

// Redirection vers la page itemPage.php correspondant au code choisi
require "model/GetItem.php";
$randNum = $codes[array_rand($codes)];
$item = getItem($randNum);

// Afficher le produit choisi aléatoirement s'il a été trouvé
if ($item !== false) {
    if (isset($item['Image']) && isset($item['marque']) && isset($item['modele']) && isset($item['prix'])) {
        ?>
        <p id="hometext">La <b><?php echo $item['modele']?></b> de chez <b><?php echo $item['marque']?></b> est disponible au prix de <strong><?php echo $item['prix']?>  CHF !</strong></p>
        <a id="details" href="index.php?action=item&code=<?= $item['code'] ?>">
            <img class="HomePageImg" src="<?php echo $item['Image']; ?>" alt="Image de la souris">
        </a><?php
        ?><?php
        ?>
        <a id="lienproduits" href="index.php?action=items">Découvrez tous nos produits ici !</a><?php

    } else {    // Sinon afficher un message d'erreur
        echo "Article non trouvé";
    }
}
?>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>