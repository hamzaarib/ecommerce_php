<?php
    // print_r($_GET['id']);
    require_once('include/database.php');
    $id = $_GET['id'];
    $sqlState = $pdo->prepare('DELETE FROM produit WHERE id=?');
    $delete = $sqlState->execute(["$id"]);
    header('location: produit.php');

?>