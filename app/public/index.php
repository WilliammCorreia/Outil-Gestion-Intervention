<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = null;

    if(isset($_POST['send'])) {

        $user = $page->getUserByEmail($_POST['email']);

        if(!$user) {
            $msg = "Email ou mot de passe incorrect !";
        }
        else {
            if( !password_verify($_POST['password'], $user['password']) ) {
                $msg = "Email ou mot de passe incorrect !";
            }
            else {
                $msg = "Connecté !";
                $page->session->add('user', $user);
                header('Location: main.php?statut='. $user['statut'] .'&id='. $user['id']);
            }
        }

    }

    echo $page->render('index.html.twig', [
        "msg" => $msg
    ]);