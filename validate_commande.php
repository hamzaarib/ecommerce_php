<?php
    include_once('./include/database.php');
    // var_dump($_GET);
    $id = $_GET['id'];
    $state = $_GET['state'];
    $sqlState = $pdo->prepare("UPDATE commande SET valide=? WHERE id=?");
    $sqlState->execute([$state,$id]);
    header("Location: ./front/commande.php?id=$id");
?>