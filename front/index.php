<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>List Des Categories</title>
    <style>
        .parent {
            margin: 20px auto;
            text-align:center;
            display: grid;
            grid-template-columns: 1fr 3fr;
        }
        .categories{
            /* border:2px solid black; */
        }
        .category{
            margin-bottom:10px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
        require_once("../include/nav_front.php");
        require_once('../include/database.php');
        $categories = $pdo->query("SELECT * FROM categorie")->fetchAll(PDO::FETCH_OBJ);
        $produits = $pdo->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($categories);
        // echo "</pre>";
        // echo "<pre>";
        // print_r($produits);
        // echo "</pre>";
    ?>
    <!-- <div class="container py-2">
        <h4 class="alert alert-info"><i class="fa-solid fa-list"></i> List Des Categories</h4>
        <ul class="list-group list-group-flush w-50">
            <?php
                foreach ($categories as $category) {
                    ?>
                        <li class="list-group-item">
                            <a href="categorie.php?id=<?= $category->id?>" class= "btn btn-light">
                                <i class="<?= $category->icone?>"></i> <?= $category->libelle?>
                            </a>
                        </li>
                    <?php
                }
            ?>
        </ul>
    </div> -->
    <div class="parent">
        <div class="categories">
            <h4 class="alert alert"><i class="fa-solid fa-list"></i> List Des Categories</h4>
            <?php
                foreach ($categories as $category) {
                    ?>
                    <div class="category">
                            <a href="categorie.php?id=<?= $category->id?>" class= "btn btn-light">
                                <i class="<?= $category->icone?>"></i> <?= $category->libelle?>
                            </a>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="produits">
            <h4 class="alert alert"><i class="fa-brands fa-product-hunt"></i> List Des Produits</h4>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($produits as $produit):?>
                    <div class="col">
                        <div class="card">
                            <img src="../upload/produit/<?= $produit['image']?>"
                                class="card-img-top w-50 mx-auto" 
                                alt="<?= $produit['libelle']?>" 
                                height="100"
                            />
                        <div class="card-body">
                            <a href="produit.php?id=<?=$produit['id']?>" class="btn stretched-link">Show</a>
                            <h5 class="card-title"><?= $produit['libelle']?></h5>
                            <p class="card-text"><?= $produit['description'].'MAD'?></p>
                            <p class="card-text"><?= $produit['prix'].'MAD'?></p>
                            <p class="card-text"><small class="text-body-secondary">create in <?= date_format(date_create($produit['date_creation']),"Y/m/d")?></small></p>
                        </div>
                        <div class="footer" style = "z-index:10;">
                            <?php 
                            $idProduit = $produit['id'];
                            include("../include/front/counter.php") 
                            ?>
                        </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/js/produit/counter.js"></script>
</body>
</html>