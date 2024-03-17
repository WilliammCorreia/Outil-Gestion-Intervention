<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    $statut = $_GET['statut'];
    $id = $_GET['id'];

    $allUsers = $page->getAllUsers();
    
    echo $page->render('admin.html.twig', ['users' => $allUsers, 'statut' => $statut, 'id' => $id]);

    // Supprimer un user
    if (isset($_POST['user_id'])) {

        $userId = $_POST['user_id'];
        $page->deleteUser($userId);
    }
    
    // Modifier un user
    if (isset($_POST['userModif'])) {

        $userId = $_POST['id'];

        $page->modifyUser($userId, [
            'email' => $_POST['email'],
            'last_name' => $_POST['last_name'],
            'first_name' => $_POST['first_name'],
            'postal_nb' => $_POST['postal_nb'],
            'statut' => $_POST['statut']
        ]);
    }