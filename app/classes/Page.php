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

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        $allUsers = $stmt->fetchAll();
        return $allUsers;
    }

    public function getUser(int $id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id' => $id]);
        $userInfo = $stmt->fetch();
        return $userInfo;
    }


    public function deleteUser(int $id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function modifyUser(int $id, array $data) {
        $sql = "UPDATE users SET email = :email, last_name = :last_name, first_name = :first_name, postal_nb = :postal_nb, statut = :statut WHERE id = :id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'email' => $data['email'],
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'postal_nb' => $data['postal_nb'],
            'statut' => $data['statut']
        ]);
    }

    public function addTicket(array $data)
    {
        $sql = "INSERT INTO ticket (sujet, statut, priorite, assigne, demandeur, id_client, id_intervenant) VALUES (:sujet, :statut, :priorite, :assigne, :demandeur, :id_client, :id_intervenant)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getAllTicket() {
        $sql = "SELECT * FROM ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        $allTicket = $stmt->fetchAll();
        return $allTicket;
    }

    public function getClientTicket($id_client) {
        $sql = "SELECT * FROM ticket WHERE id_client = :id_client";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id_client' => $id_client]);
        $ClientTicket = $stmt->fetchAll();
        return $ClientTicket;
    }

    public function getIntervenantTicket($id_intervenant) {
        $sql = "SELECT * FROM ticket WHERE id_intervenant = :id_intervenant";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id_intervenant' => $id_intervenant]);
        $IntervenantTicket = $stmt->fetchAll();
        return $IntervenantTicket;
    }

    public function deleteTicket() {
        $sql = "SELECT * FROM ticket WHERE id_ticket = :id_ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id_ticket' => $id_ticket]);
        $ticket = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $ticket;
    }
}