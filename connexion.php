<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Connexion</title>
</head>
<body>
    <?php
        include('include/nav.php');
    ?>
    <div class="container py-2">
        <?php 
            if(isset($_POST['connexion'])){
                $login = $_POST['login'];
                $password = $_POST['password'];

                if(!empty($login) && !empty($password)){
                    require_once('include/database.php');
                    $sqlState = $pdo->prepare('SELECT * FROM utilisateur 
                                            WHERE login = ? AND password = ?');
                    $sqlState->execute([$login,$password]);
                    // echo $sqlState->rowCount();
                    if($sqlState->rowCount() >=1){
                        // echo "utilisateur valide";
                        // session_start();
                        // echo "<pre>";
                        // var_dump($sqlState->fetch());
                        // echo "</pre>";
                        $_SESSION['utilisateur'] = $sqlState->fetch();
                        header('location: admin.php');
                    }else{
                        ?>
                            <div class="alert alert-danger">
                                login ou password incorrectes
                            </div>
                        <?php
                    }
                }else{
                    ?>
                        <div class="alert alert-danger">
                            login, password sons obligatoire
                        </div>
                    <?php
                    
                }
            }
        ?>
        <h4 class="alert alert-info">Connexion</h4>
        <form action="" method="post" class="container w-50">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="login">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password">
            <input type="submit" value="Connexion" name="connexion" class="btn btn-primary my-2">
        </form>  
    </div>
</body>
</html>