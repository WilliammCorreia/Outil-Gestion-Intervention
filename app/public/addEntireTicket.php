<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
    }

    echo $page->render('addEntireTicket.html.twig', ['statut' => $statut, 'id' => $id]);