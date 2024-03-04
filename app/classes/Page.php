<?php

namespace App;

class Page
{
    private \Twig\Environment $twig;
    private $link;
    public $session;

    function __construct()
    {
        $this->session = new Session();
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => '../var/cache/compilation_cache',
            'debug' => true
        ]);

        $this->link = new \PDO('mysql:host=mysql;dbname=b2-paris', "root", "");
    }

    public function insert(string $table_name, array $data)
    {
        $sql = "INSERT INTO ". $table_name ." (email, password, last_name, first_name, postal_nb) VALUES (:email, :password, :last_name, :first_name, :postal_nb)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getUserByEmail(string $email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function render(string $name, array $data) :string
    {
        return $this->twig->render($name, $data);
    }

    public function getAllTicket() {
        $sql = "SELECT * FROM ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        $allTicket = $stmt->fetchAll();
        return $allTicket;
    }
}