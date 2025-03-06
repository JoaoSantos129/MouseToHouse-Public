<?php

/*
 * Param : L'e-mail de l'utilisateur ainsi que le mot de passe
 * Cette fonction redirige l'utilisateur vers la loginpage ou vers la homepage si l'utilisateur a pû se connecter
 */
function login($post){
    // Reinitialiser la variable
    $_SESSION['loginFailed'] = 1;

    // Vérifier l'e-mail et le mot de passe tapé
    require_once "model/verificationlogin.php";

    // Si l'utilisateur a p'u se connecter alors renvoyer l'utilisateur à la homepage, sinon renvoyer l'utilisateur à la loginpage
    if (signinCsv($post)) {
        require "views/homepage.php";
    } else {
        require "views/loginpage.php";
    }
}

/*
 * Cette fonction permet de créer un utilisateur
 */
function signin(){
    // Récuperer toutes les données tapées pour la création du compte
    $values = array($_POST);

    // Reinitialiser la variable
    $_SESSION['registerFailed'] = 1;

    // Renvoyer l'utilisateur à la page de création d'un compte
    require "views/signinpage.php";
}

/*
 * Param : Toutes les données tapées pour la création du compte
 * Cette fonction teste si la création du compte est possible
 */
function SaveNewUserData($post){
    // Reinitialiser la variable
    $_SESSION['registerFailed'] = 1;

    // Enregistrer les données de l'utilisateur si cela est possible
    require "model/User.php";

    // Si les valeurs sont uniques alors d'enregistrer les données
    if (UniqueData($post)) {
        WriteData($post);
        require "views/homepage.php";
    } else {    // Sinon renvoyer l'utilisateur à la page de création d'un compte
        $_SESSION['registerFailed'] = 2;
        require "views/signinpage.php";
    }
}

/*
 * Cette fonction renvoie l'utilisateur à la page de son profil
 */
function profile(){
    require "views/profilepage.php";
}

/*
 * Cette fonction teste si le numéro de téléphone, l'e-mail et le nom d'utilisateur sont uniques
 */
function UniqueData($post) {
    $filename = 'Data/UsersData.csv';

    // Récupérer les valeurs à vérifier depuis le tableau POST
    $username = $post['username'];
    $email = $post['Email'];
    $telNumber = $post['telNumber'];

    // Vérifier si les valeurs sont uniques en les comparant aux valeurs existantes dans le fichier CSV
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $existingUsername = $data[0];
            $existingEmail = $data[3];
            $existingTelNumber = $data[4];

            if ($existingUsername === $username || $existingEmail === $email || $existingTelNumber === $telNumber) {
                return false;
            }
        }
        fclose($handle);
    }
    return true;
}