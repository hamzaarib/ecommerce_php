<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>List Des Categories</title>
</head>
<body>
    <?php
        include('include/nav.php');
        include_once('include/database.php');
    ?>
    <div class="container py-2">
        <h4 class="alert alert-info">List Des Categories</h4>
        <div class="text-end">
            <a href="ajouter_category.php" class="btn btn-dark">Ajouter Category</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                    // echo "<pre>";
                    // print_r($categories);
                    // echo "</pre>";
                    foreach ($categories as $category) {
                        ?>
                            <tr>
                                <td><?= $category["id"];?></td>
                                <td><i class="<?= $category["icone"]?>"></i> <?= $category["libelle"];?></td>
                                <td><?= $category["description"];?></td>
                                <td><?= $category["date_creation"];?></td>
                                <td>
                                    <!-- <input type="submit" value="Edit" class="btn btn-primary btn-sm">
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm"> -->
                                    <a href="edit_category.php?id=<?=$category["id"]?>"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="delete_category.php?id=<?=$category["id"]?>"
                                        onclick="return confirm('Are You Sure Deleted <?= $category['libelle']?>')"
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