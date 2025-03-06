<?php
ob_start();

// Ouvrir le fichier des produits pour pouvoir le lire
$file = fopen('Data/items.csv', 'r');

// Si le fichier a été trouvé alors affiché les produits
if ($file !== FALSE) {
    echo "<table style='width:80%;margin-left: auto;margin-right: auto;margin-top: 50px;margin-bottom: 50px'>";
    echo "<tr>";
    echo "<th><h4>Code</h4></th>";
    echo "<th><h4>Marque</h4></th>";
    echo "<th><h4>Modèle</h4></th>";
    echo "<th><h4>Disponibles</h4></th>";
    echo "<th><h4>Prix</h4></th>";
    echo "<th><h4>Type</h4></th>";
    echo "<th><h4>Image</h4></th>";
    echo "<th><h4>Détails</h4></th>";
    echo "<th><h4>Ajouter au panier</h4></th>";

    // Si un Admin est connecté alors affiché des colonnes pour modifier et supprimer des produits
    if (!isset($_SESSION['isUserAdmin'])) {
        echo "</tr> ";
    } elseif ($_SESSION['isUserAdmin'] == 1) {
        echo "<th><h4>Modifier</h4></th>";
        echo "<th><h4>Supprimer</h4></th>";
    } else {
        echo "</tr>";
    }
    echo "</tr>";

    // Boucler jusqu'à ce que tous les produits soient affichés
    while (($data = fgetcsv($file, 100, ',')) !== FALSE) {
        if ($data[7] == '1') {
            echo "<tr>";
            echo "<td>" . $data[0] . "</td>";
            echo "<td>" . $data[1] . "</td>";
            echo "<td>" . $data[2] . "</td>";
            echo "<td>" . $data[4] . "</td>";
            echo "<td>" . $data[5] . " CHF</td>";
            echo "<td>" . $data[6] . "</td>";
            $image = $data[9];
            ?>
            <td><img class='itemInTable' src='<?= $image ?>'/></td>
            <td>
                <a class="boutonsItems" type="submit" style="padding: 13px 30px 13px 30px" href="index.php?action=item&code=<?= $data[0]?>"
                <form style="background-color: #2259ff" method="get" type="submit">Détails</form>
            </td>
            <td>
                <?php
                // Si un utilisateur est connecté alors ajouter le produit à son panier
                if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
                    ?>
                    <a class="boutonsItems" type="submit" href="index.php?action=itemToCart&code=<?= $data[0]?>"
                    <?php
                } else {    // Sinon renvoyer l'utilisateur à la page de connexion
                    echo '<a class="boutonsItems" type="submit" href="index.php?action=login"';
                }
                echo '<form style="background-color: #2259ff" method="post" type="submit">Ajouter au panier</form>';
                ?>
            </td>
            <?php
            // Si un Admin est connecté alors affiché des boutons pour modifier et supprimer des produits
            if (!isset($_SESSION['isUserAdmin'])) {
                echo " ";
            } elseif ($_SESSION['isUserAdmin'] == 1) {
                echo '<td>';?>
                    <a class="boutonsItems" type="submit" href="index.php?action=item&code=<?= $data[0]?>"
                    <?php echo '<form style="background-color: #2259ff" method="post" type="submit">Modifier</form>';
                echo '</td>';
                echo '<td>';
                    echo '<a class="boutonsItems" type="submit" href="index.php?action=NotYetImplemented"';
                    echo '<form style="background-color: #2259ff" method="post" type="submit">Supprimer</form></td>';
                echo '</td>';
            } else {    // Sinon ne rien afficher
                echo " ";
            }
            echo "</tr>";
        }
    }
    echo "</table>";
    fclose($file);
}

$content = ob_get_clean();
require "gabarit.php";
?>
