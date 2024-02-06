<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    # Cela nous envoie les infos du formulaire
    # Cela vérifie que $_POST['send'] existe
    if(isset($_POST['send'])) {

        # Cela insert les données que l'on récupère du formulaire dans la BDD
        $page->insert('users', [
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        header('Location: index.php');
    }

    echo $page->render('register.html.twig', []);