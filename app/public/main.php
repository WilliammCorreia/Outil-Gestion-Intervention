<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['statut'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
    }

    $user = $page->getUser($id);

    if( $statut == 'client' ) {
        $allTicket = $page->getClientTicket($id);
    }
    elseif( $statut == 'intervenant' ) {
        $allTicket = $page->getIntervenantTicket($id);
    }
    else {
        $allTicket = $page->getAllTicket();
    }

    if(isset($_POST['addTicket'])) {

        $id_ticket = $page->addTicket([
            'sujet' => $_POST['sujet'],
            'statut' => "En attente",
            'priorite' => "normal",
            'assigne' => "-",
            'demandeur' => $user["first_name"] ." ". $user["last_name"],
            'id_client' => $id, 
            'id_intervenant' => 0
        ]);

        $page->addNote([
            'note' => $_POST['note'],
            'id_ticket' => $id_ticket,
            'id_auteur' => $id
        ]);

        header('Location: main.php?statut='. $statut .'&id='. $id);
        exit;
    }

    if(isset($_POST['modifStatut'])) {

        $page->modifStatut([
            'statut' => $_POST['statut'],
            'id_ticket' => $_POST['id_ticket']
        ]);

    }

    if(isset($_POST['addEntireTicket'])) {

        $id_ticket = $page->addTicket([
            'sujet' => $_POST['sujet'],
            'statut' => $_POST['statut'],
            'priorite' => $_POST['priorite'],
            'assigne' => $_POST['assigne'],
            'demandeur' => $_POST['demandeur'],
            'id_client' => $_POST['id_client'], 
            'id_intervenant' => $_POST['id_intervenant']
        ]);

        $page->addNote([
            'note' => $_POST['note'],
            'id_ticket' => $id_ticket,
            'id_auteur' => $id
        ]);

        header('Location: main.php?statut='. $statut .'&id='. $id);
        exit;
    }

    if(isset($_POST['modifTicket'])) {

        $id_tickets = $_POST['id_ticket'];

        $page->modifTicket($id_tickets, [
            'id_ticket' => $_POST['id_ticket'],
            'sujet' => $_POST['sujet'],
            'statut' => $_POST['statut'],
            'priorite' => $_POST['priorite'],
            'assigne' => $_POST['assigne'],
            'demandeur' => $_POST['demandeur'],
            'id_client' => $_POST['id_client'], 
            'id_intervenant' => $_POST['id_intervenant']
        ]);

        header('Location: main.php?statut='. $statut .'&id='. $id);
        exit;
    }

    if(isset($_POST['deleteTicket'])) {
        $id_Ticket = $_POST['deleteTicket'];
        $page->deleteTicket($id_Ticket);

        header('Location: main.php?statut='. $statut .'&id='. $id);
        exit;
    }
    
    echo $page->render('main.html.twig', ['ticket' => $allTicket, 'statut' => $statut, 'id' => $id]);
