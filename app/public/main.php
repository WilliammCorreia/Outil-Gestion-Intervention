<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    $allTicket = $page->getAllTicket();
    
    echo $page->render('main.html.twig', ['ticket' => $allTicket]);
