<?php
    session_start();
    require_once('../include/database.php');
    require_once("../include/nav_front.php");
    $idUtilisateur = isset($_SESSION['utilisateur']['id']) ? $_SESSION['utilisateur']['id'] : null;
    $cart = isset($_SESSION['cart'][$idUtilisateur]) ? $_SESSION['cart'][$idUtilisateur] : [];

    // add counter in title the page cart in h4
    $count = $_SESSION['cart'][$idUtilisateur];

    if(!empty($cart)){
        $idProduit = array_keys($cart);
        $idProduit = implode(",",$idProduit);
        $produits = $pdo->query("SELECT * FROM produit WHERE id IN ($idProduit)")->fetchAll(PDO::FETCH_ASSOC);
    }


    // click button "Clear The Cart" delete all product in cart.php
    if (isset($_POST['clear'])) {
        $_SESSION['cart'][$idUtilisateur] = [];
        header('Location: cart.php');
        exit(); // ليس ضروريًا بعد استخدام header
    }
    // click button "Validate The Cart"
    if(isset($_POST['validate'])){
        $sql = 'INSERT INTO ligne_commande(id_produit,id_commande,prix,quantite,total) VALUES';
        $total = 0;
        $prixProduits = [] ;
        foreach ($produits as $produit) {
            $idProduit = $produit['id'];
            $qty = $cart[$idProduit];
            $prix = $produit['prix'];
            $total+=$qty*$prix;
            $prixProduits[$idProduit] = [
                "id" => $idProduit,
                "prix" => $prix,
                "total" => $qty*$prix,
                "qty" => $qty
            ];
        }
        $sqlStateCommande = $pdo->prepare('INSERT INTO commande(id_client,total) VALUES(?,?)');
        $sqlStateCommande->execute([$idUtilisateur,$total]);
        $idCommande = $pdo->lastInsertId();
        $args = [];
        foreach ($prixProduits as $produit) {
            $id = $produit['id'];
            $sql .= "(:id$id, '$idCommande', :prix$id, :qty$id, :total$id),";
        }
        $sql = substr($sql, 0,-1);
        $sqlState = $pdo->prepare($sql);
        foreach ($prixProduits as $produit) {
            $id = $produit['id'];
            $sqlState->bindParam(':id'.$id, $produit['id']);
            $sqlState->bindParam(':prix'.$id, $produit['prix']);
            $sqlState->bindParam(':qty'.$id, $produit['qty']);
            $sqlState->bindParam(':total'.$id, $produit['total']);
        }
        $inserted = $sqlState->execute();
        if($inserted){
            $_SESSION['cart'][$idUtilisateur] = [];
            ?>
                <div class="alert alert-success text-center ">
                    <h3 class="text-primary">The commande and The payan (<?=$total?>) Is success Add</h3>
                </div>
            <?php
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cart</title>
</head>
<body>
    <div class="container py-2">
        <h4 class="alert alert-primary">Cart(<?= count($_SESSION['cart'][$idUtilisateur])?>)</h4>
        <div class="text-end">
            <a href="index.php" class="btn btn-danger">
                Back
            </a>
        </div>
        <ul class="list-group list-group-flush">
            <div class="container">
                <div class="row m-2">
                    <?php
                        // $idUtilisateur = $_SESSION['utilisateur']['id'];
                        // $cart = $_SESSION['cart'][$idUtilisateur];
                        // var_dump($sqlState->debugDumpParams());
                        // echo "<pre>";
                        // print_r($produits);
                        // echo "</pre>";
                        // var_dump($cart);
                        if(empty($cart)){
                            ?>
                            <div class="alert alert-warning text-center ">
                                <h3 class="text-danger">The Cart Is A Empty</h3>
                            </div>
                            <?php
                        }else{

                            ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Libelle</th>
                                            <th>Prix</th>
                                            <th>Quantite</th>
                                            <th>total</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    <?php
                                        $sum = 0;
                                        foreach ($produits as $produit) {
                                            $idProduit = $produit['id'];
                                            $prix = $produit['prix'];
                                            $discount = $produit['discount'];
                                            if(!empty($discount)){
                                                $total = $prix - (($prix * $discount)/100);
                                            }else{
                                                $total = $prix;
                                            }
                                            $totalProduit = $total * ($cart[$idProduit]);
                                            $sum = $totalProduit + $sum;
                                            ?>
                                                <tr>
                                                    <td><?= $produit['id']?></td>
                                                    <td>
                                                        <img src="../upload/produit/<?= $produit['image']?>"
                                                            alt="<?= $produit['libelle']?>"
                                                            width="80px" height="80px"
                                                        />
                                                    </td>
                                                    <td><?= $produit['libelle']?></td>
                                                    <td><?= $total . " MAD"?></td>
                                                    <!-- <td>
                                                        <?php
                                                            // $cart[$produit['id']];
                                                        ?>
                                                    </td> -->
                                                    <td>
                                                        <?php
                                                        include("../include/front/counter.php");
                                                        ?>
                                                    </td>
                                                    <td><?= $totalProduit." MAD"?></td>
                                                </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr class="text-end">
                                        <th colspan="5">Total</th>
                                        <th class="text-center"><?=$sum?></th>
                                    </tr>
                                    <tr class="text-end">
                                        <td colspan="6">
                                            <form action="" method="post">
                                                <input type="submit" 
                                                        name="validate" 
                                                        class="btn btn-success btn-sm" 
                                                        value="Validate The Cart"
                                                    />
                                                <input type="submit" 
                                                        name="clear" 
                                                        onclick="return confirm('Are You Sure Clear The Cart')" 
                                                        class="btn btn-danger btn-sm" 
                                                        value="Clear The Cart"
                                                    />
                                            </form>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                        }
                    ?>
                    
                </div>
            </div>
        </ul>
    </div>
    <script src="../asset/js/produit/counter.js"></script>
    <!-- <script src="../bootstrap/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>