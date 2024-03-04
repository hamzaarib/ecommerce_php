<?php
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- <link rel="stylesheet" href="../../asset/css/produit.css"> -->
    <title>Document</title>
</head>
<body>
    <?php
        $idUtilisateur = $_SESSION['utilisateur']['id'];
        $qty = $_SESSION['cart'][$idUtilisateur][$idProduit] ?? 0 ;
        $button = $qty == 0 ? '<i class="fa-solid fa-cart-shopping"></i>' : '<i class="fa-solid fa-pen"></i>';
        // echo "<pre>";
        // print_r($_SESSION['cart'][$idUtilisateur]);
        // echo "</pre>";
    ?>
    <div class="counter">
        <form action="add_cart.php" method="post" class="d-flex justify-content-center">
            <input type="hidden" name="id" value="<?=$idProduit?>">
            <button onclick="return false;" class="btn btn-primary btn-sm mx-2 counter-minus">-</button>
            <input type="number" value="<?= $qty?>" name="qty" id="qty" min=0 max=99 class="form-control w-25">
            <button onclick="return false;" class="btn btn-primary btn-sm mx-2 counter-add">+</button>
            <!-- <input type="submit" name=add_cart class="btn btn-primary btn-sm submit" value=<i class=fa-solid fa-cart-shopping></i>> -->
            <button class="btn btn-primary btn-sm submit" name=add_cart><?php echo $button?></button>
            <?php
                if($qty !== 0){
            ?>        
                    <!-- <input formaction="delete_cart.php" type="submit" value="delete" name=delete_cart class="btn btn-danger btn-sm submit"> -->
                    <button formaction="delete_cart.php" name=delete_cart class="btn btn-danger btn-sm submit"><i class="fa-solid fa-trash"></i></button>
            <?php
                }
            ?>
        </form>
    </div>
    <!-- <script src="../../asset/js/produit/counter.js"></script> -->
</body>
</html>