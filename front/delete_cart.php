<?php
    session_start();
    if(!isset($_SESSION['utilisateur'])){
        header('location: ../connexion.php');
    }
    $id = $_POST['id'];
    $idUtilisateur = $_SESSION['utilisateur']['id'];
    unset($_SESSION['cart'][$idUtilisateur][$id]);
    header("location:" . $_SERVER['HTTP_REFERER']);


?>