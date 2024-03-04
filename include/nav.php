<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    $connecte = false;
    if(isset($_SESSION['utilisateur'])){
        $connecte = true;
    }
    // var_dump($connecte);
    ?>
    <nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php
            $currentPage = $_SERVER['PHP_SELF'];
        ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage == "/ecommerce_php/index.php") echo 'active' ?>" aria-current="page" href="index.php">
                        <i class="fa-solid fa-house"></i> Home Page
                    </a>
                </li>
                <?php
                    if($connecte){
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage == "/ecommerce_php/categories.php") echo 'active' ?>" href="categories.php">
                    <i class="fa-brands fa-dropbox"></i> List Des Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage == "/ecommerce_php/produit.php") echo 'active' ?>" href="produit.php">
                    <i class="fa-solid fa-tag"></i> List Des Produit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage == "/ecommerce_php/commandes.php") echo 'active' ?>" href="commandes.php">
                    <i class="fa-solid fa-barcode"></i> Commandes
                    </a>
                </li>
                </li>
                    <a class="nav-link <?php if($currentPage == "/ecommerce_php/deconnexion.php") echo 'active' ?>" href="deconnexion.php">
                    <i class="fa-solid fa-right-from-bracket"></i> Deconnexion
                    </a>
                </li>
                <?php
                    }else{
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php if($currentPage == "/ecommerce_php/ajouter_utilisateur.php") echo 'active' ?>" aria-current="page" href="ajouter_utilisateur.php">
                        <i class="fa-solid fa-user-plus"></i> Ajouter utilisateur
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="connexion.php">
                        <i class="fa-solid fa-user"></i> Connexion
                    </a>
                </li>
                <?php
                    }
                ?>
            </ul>
            <?php
                if($connecte){
             ?>
            <div class="d-flex">
                <a href="front/" class="btn"><i class="fa-solid fa-cart-shopping"></i>Site front</a>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    </nav>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>