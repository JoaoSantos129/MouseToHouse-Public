<?php
//require_once "controller/itemController.php";

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $item = getItem($code);

    if ($item !== false) {
        ob_start(); // start output buffering
        ?>
        <table class="item">
            <tr class="item">
                <td class="item">
                    <h2><strong><?= $item['marque'] ?> - <?= $item['modele'] ?></strong></h2>
                </td>
                <td rowspan="7" class="item">
                    <img src='<?= $item['Image'] ?>' style="height:350px">
                </td>
            </tr>
            <tr class="item">
                <td class="item">
                    <strong>Code unique : </strong><?= $item['code'] ?>
                </td>
            </tr>
            <tr class="item">
                <td class="item">
                    <strong>Disponibilité : </strong><?= $item['disponible'] ?>
                </td>
            </tr>
            <tr class="item">
                <td class="item">
                    <strong>Prix : </strong><?= $item['prix'] . " CHF" ?>
                </td>
            </tr>
            <tr class="item">
                <td class="item">
                    <strong>Type : </strong><?= $item['type'] ?>
                </td>
            </tr>
            <tr class="item">
                <td class="item">
                    <strong>Poids : </strong><?= $item['poid'] ?>
                </td>
            </tr>
            <tr class="item">
                <td class="item">
                    <strong>Description : </strong><?= $item['description'] ?>
                </td>
            </tr>
        </table>
        <table style="margin: 20px 600px 0 600px">
            <tr>
                <td>
                    <?php
                    // Si un utilisateur est connecté alors ajouter le produit à son panier
                    if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
                        ?>
                        <a class="boutonsItems" type="submit" style="padding: 20px 40px 20px 40px; font-size: 25px" href="index.php?action=itemToCart&Code=<?= $item['code'] ?>";
                        <?php
                    } else {    // Sinon renvoyer l'utilisateur à la page de connexion
                        echo '<a class="boutonsItems" type="submit" style="padding: 20px 40px 20px 40px; font-size: 25px" href="index.php?action=login"';
                    }
                    echo '<form style="background-color: #2259ff" method="post" type="submit">Ajouter au panier</form>';
                    ?>
                </td>
                <td>
                    <a class="boutonsItems" type="submit" style="padding: 20px 40px 20px 40px; font-size: 25px" href="index.php?action=items"
                    <form style="background-color: #2259ff" method="get" type="submit">Voir plus de souris</form>
                </td>
            </tr>
        </table>

        <?php
    }
} else {
    echo "Produit non trouvé";
}
$content = ob_get_clean(); // end output buffering and get the output
require "gabarit.php";
?>