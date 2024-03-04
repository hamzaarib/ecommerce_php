<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../front/index.php">
                    List Of Categories
                </a>
            </li>
        </ul>
    </div>
    <?php
        $productCount = 0;
        if(isset($_SESSION['utilisateur'])){
            $idUtilisateur = $_SESSION['utilisateur']['id'];
            $productCount = count($_SESSION['cart'][$idUtilisateur] ?? []);
        }
    ?>
    <div class="d-flex">
        <a href="../index.php" class="btn"><i class="fa-solid fa-screwdriver-wrench"></i>Backoffice</a>
        <a href="cart.php" class="btn"><i class="fa-solid fa-cart-shopping"></i>Cart(<?= $productCount?>)</a>
    </div>
</div>
    </nav>
    <!-- <script src="bootstrap/js/bootstrap.bundle.js"></script> -->
</body>
</html>