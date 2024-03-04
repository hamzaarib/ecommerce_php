<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produit</title>
</head>
<body>
    <?php 
        include('include/nav.php');
        include('include/database.php');
    ?>
    <div class="container py-2">
    <h4 class="alert alert-info">Edit Produit</h4>
    <div class="text-end">
        <a href="produit.php" class="btn btn-danger">Back</a>
    </div>
    <?php
    // print_r($_GET);
    $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute(["$id"]);
    // echo '<pre>';
    // print_r($sqlState->fetch());
    // echo '</pre>';
    $produit = $sqlState->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST['edit_produit'])){
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $discount = $_POST['discount'];
        $categorie = $_POST['categorie'];

        $fileName = "";
        // var_dump($_FILES);die();
        if(!empty($_FILES['image']['name'])){
            $image = $_FILES['image']['name'];
            $fileName = uniqid() . $image;
            move_uploaded_file($_FILES['image']['tmp_name'],"./upload/produit/" . $fileName);
        }

        if(!empty($libelle) && !empty($prix) && !empty($categorie)){
            if(!empty($fileName)){
                $query = 'UPDATE produit SET image=?, libelle=?, description=?,prix=?,discount=?,categorie_id=? WHERE id=?';
                $sqlState = $pdo->prepare($query);
                $sqlState->execute([$fileName, $libelle, $description, $prix, $discount, $categorie,$id]);
            }else{
                $query = 'UPDATE produit SET libelle=?, description=?,prix=?,discount=?,categorie_id=? WHERE id=?';
                $sqlState = $pdo->prepare($query);
                $sqlState->execute([$libelle, $description, $prix, $discount, $categorie,$id]);
            }
            // var_dump($sqlStat->errorInfo());
            header("location: produit.php");
        }
    }
?>
    <form action="" method="post" enctype="multipart/form-data" class="container w-50">
        <input type="hidden" name="id" value = "<?= $produit['id']?>" class="form-control mb-3">
        <label class="form-label">image</label>
        <input type="file" class="form-control mb-3" name="image" value = "<?= $produit['image']?>">
        <img src="./upload/produit/<?= $produit['image']?>" alt="" height = "250px" class="form-control mb-3">
        <?php
            
        ?>

        <label class="form-label">Libelle</label>
        <input type="text" class="form-control mb-3" name="libelle" value = "<?= $produit['libelle']?>">
        <label class="form-label">description</label>
        <textarea name="description"class="form-control"><?= $produit['description']?></textarea>
        <label class="form-label">Prix</label>
        <input type="number" name="prix" step="0.1" min=0 value = "<?= $produit['prix']?>" class="form-control mb-3">
        <label class="form-label">Discount</label>
        <input type="number" name="discount" min=0 max=90 step="0.1" value = "<?= $produit['discount']?>" class="form-control mb-3">
        <?php
            $categories = $pdo->query('SELECT * FROM categorie')->fetchAll(PDO::FETCH_ASSOC);
                // echo "<pre>";
                // print_r($produit['categorie_id']);
                // echo "</pre>";
        ?>
        <label class="form-label">Category</label>
        <select name="categorie" class="form-control mb-3">
            <option value="" hidden></option>
            <?php
                foreach ($categories as $category) {
                    // if($produit['categorie_id'] == $category['id']){
                    //     echo "<option selected value=".$category['id'].">".$category['libelle']."</option>";
                    // }else{
                    //     echo "<option value=".$category['id'].">".$category['libelle']."</option>";
                    // }
                //or
                    // $selected = '';
                    // if($produit['categorie_id'] == $category['id']){
                    //     $selected = "selected";
                    // }
                    // echo "<option $selected value=".$category['id'].">".$category['libelle']."</option>";
                //or
                    $selected = $produit['categorie_id'] == $category['id']?"selected":'';
                    echo "<option $selected value=".$category['id'].">".$category['libelle']."</option>";
                }
            ?>
        </select>
        <input type="submit" value="Edit Produit" name="edit_produit" class="btn btn-primary my-2">
    </form>
    </div>
</body>
</html>