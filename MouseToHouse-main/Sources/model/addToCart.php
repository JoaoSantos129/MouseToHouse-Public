<?php

// Si le panier n'est pas vide alors extraire ces données dans un tableau, sinon lire et écrire dams le fichier des paniers
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}else {
    $file = fopen('Data/UserCart.csv', 'a+');
}
