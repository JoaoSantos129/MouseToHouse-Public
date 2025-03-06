<?php

/*
 * Cette fonction vérifie qu'un produit existe et enregistre chaque information de ce produit uniquement
 * Return : Toutes les informations de ce produit s'il est trouvé, sinon false
 */
function  getItem($code) {
    // Si le fichier est vide return false
    if (($handle = fopen(getcwd() . "\\data\\items.csv", "r")) !== FALSE) {
        // Boucler jusqu'à ce que le produit soit trouvé
        while (($itemValues = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Si le code du produit choisi par l'utilisateur est le même que le code de ce produit alors enregistrer ces données
            if ($itemValues[0] == $code) {
                // Fermer le fichier
                fclose($handle);
                return [
                    "code" => $itemValues[0],
                    "marque" => $itemValues[1],
                    "modele" => $itemValues[2],
                    "poid" => $itemValues[3],
                    "disponible" => $itemValues[4],
                    "prix" => $itemValues[5],
                    "type" => $itemValues[6],
                    "active" => $itemValues[7],
                    "description" => $itemValues[8],
                    "Image" => $itemValues[9]
                ];
            }
        }
        // Fermer le fichier
        fclose($handle);
    }
    return false;
}
?>
