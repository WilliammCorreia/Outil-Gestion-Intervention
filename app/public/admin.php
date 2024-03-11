<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    $allUsers = $page->getAllUsers();
    $page->deleteUser();
    
    echo $page->render('admin.html.twig', ['users' => $allUsers]);
