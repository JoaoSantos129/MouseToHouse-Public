<?php

/*
 * Param : Le message d'aide envoyé par l'utilisateur
 * Cette fonction affiche la page d'aide et récupère et enregistrer le message d'aide envoyé par l'utilisateur
 */
function helpSend($post){
    require "model/help.php";
    sendIssue($post);
    require "views/helppage.php";
}

