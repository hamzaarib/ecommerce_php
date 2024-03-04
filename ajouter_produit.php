<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Ajouter Produit</title>
</head>
<body>
    <?php 
        include('include/nav.php');
        include_once('include/database.php');
    ?>
    <div class="container py-2">
        <h4 class="alert alert-info">Ajouter Produit</h4>
        <?php
            if(isset($_POST['ajouter_produit'])){
                // $image = $_POST['image'];
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                $prix = $_POST['prix'];
                $discount = $_POST['discount'];
                $categorie = $_POST['categorie'];
                // extract($_POST);
                $date = date('Y-m-d');

                // echo "<pre>";
                // print_r($_FILES);
                // echo "</pre>";

                $fileName = "product.jpeg";
                // echo $fileName;
                // echo "<pre>";
                // print_r($_FILES['image']);
                // echo "</pre>";die();
                if(!empty($_FILES['image']['name'])){
                    $image = $_FILES['image']['name'];
                    $fileName = uniqid() . $image;
                    move_uploaded_file($_FILES['image']['tmp_name'],"upload/produit/" . $fileName);

                    
                    // var_dump($image);
                }
                // die();
                if(!empty($libelle) && !empty($prix) && !empty($categorie)){
                    $sqlState = $pdo->prepare('INSERT INTO produit VALUES(null,?,?,?,?,?,?,?)');
                    $sqlState->execute([$fileName, $libelle, $description, $prix, $discount, $categorie, $date]);
                        ?>
                        <!-- <div class="alert alert-success">
                            Produit 
                            <?php //$libelle ?>
                            succesfully.
                        </div> -->
                        
                    <?php
                    header("location: produit.php");
                }else{
                    ?>
                        <div class="alert alert-danger">
                            libelle, prix, category sons obligatoire
                        </div>
                    <?php
                }

                

                // echo "Libelle : $libelle 
                //         Prix : $prix
                //         Discount : $discount
                //         Category : $categorie
                //         Date : $date";
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data" class="container w-50">
            <label class="form-label">Image</label>
            <input type="file" class="form-control mb-3" name="image">

            <label class="form-label">Libelle</label>
            <input type="text" class="form-control mb-3" name="libelle">

            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>

            <label class="form-label">Prix</label>
            <input type="number" name="prix" step="0.1" min=0 class="form-control mb-3">

            <label class="form-label">Discount</label>
            <input type="number" name="discount" min=0 max=90 step="0.1" class="form-control mb-3">
            <?php
                // $sqlState = $pdo->prepare('SELECT * FROM categorie');
                // $sqlState->execute();
                // echo "<pre>";
                // print_r($sqlState->fetchAll());
                // echo "</pre>";

                // $categories = $pdo->query('SELECT * FROM categorie')->fetchAll();
                // $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_OBJ);
                $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                    // echo "<pre>";
                    // print_r($categories);
                    // echo "</pre>";
            
            ?>


            <label class="form-label">Category</label>
            <select name="categorie" class="form-control mb-3">
                <option value="" hidden></option>
                <?php
                    foreach ($categories as $category) {
                        echo "<option value=".$category['id'].">".$category['libelle']."</option>";
                    }
                ?>
                
            </select>
            <input type="submit" value="Ajouter Produit" name="ajouter_produit" class="btn btn-primary my-2">
        </form>
    </div>

    
    
</body>
</html>