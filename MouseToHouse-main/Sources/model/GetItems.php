<?php

/*
 * Cette fonction extrait toutes les informations de tous les produits
 * Return : Toutes les informations de tous les produits
 */
function getItems() {
    $items = array();
    // Tester si le fichier n'est pas vide
    if (($handle = fopen(getcwd() . "\\data\\items.csv", "r")) !== FALSE) {
        // Boucler jusqu'à ce que tous les produits soient parcourus
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Extraire chaque information du produit dans sa case du tableau $item
            $item = array(
                "code" => $data[0],
                "marque" => $data[1],
                "modele" => $data[2],
                "poid" => $data[3],
                "disponible" => $data[4],
                "prix" => $data[5],
                "type" => $data[6],
                "active" => $data[7],
                "description" => $data[8],
                "Image" => $data[9]
            );
            // Enregistrer toutes les données des produits
            array_push($items, $item);
        }
        // Fermer le fichier
        fclose($handle);
    }
    return $items;
}
