<?php

/*
 * Cette fontion vérifie les données et enregistre les données d'un nouveau utilisateur si les données reçues sont accéptées
 */
function WriteData($values){

    // Si les données n'ont pas été reçues alors renvoyer l'utilisateur à la page lost
    if (!empty($values)) {
        // Extraire toutes les données de l'utilisateur
        $username = implode(" ", array($values['username']));
        $name = implode(" ", array($values['name']));
        $firstname = implode(" ", array($values['firstname']));
        $Email = implode(" ", array($values['Email']));
        $telNumber = implode(" ", array($values['telNumber']));
        $password = implode(" ", array($values['password']));
        $PasswordHash = password_hash($password, PASSWORD_DEFAULT);
        $values['isUserAdmin'] = isset($values['isUserAdmin']) && $values['isUserAdmin'] == 1 ? $values['isUserAdmin'] : 0;
        $isAdmin = 0;

        // Si la valeur de isUserAdmin est 1 alors l'utilisateur est un Admin
        if (isset($values['isUserAdmin']) && $values['isUserAdmin'] == 1) {
            $isAdmin = 1;
        }

        // Ouvrir le fichier des utilisateurs pour pouvoir le lire
        $fp = fopen("Data/UsersData.csv", 'r');

        // Boucler tant que les données de tous les autres utilisateurs n'ont pas été vérifiées
        while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
            // Si l'email, ou username ou le telNumber existent déjà dans le fichier alors return false
            if (in_array($Email, $data) || in_array($username, $data) || in_array($telNumber, $data)) {
                // Fermer le fichier
                fclose($fp);
                header("Location: index.php?action=signin");
                return false;
            }
        }
        // Fermer le fichier
        fclose($fp);

        // Les valeurs n'existent pas, ajouter le nouveau utilisateur au fichier
        $ValuesToInsert = array($username, $name, $firstname, $Email, $telNumber, $PasswordHash, $isAdmin);

        // Ouvrir et écrire dans le fichier des utilisateurs
        $fp = fopen("Data/UsersData.csv", 'a+');
        fputcsv($fp, $ValuesToInsert, ",");

        // Fermer le fichier
        fclose($fp);

        // Renvoyer l'utilisateur à la homepage
        home();
        exit;
    } else {
        lost();
    }
}
