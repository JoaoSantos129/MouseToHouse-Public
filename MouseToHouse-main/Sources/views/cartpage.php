<?php
ob_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    // Ouvrir le fichier des paniers pour pouvoir le lire
    $file = fopen('Data/UserCart.csv', 'r');

    // Ouvrir le fichier des produits pour pouvoir le lire
    $ItemsValues = fopen('Data/items.csv', 'r');

    // Extraire les données du fichier items.csv
    $itemsData = array();
    echo "<br><h2><p style='text-align: center'>Votre panier</p></h2> ";

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
                // Trouver les informations de la souris correspondant au code
                $mouseInfo = array();
                // Boucler jusqu'à ce que toutes les informations de chaque produit ajouté au panier par cet utilisateur connecté soient extraits dans le array $mouseInfo
                foreach ($itemsData as $itemData) {
                    // Extraire les informations de chaque produit ajouté au panier par cet utilisateur connecté dans le array $mouseInfo
                    if ($itemData[0] == $code) {
                        $mouseInfo['code'] = $itemData[0];
                        $mouseInfo['model'] = $itemData[2];
                        $mouseInfo['brand'] = $itemData[1];
                        $mouseInfo['type'] = $itemData[6];
                        $mouseInfo['price'] = $itemData[5];
                        break;
                    }
                }
                // Afficher les informations des produits ajoutés au panier
                echo "<table style='width:80%;margin-left: auto;margin-right: auto;margin-top: 50px;table-layout: fixed'>";
                    echo "<tr>";
                        echo "<td><h4>" . $code . "</h4></td>";
                        echo "<td><h4>" . $mouseInfo['model'] . "</h4></td>";
                        echo "<td><h4>" . $mouseInfo['brand'] . "</h4></td>";
                        echo "<td><h4>" . $mouseInfo['type'] . "</h4></td>";
                        echo "<td><h4>" . $mouseInfo['price'] . " CHF". "</h4></td>";
                        echo "<td>";?>
                            <a class="boutonsItems" id="details" type="submit" style="padding: 13px 30px 13px 30px" href="index.php?action=item&code=<?=$mouseInfo['code']?>"<?php
                                echo '<form style="background-color: #2259ff" method="get" type="submit">Détails</form>';
                            echo "</a>";
                        echo "</td>";
                        echo "<td>";?>
                            <a class="boutonsItems" id="details" type="submit" style="padding: 13px 30px 13px 30px" href="index.php?action=lost"<?php
                                echo '<form style="background-color: #2259ff;" method="get" type="submit">Supprimer du panier</form>';
                            echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                echo "</table>";
                echo "<br>";
            }
        }
    }

    // Fermer les fichiers
    fclose($file);
    fclose($ItemsValues);
    echo "<br>";
    if (isset($_SESSION['cart'])) {
        echo "<br>";
    } else {
        echo "";
    }
}
?>

    <div>
        <form class="Checkout" method="post" action="index.php?action=Checkout">
            <input type="submit" value="Passer en caisse"/>
        </form>
    </div>

<?php
$content = ob_get_clean();
require "gabarit.php";
