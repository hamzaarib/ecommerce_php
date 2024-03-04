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
        <?php
            // session_start();
            if(!isset($_SESSION['utilisateur'])){
                header('location: connexion.php');
                // echo "acces refuse";die();
            }
            // var_dump($_SESSION['utilisateur']);
        ?>
        <h4>Hello <?php echo $_SESSION['utilisateur']['login']."<br>";?></h4>
    </div>

    
    
</body>
</html>