<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
    }

    echo $page->render('addTicket.html.twig', ['statut' => $statut, 'id' => $id]);