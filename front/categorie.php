<?php
    session_start();
    require_once("../include/nav_front.php");
    require_once('../include/database.php');
    $id = $_GET['id'];
    $sqlState = $pdo->prepare("SELECT * FROM categorie WHERE id=?");
    $sqlState->execute([$id]);
    $category = $sqlState->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($category);
    // echo "</pre>";
    $sqlState = $pdo->prepare("SELECT * FROM produit WHERE categorie_id=?");
    $sqlState->execute([$id]);
    $produit = $sqlState->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($produit);
    // echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/produit.css">
    <title>Category | <?= $category['libelle']?></title>
</head>
<body>
    <div class="container py-2">
        <h4 class="alert alert-info"><i class="<?= $category['icone']?>"></i> Category <?= $category['libelle']?></h4>
        <div class="text-end">
            <a href="index.php" class="btn btn-danger">
                Back
            </a>
        </div>
        <?php
            if(empty($produit)){
                ?>
                    <h3 class="alert alert-danger text-center m-2">The Product Is Not Found</h3>
                <?php
            }
        ?>
        <ul class="list-group list-group-flush">
            <div class="container">
                <div class="row m-2">
                    <?php
                        foreach ($produit as $value) {
                        
                    ?>
                    <div class="card mb-3 col-md-6">
                        <img src="../upload/produit/<?= $value['image']?>"
                            class="card-img-top w-50 mx-auto" 
                            alt="<?= $value['libelle']?>" 
                            height="100"
                            />
                        <div class="card-body">
                            <a href="produit.php?id=<?=$value['id']?>" class="btn stretched-link">Show</a>
                            <h5 class="card-title"><?= $value['libelle']?></h5>
                            <p class="card-text"><?= $value['description'].'MAD'?></p>
                            <p class="card-text"><?= $value['prix'].'MAD'?></p>
                            <p class="card-text"><small class="text-body-secondary">create in <?= date_format(date_create($value['date_creation']),"Y/m/d")?></small></p>
                        </div>
                        <div class="footer" style = "z-index:10;">
                            <?php 
                            $idProduit = $value['id'];
                            include("../include/front/counter.php") 
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </ul>
    </div>
    <script src="../asset/js/produit/counter.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>