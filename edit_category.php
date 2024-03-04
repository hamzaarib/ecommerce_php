<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Edit Category</title>
</head>
<body>
    <?php 
    include('include/nav.php');
    include('include/database.php');
    ?>
    <div class="container py-2">
        <h4 class="alert alert-info">Edit Category</h4>
        <div class="text-end">
            <a href="categories.php" class="btn btn-danger">Back</a>
        </div>
        <?php
            // var_dump($_GET);
            $sqlState = $pdo->prepare('SELECT * FROM categorie WHERE id=?');
            $id = $_GET['id'];
            $sqlState->execute(["$id"]);
            // echo '<pre>';
            // print_r($sqlState->fetch());
            // echo '</pre>';
            $category = $sqlState->fetch(PDO::FETCH_ASSOC);
            if(isset($_POST['edit_category'])){
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                $icone = $_POST['icone'];
                if(!empty($libelle) && !empty($description)){
                    $sqlState = $pdo->prepare("UPDATE categorie SET libelle=?,description=?,icone=? WHERE id=?");
                    $sqlState->execute([$libelle, $description, $icone,$id]);
                    header('location: categories.php');
                }else{
                    ?>
                        <div class="alert alert-danger">
                            libelle, description sons obligatoire
                        </div>
                    <?php
                }
            }
        ?>
        <form action="" method="post" class="container w-50">
            <!-- <label class="form-label">ID</label> -->
            <input type="hidden" class="form-control" name="id" value="<?= $category['id']?>">
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" name="libelle" value="<?= $category['libelle']?>">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?= $category['description']?></textarea>
            <label class="form-label">Icone</label>
            <input type="text" class="form-control" name="icone" value="<?= $category['icone']?>">
            <input type="submit" value="Edit Category" name="edit_category" class="btn btn-primary my-2">
        </form>
    </div>

    
    
</body>
</html>