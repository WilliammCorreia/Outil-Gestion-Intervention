<?php
    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
        $user = $page->getUser($id);
    }

    echo $page->render('profil.html.twig', ['statut' => $statut, 'id' => $id, 'user' => $user]);
    