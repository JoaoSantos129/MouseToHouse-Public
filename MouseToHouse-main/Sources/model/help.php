<?php

/*
 * Cette fonction récupère et enregistre un message d'aide
 */
function sendIssue($comment){
    // Si le message est vide alors renvoyer l'utilisateur à la lost page
    if (!empty($comment)) {
        // Extraire le message
        $list = array($comment['DescriptionArea']);

        // Ouvrir et écrire dans le fichier des messages d'aide
        $fp = fopen("Data/signaler.csv", 'a+');
        fputcsv($fp, $list, ";");

        // Fermer le fichier
        fclose($fp);

        // Renvoyer l'utilisateur à la homepage
        home();
        exit;
    } else {
        lost();
    }
}
?>
