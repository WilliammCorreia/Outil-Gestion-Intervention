<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = null;

    if(isset($_POST['send'])) {
        var_dump($_POST);

        $user = $page->getUserByEmail($_POST['email']);
        var_dump($user);

        if(!$user) {
            $msg = "Email ou mot de passe incorrect !";
        }
        else {
            if( !password_verify($_POST['password'], $user['password']) ) {
                $msg = "Email ou mot de passe incorrect !";
            }
            else {
                $msg = "Connecté !";
                // header('Location: profil.php');
            }
        }

    }

    echo $page->render('index.html.twig', [
        "msg" => $msg
    ]);