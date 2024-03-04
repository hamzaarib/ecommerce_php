<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once("include/nav.php");
        include("include/database.php");
    ?>
    <div class="container py-2">
        <h4 class="alert alert-info">List Des Produit</h4>
        <div class="text-end">
            <a href="ajouter_produit.php" class="btn btn-dark">Ajouter Produit</a>
        </div>
        <table class="table striped text-center">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Image</th>
                    <th>Libelle</th>
                    <th>description</th>
                    <th>Prix</th>
                    <th>Discount</th>
                    <th>Prix_Dis</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $produits = $pdo->query('SELECT produit.*,categorie.libelle AS "categorie_libelle"
                            FROM produit JOIN categorie 
                            ON produit.categorie_id = categorie.id;'
                            )->fetchAll(PDO::FETCH_OBJ);
                // print_r($produit);
                foreach ($produits as $produit) {
                    // echo "<pre>";
                    // print_r($produit);
                    // echo "</pre>";
                    $prix = $produit->prix;
                    $discount = $produit->discount;
                    $prixFinal = $prix - (($prix*$discount) / 100);
                    ?>
                    <tr>
                        <td><?= $produit->id;?></td>
                        <td>
                            <img src="./upload/produit/<?= $produit->image?>"
                                alt="<?= $produit->libelle?>"
                                width="100px" height="100px"
                            />
                        </td>
                        <td><?= $produit->libelle?></td>
                        <td><?= $produit->description?></td>
                        <td><?= $prix?> DH</td>
                        <td><?= $discount?> %</td>
                        <td><?= $prixFinal ?> DH</td>
                        <td><?= $produit->categorie_libelle;?></td>
                        <td><?= $produit->date_creation;?></td>
                        <td>
                            <a href="edit_produit.php?id=<?=$produit->id?>" 
                                class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="delete_produit.php?id=<?=$produit->id?>" 
                                onclick="return confirm('Are You Sure Deleted <?=$produit->libelle?>')"
                                class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>