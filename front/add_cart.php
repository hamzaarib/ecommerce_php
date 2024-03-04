<?php
    session_start();
    if(!isset($_SESSION['utilisateur'])){
        header('location: ../connexion.php');
    }
    // print_r($_POST);
    $id = $_POST['id'];
    $qyt = $_POST['qty'];
    echo gettype($qyt);
    $idUtilisateur = $_SESSION['utilisateur']['id'];
    // var_dump($idUtilisateur);die();
        if(!isset($_SESSION['cart'][$idUtilisateur])){
            $_SESSION['cart'][$idUtilisateur] = [];
        }
        if($qyt == 0){
            unset($_SESSION['cart'][$idUtilisateur][$id]);
        }else{
            $_SESSION['cart'][$idUtilisateur][$id] = $qyt;
        }
        // $_SESSION['cart'][$idUtilisateur][$id] = $qyt;

        // echo "<pre>";
        // print_r($_SESSION['cart']);
        // echo "</pre>";

        // echo "<pre>";
        // print_r($_SESSION['utilisateur']);
        // echo "</pre>";
        // header("location: produit.php?id=$id");
        header("location:" . $_SERVER['HTTP_REFERER']);
// session_destroy();

?>