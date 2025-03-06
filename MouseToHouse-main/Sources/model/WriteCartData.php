<?php

/*
 * Cette fonction sert à enregistrer tous les produits dans le panier de l'utilisateur connecté
 * Return : Le nom de l'utilisateur connecté plus le code du produit choisi
 */
function WriteCartData($ValuesToInsert)
{
    $cartvalues = array();

    // Ouvrir le fichier des produits pour pouvoir le lire
    $itemfp = fopen("Data/items.csv",'r');

    // Effectuer si le panier n'est pas vide
    if (empty($cartvalues)) {
        // Extraire le nom de l'utilisateur connecté
        $Username = implode(" ", array($_SESSION['username']));

        //Extraire le code du produit
        $ItemCode = $_REQUEST['code'];

        // Enregistrer le nom d'utilisateur ainsi que le code du produit dans un tableau
        $ValuesToInsert = array($Username, $ItemCode);

        // Ouvrir et écrire dans le fichier du panier
        $fp = fopen("Data/UserCart.csv", 'a+');
        fputcsv($fp, $ValuesToInsert, ",");

        // Fermer les fichiers
        fclose($fp);
        fclose($itemfp);
    }else { //Si le panier est vide alors renvoyer l'utilisateur à la lost page
        lost();
    }
    return $ValuesToInsert;
}