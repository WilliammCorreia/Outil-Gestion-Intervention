<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
        $id_ticket = $_GET['id_ticket'];
    }

    $ticket = $page->getTicket($id_ticket);

    echo $page->render('modifTicket.html.twig', ['statut' => $statut, 'id' => $id, 'ticket' => $ticket]);