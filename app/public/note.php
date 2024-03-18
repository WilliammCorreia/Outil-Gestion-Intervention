<?php
    ob_start();

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_GET['id_ticket'])) {
        $statut = $_GET['statut'];
        $id = $_GET['id'];
        $id_ticket = $_GET['id_ticket'];
        $user = $page->getUser($id);
    }

    $notes = $page->getNote($id_ticket);

    echo $page->render('note.html.twig', ['statut' => $statut, 'id' => $id, 'notes' => $notes, 'id_ticket' => $id_ticket, 'user' => $user]);

    if(isset($_POST['addNote'])) {
        
        $page->addNote([
            'note' => $_POST['addNote'],
            'id_ticket' => $id_ticket,
            'id_auteur' => $id
        ]);

        header('Location: note.php?statut='. $statut .'&id='. $id .'&id_ticket='. $id_ticket);
        exit;
    }
    