<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>List Des Commande</title>
</head>
<body>
    <?php
        include('include/nav.php');
        include_once('include/database.php');
    ?>
    <div class="container py-2">
        <h4 class="alert alert-info">List Des Commande</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $commandes = $pdo->query('SELECT commande.*, utilisateur.login AS "Client"
                        FROM commande JOIN utilisateur
                        ON commande.id_client = utilisateur.id ORDER BY date_creation DESC;')->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($commandes as $commande) {
                        ?>
                            <tr>
                                <td><?= $commande["id"];?></td>
                                <!-- <td><i class="<?= $commande["icone"]?>"></i> <?= $commande["libelle"];?></td> -->
                                <td><?= $commande["Client"];?></td>
                                <td><?= $commande["total"]. " DH";?></td>
                                <td><?= $commande["date_creation"];?></td>
                                <td>
                                    <a href="./front/commande.php?id=<?=$commande["id"]?>" class="btn btn-info btn-sm">show details</a>
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