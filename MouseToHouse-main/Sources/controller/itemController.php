<?php

/*
 * Cette fonction récupère les données des produits et les affiche dans la page de produits
 */
function items(){
    require "model/GetItems.php";
    $Items = getItems();
    require "views/itemspage.php";
}

/*
 * Cette fonction affiche la page du panier de l'utilisateur
 */
function cart(){
    require "views/cartpage.php";
}

/*
 * Param : Produit à ajouter au panier de l'utilisateur
 * Cette fonction sert à ajouter un produit à un panier d'un utilisateur
 */
function itemToCart($cartvalues){
    require "model/WriteCartData.php";
    require "model/addToCart.php";

    WriteCartData($cartvalues);
    require "views/itemspage.php";
    require "model/addToCart.php";
}

/*
 * Param : Code unique d'un produit
 * Cette fonction sert à trouver toutes les informations d'un produit
 */
function item($code)
{
    require "model/GetItem.php";
    $Item = getItem($code);
    require "views/itemPage.php";
}

/*
 * Cette fonction affiche la page de checkout
 */
function Checkout(){
    require "views/Checkout.php";
}


