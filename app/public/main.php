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

    $user = $page->getUser($id);

    if(isset($_POST['addTicket'])) {

        $page->addTicket([
            'sujet' => $_POST['sujet'],
            'statut' => "En attente",
            'priorite' => "normal",
            'assigne' => "-",
            'demandeur' => $user["first_name"] ." ". $user["last_name"],
            'id_client' => $id,
            'id_intervenant' => 0
        ]);

    }
    
    echo $page->render('main.html.twig', ['ticket' => $allTicket, 'statut' => $statut, 'id' => $id]);
