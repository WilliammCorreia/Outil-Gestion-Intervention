<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
        $id_ticket = $_GET['id_ticket'];
    }

    echo $page->render('modifStatut.html.twig', ['statut' => $statut, 'id' => $id, 'id_ticket' => $id_ticket]);