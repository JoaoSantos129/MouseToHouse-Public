<?php
ob_start();

if (isset($_SESSION['username'])) {
    // Ouvrir le fichier des paniers pour pouvoir le lire
    $file = fopen('Data/UserCart.csv', 'r');

    // Ouvrir le fichier des produits pour pouvoir le lire
    $ItemsValues = fopen('Data/items.csv', 'r');

    echo "<h1>Payement</h1>";

    // Extraire les données du fichier items.csv
    $itemsData = array();

    // Boucler jusqu'à ce que tous les produits soient enregistrés
    while (($data = fgetcsv($ItemsValues, 1000, ",")) !== FALSE) {
        $itemsData[] = $data;
    }

    // Boucler jusqu'à ce que tous les paniers soient enregistrés
    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        $Cart = array($data[0], $data[1]);
        // Lire uniquements les produits ajoutés par cet utilisateur connecté
        if ($_SESSION['username'] == $Cart[0]) {
            // Extraire le code de chaque produit ajouté au panier par cet utilisateur connecté dans $codes
            $codes = explode(",", $Cart[1]);
            foreach ($codes as $code) {
                // Trouver les informations du produit correspondant au code
                $mouseInfo = array();
                $LastTotal = 0; // Réinitialiser la variable du montant total
                // Boucler jusqu'à ce que toutes les informations de chaque produit ajouté au panier par cet utilisateur connecté soient extraits dans le array $mouseInfo
                foreach ($itemsData as $itemData) {
                    // Extraire les informations de chaque produit ajouté au panier par cet utilisateur connecté dans le array $mouseInfo
                    if ($itemData[0] == $code) {
                        $mouseInfo['code'] = $itemData[0];
                        $mouseInfo['model'] = $itemData[2];
                        $mouseInfo['brand'] = $itemData[1];
                        $mouseInfo['type'] = $itemData[6];
                        $mouseInfo['price'] = $itemData[5];
                        // Calculer le montant à payer
                        $Total = $mouseInfo['price'];
                        $LastTotal += $Total;
                        $Total = $LastTotal + $Total;
                        break;
                    }
                }
                // Afficher les informations des produits ajoutés au panier
                echo"<td>" . $mouseInfo['model'] . "; </td>";
                echo"<td>" . $mouseInfo['brand'] . "; </td>";
                echo"<td>" . $mouseInfo['type'] . "; </td>";
                echo"<td>" . $mouseInfo['price'] . " </td><br>";
            }
        }
    }
}
// Afficher le montant total
echo"<h2><strong>TOTAL :  $Total CHF</strong></h2>"; ?>
<div>
    <form class="Checkout" method="post" action="index.php?action=PayCart">
        <input type="submit" value="PAYER"/>
    </form>
</div>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>