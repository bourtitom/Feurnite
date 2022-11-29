<?PHP  $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', "afficherClients"))); ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!--Meta-->
    <meta name="description" content="">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title></title> <!--title of page-->
</head>
<body>
<header>

<!--    <a href="index.php"><img src="assets/img/house-solid.svg" alt="house" id="house"></a>-->
    <?php
    if (!isset($_SESSION["client"])) {
        echo '<a href="views/Login.php"><img src="../assets/img/profil.png" alt="#" id="profil"></a>';
    } else {
        if (isset($_SESSION["panier"])) {
            $nbarticle = array_sum($_SESSION["panier"]["qte"]);
            echo '<div class="qte">' . $nbarticle . '</div>';}
        echo '<a href="controllers/Controller.php?todo=montrerPanier"><img src="../assets/img/panier.svg" alt="voir mon panier" id="profil"></a>';
    }
    ?>
    <h1>MELCARPG en MVC1 !</h1>
    <nav>
        <ul>
            <li>

                <a href=''>RPG</a>
            </li>
            <li>
                <a href='controllers/Controller.php?todo=afficherClients'>FAQ & OTHER</a>
            </li>

        </ul>
    </nav>
</header>
</body>
</html>