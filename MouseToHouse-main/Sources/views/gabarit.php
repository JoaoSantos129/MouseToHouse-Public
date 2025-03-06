<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="views/bootstrap/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="views/bootstrap/css/style.css">
</head>
<body>
<h1 class="pageTitle"><a href="index.php" id="titre">Mouse to House</a></h1>
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <ul class="navbar-nav nav-left">
            <li class="nav-item">
                <a class="nav-link active" href="index.php"><img class="logo" src="images/MouseToHouse_Logo.png"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=items">Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=help">Aide</a>
            </li>
        </ul>
        <ul class="navbar-nav nav-right">
            <li class="nav-item">
                <a class="nav-link" href="index.php?action=cart">Panier</a>
            </li>
            <li class="nav-item">
                <?php
                // Si un utilisateur n'est pas connecté alors afficher un lien pour se connecter
                if (!isset($_SESSION['auth'])) {
                    echo '<a class="nav-link" href="index.php?action=login">Se connecter</a>';
                } else {    // Sinon afficher le nom d'utilisateur de l'utilisateur connecté qui est un lien vers son profil
                    echo '<a class="nav-link" href="index.php?action=profile">' . $_SESSION['username'] . '</a>';
                } ?>
            </li>
            <li class="nav-item">
                <?php
                // Si un utilisateur n'est pas connecté alors afficher un lien pour créer un compte
                if (!isset($_SESSION['auth'])) {
                    echo '<a class="nav-link" href="index.php?action=signin">Créer un compte</a>';
                } else {    // Si un utilisateur n'est pas connecté alors afficher un lien pour se deconnecter
                    echo '<a class="nav-link" href="index.php?action=logout">Se deconnecter</a>';
                }
                ?>
            </li>
        </ul>
    </div>
</nav>

<?= $content; ?>

<footer id="footer">

    <img class="social" src="images/instagram.png">
    <img class="social" src="images/facebook.png">

</footer>
</body>
</html>
