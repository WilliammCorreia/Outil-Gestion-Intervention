<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
    }

    if( $statut == 'client' ) {
        $allTicket = $page->getClientTicket($id);
    }
    elseif( $statut == 'intervenant' ) {
        $allTicket = $page->getIntervenantTicket($id);
    }
    else {
        $allTicket = $page->getAllTicket();
    }

    
    echo $page->render('main.html.twig', ['ticket' => $allTicket]);
