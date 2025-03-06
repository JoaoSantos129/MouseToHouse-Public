<?php
require "readcsvfile.php";

/*
 * Verifie et connecte un utilisateur qui donne les informations justes par rapport à son compte
 * Return : True si l'e-mail plus le mot de passe sont correctes ou false si un des deux est faux
 */
function signinCsv($login){
    // Si $login est vide alors return false
    if (!is_array($login)) return false;

    // Teste si les cases du form sont vides
    if (!empty(array_filter($login))) {
        // Teste si l'e-mail et le mot de passe ont bien été reçus
        if (isset($login['email']) && isset($login['password'])) {
            // Si l'e-mail et le mot de passe sont justes alors return true
            if (checkLoginInCSVFile($login)) {
                // Si l'e.mail et le mot de passe sont justes alors connecté l'utilisateur
                $_SESSION['auth'] = 1;
                return true;
            } else {    // Si l'e-mail ou mot de passe ne sont pas justes alors return false
                $_SESSION['loginFailed'] = 2;
                return false;
            }
        } else {    // S'il manque l'e-mail ou le mot de passe alors return false
            return false;
        }
    }
}
