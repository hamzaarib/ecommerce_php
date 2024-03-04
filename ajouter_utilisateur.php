<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

    <?php
        include('include/nav.php');
        // require('include/database.php');

    ?>
    <div class="container py-2">
        <h4 class="alert alert-info">Ajouter utilisateur</h4>
        <form action="" method="post" class="container w-50">
            <?php
                if(isset($_POST['ajouter'])){
                    // echo "Yes";
                    $login = $_POST['login'];
                    $password = $_POST['password'];
                    if(!empty($login) && !empty($password)){
                        require('include/database.php');
                        $date = date('Y-m-d');
                        // var_dump($date);
                        $sqlState = $pdo->prepare('INSERT INTO utilisateur VALUE (null,?,?,?)');
                        $sqlState->execute([$login, $password, $date]);
                        //Redirection
                        header('location: connexion.php');
                    }else{
                        ?>
                            <div class="alert alert-danger">
                                login, password sons obligatoire
                            </div>
                        <?php
                    }
                }
            ?>
        
            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="login">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
            <input type="submit" value="Ajouter utilisateur" name="ajouter" class="btn btn-primary my-2">
        </form>
    </div>

    
    
</body>
</html>