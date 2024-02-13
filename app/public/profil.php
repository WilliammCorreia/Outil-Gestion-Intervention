<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    
    var_dump($page->session->get('user'));