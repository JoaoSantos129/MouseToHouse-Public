<?php

/*
 * Cette fonction vérifie si le mot de passe et l'e-mail sont justes et récupère toutes les information de l'utilisateur connecté
 * Return : True si l'utilisateur peut se connecter ou false si l'utilisateur ne peut pas se connecter
 */
function checkLoginInCSVFile($formData){
    // Si Le fichier est vide alors return false
    if (($handle = fopen(getcwd()."\\data\\UsersData.csv", "r")) !== FALSE) {
        // Boucler pour lire toutes les informations des comptes
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Si l'e-mail et le mot de passe sont justes alors extraire toutes les données du compte puis return true
            if ($formData['email'] == $data[3] && password_verify($formData['password'], $data[5])){
                // Extraire toutes les données du compte
                $_SESSION['username'] = $data[0];
                $_SESSION['lastname'] = $data[1];
                $_SESSION['firstname'] = $data[2];
                $_SESSION['email'] = $data[3];
                $_SESSION['phoneNumber'] = $data[4];
                $_SESSION['password'] = $data[5];
                $_SESSION['isUserAdmin'] = $data[6];

                return true;
            }
        }
        fclose($handle);
    }
    return false;
}

?>