<?php

// Lignes 4 -7 : Inclus les fichiers contrôleurs qui contiennent les différentes fonctions pour traiter les différentes actions possibles sur le site.
require "controller/homeController.php";
require "controller/helpController.php";
require "controller/itemController.php";
require "controller/userController.php";

// Démarrer la session
session_start();

// Tester si une action a été tapé dans l'URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    // Switch qui teste quel action a été tapée dans l'URL
    switch ($action) {
        // Appelle la fonction home() du contrôleur homeController.php
        case 'home' :
            home();
            break;
        // Appelle la fonction helpSend() du contrôleur helpController.php sans afficher les données reçues dans l'URL
        case 'helpSend' :
            helpSend($_POST);
            break;
        // Appelle la fonction help() du contrôleur helpController.php
        case 'help' :
            help();
            break;
        // Appelle la fonction items() du contrôleur itemController.php
        case 'items' :
            items();
            break;
        // Si un code d'un produit est dans l'action alors ça appelle la fonction item() du contrôleur itemController.php pour le produit avec ce code, sinon appelle la fonction lost() du contrôleur homeController.php
        case 'item' :
            if (isset($_REQUEST['code'])) {
                $Code = $_REQUEST['code'];
                item($Code);
            } else {
                lost();
            }
            break;

        // Si l'utilisateur n'est pas authentifié, appelle la fonction login() du contrôleur userController.php, sinon, si l'utilisateur est authentifié ça appelle la fonction cart() de cet utilisateur, du contrôleur itemController.php
        case 'cart' :
            if (!isset($_SESSION['auth'])) {
                login($_POST);
            } elseif ($_SESSION['auth'] == 1) {
                cart();
            } else {
                login($_POST);
            }
            break;
        // Appelle la fonction signin() du contrôleur userController.php
        case 'signin' :
            signin();
            break;
        // Appelle la fonction SaveNewUserData() du contrôleur userController.php sans afficher les données reçues dans l'URL
        case 'SaveNewUserData' :
            SaveNewUserData($_POST);
            break;
        // Si un utilisateur est déjà connecté ça appelle la fonction login() du contrôleur userController.php sans afficher les données reçues dans l'URL, sinon, ça appelle la fonction home() du contrôleur homeController.php
        case 'login' :
            if (!isset($_SESSION) || !in_array('auth', $_SESSION) || $_SESSION['auth'] !== 1) {
                login($_POST);
            } else {
                home();
            }
            break;
        // Détruit la session en cours puis appelle la fonction home() du contrôleur homeController.php
        case 'logout':
            session_unset();
            session_destroy();
            home();
            break;
        // Appelle la fonction profile() du contrôleur userController.php
        case 'profile':
            profile();
            break;
        // Appelle la fonction itemToCart() du contrôleur itemController.php envoyant la variable $Code qui est égal au code du produit choisi
        case 'itemToCart':
            $Code = $_REQUEST['code'];
            itemToCart($Code);
            break;
        // Appelle la fonction Checkout() du contrôleur itemController.php
        case 'Checkout';
            Checkout();
            break;
        // Appelle la fonction HavingNoMoney() du contrôleur homeController.php
        case 'PayCart';
            Payment();
            break;
        // Fonction cachée pour ajouter un easter egg si on se connecte en tant que Gamenout
        case 'OurProjecteam';
            OurProjectTeam();
            break;
        // Si aucune action dans l'URL a été reconnaissable alors ça appelle la fonction lost() du contrôleur homeController.php
        default :
            lost();
    }
} else {    // S'il n'y a juste pas d'action ça apelle fonction Checkout() du contrôleur homeController.php
    home();
}
