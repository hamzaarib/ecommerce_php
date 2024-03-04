<?php 
    // var_dump($_GET);
    require_once('include/database.php');
    $id = $_GET['id'];
    // echo $id;
    $sqlState = $pdo->prepare("DELETE FROM categorie WHERE id=?");
    $delete = $sqlState->execute(["$id"]);
    header('location: categories.php');
?>