<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    // Modifier un user
    if (isset($_POST['userModif'])) {
        $userId = $_POST['userModif'];
    }

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
    }

    $userInfo = $page->getUser($userId);
    echo $page->render('modifAdmin.html.twig', ['user' => $userInfo, 'statut' => $statut, 'id' => $id]);