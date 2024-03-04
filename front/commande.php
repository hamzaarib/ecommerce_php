<?php
    // session_start();
    require_once('../include/database.php');
    $idCommende = $_GET['id'];
    $sqlState = $pdo->prepare("SELECT commande.*, utilisateur.login AS 'Client'
                FROM commande JOIN utilisateur
                ON commande.id_client = utilisateur.id 
                WHERE commande.id=? ORDER BY date_creation DESC");
    $sqlState->execute([$idCommende]);
    $commande = $sqlState->fetch(PDO::FETCH_ASSOC);

    // $sqlState = $pdo->prepare("SELECT * FROM produit WHERE categorie_id=?");
    // $sqlState->execute([$id]);
    // $produit = $sqlState->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../asset/css/produit.css"> -->
    <title>Commande Number|<?= $commande['id']?></title>
</head>
<body>
    <?php require_once("../include/nav.php");?>
    <div class="container py-2">
        <h4 class="alert alert-info">Detailes Commande | <b class="text-danger"><?= $commande['id']?></b></h4>
        <div class="text-end">
            <a href="../commandes.php" class="btn btn-danger">
                Back
            </a>
        </div>
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sqlStateLigneCommande = $pdo->prepare("SELECT ligne_commande.*, produit.libelle, produit.image 
                            FROM ligne_commande JOIN produit ON ligne_commande.id_produit = produit.id
                            WHERE id_commande=?");
                    $sqlStateLigneCommande->execute([$idCommende]);
                    $lignCommandes = $sqlStateLigneCommande->fetchAll(PDO::FETCH_OBJ);
                    // echo "<pre>";
                    // print_r($lignCommande);
                    // echo "</pre>";
                ?>
                <tr>
                    <th><?= $idCommende?></th>
                    <td><?= $commande['Client']?></td>
                    <td><?= $commande['total']." DH"?></td>
                    <td><?= $commande['date_creation']?></td>
                    <td>
                        <?php if($commande['valide']==0):?>
                            <a href="../validate_commande.php?id=<?= $commande['id']?>&state=1" class="btn btn-success btn-sm">Validate The Commande</a>
                        <?php else:?>
                            <a href="../validate_commande.php?id=<?= $commande['id']?>&state=0" class="btn btn-danger btn-sm">Cancel The Commande</a>
                        <?php endif;?>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <h4>Produit :</h4>
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Produit</th>
                    <th>Prix unitary</th>
                    <th>Quantite</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lignCommandes as $lignCommande) :?>
                    <tr>
                        <th><?= $lignCommande->id?></th>
                        <td><?= $lignCommande->libelle?></td>
                        <td><?= $lignCommande->prix ." DH"?></td>
                        <td><?= "X".$lignCommande->quantite?></td>
                        <td><?= $lignCommande->total." DH"?></td>
                    </tr> 
                    
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- <script src="../asset/js/produit/counter.js"></script> -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>