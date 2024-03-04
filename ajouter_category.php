<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Ajouter Category</title>
</head>
<body>
    <?php include('include/nav.php');?>
    <div class="container py-2">
        <h4 class="alert alert-info">Ajouter Category</h4>
        <div class="text-end">
            <a href="categories.php" class="btn btn-danger">Back</a>
        </div>
        <?php
            if(isset($_POST['ajouter_category'])){
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                $icone = $_POST['icone'];
                if(!empty($libelle) && !empty($description)){
                    require('include/database.php');
                    $sqlState = $pdo->prepare('INSERT INTO categorie(libelle,description,icone) VALUE(?,?,?)');
                    $sqlState->execute([$libelle, $description, $icone]);
                    ?>
                        <!-- <div class="alert alert-success">
                            Category 
                            <?php //$libelle ?> 
                            succesfully.
                        </div> -->
                    <?php
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
            <label class="form-label">Libelle</label>
            <input type="text" class="form-control" name="libelle">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
            <label class="form-label">Icone</label>
            <input type="text" class="form-control" name="icone">
            <input type="submit" value="Ajouter Category" name="ajouter_category" class="btn btn-primary my-2">
        </form>
    </div>

    
    
</body>
</html>