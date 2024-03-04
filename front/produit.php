<?php
    session_start();
    require_once("../include/nav_front.php");
    require_once('../include/database.php');
    $id = $_GET['id'];
    // var_dump($id);die();
    $sqlState = $pdo->prepare("SELECT * FROM produit WHERE id=?");
    $sqlState->execute([$id]);
    $produit = $sqlState->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($produit);
    // echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../asset/css/produit.css">
    <title>Produit | <?= $produit['libelle']?></title>
</head>
<body>
    <div class="container py-2">
        <h4 class="alert alert-info">Produit <?= $produit['libelle']?></h4>
        <!-- <div class="text-end">
            <a href="index.php" class="btn btn-danger">
                Back
            </a>
        </div> -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="../upload/produit/<?=$produit['image']?>"
                        alt="<?=$produit['libelle']?>"
                        width="250px"
                        height="250px"
                        class="img img-fluid w-5=75"
                        />
                </div>
                <div class="col-md-6">
                    <h3><?= $produit['libelle']?></h3>
                    <?php
                        $prix = $produit['prix'];
                        $discount = $produit['discount'];
                        if(!empty($discount)){
                            $total = $prix - (($prix * $discount)/100);
                        }else{
                            $total = $prix;
                        }
                    ?>
                    <h6 class="badge text-bg-success">
                        <?= $total?> MAD
                    </h6>
                    <?php
                        if(!empty($discount)){
                            ?>
                                <p>
                                    <span class="text text-secondary">
                                        <del><?= $prix?> MAD</del>
                                    </span>
                                    <span class="badge text-bg-warning">
                                        -<?= $discount?> %
                                    </span>
                                </p>
                            <?php
                        }
                    ?>
                    <p>
                        <?= $produit['description']?>
                    </p>
                        <div class="d-inline-block justify-content-start">
                        <?php
                        $idProduit = $produit['id'];
                        include("../include/front/counter.php");
                    ?>
                    <!-- <a href="#" class="btn btn-primary">Add to Cart</a> -->
                </div>
            </div>
        </div>
    </div>
    <script src="../asset/js/produit/counter.js"></script>
    <!-- <script src="../bootstrap/js/bootstrap.bundle.js"></script> -->
</body>
</html>