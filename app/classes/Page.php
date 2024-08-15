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

    public function modifyProfil(int $id, array $data) {
        $sql = "UPDATE users SET email = :email, password = :password, last_name = :last_name, first_name = :first_name, postal_nb = :postal_nb, statut = :statut WHERE id = :id";
        $stmt = $this->link->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'email' => $data['email'],
            'password' => $data['password'],
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

        $id_ticket = $this->link->lastInsertId();
        return $id_ticket;
    }

    public function addNote(array $data)
    {
        $sql = "INSERT INTO note (note, id_ticket, id_auteur) VALUES (:note, :id_ticket, :id_auteur)";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function getNote(int $id_ticket) {
        $sql = "SELECT * FROM note JOIN users WHERE id_ticket = :id_ticket AND users.id LIKE note.id_auteur";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id_ticket' => $id_ticket]);
        $note = $stmt->fetchAll();
        return $note;
    }

    public function getUserOfANote(int $id_auteur) {
        $sql = "SELECT * FROM users WHERE id = :id_auteur";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id_auteur' => $id_auteur]);
        $userNote = $stmt->fetch();
        return $userNote;
    }

    public function getAllTicket() {
        $sql = "SELECT * FROM ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute();
        $allTicket = $stmt->fetchAll();
        return $allTicket;
    }

    public function getTicket(int $id_ticket) {
        $sql = "SELECT * FROM ticket WHERE id_ticket = :id_ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id_ticket' => $id_ticket]);
        $ticket = $stmt->fetch();
        return $ticket;
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

    public function modifTicket(int $id_ticket, array $data) {
        $sql = "UPDATE ticket SET id_ticket = :id_ticket, sujet = :sujet, statut = :statut, priorite = :priorite, assigne = :assigne, demandeur = :demandeur, id_client = :id_client, id_intervenant = :id_intervenant WHERE id_ticket = :id_ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function modifStatut(array $data) {
        $sql = "UPDATE ticket SET statut = :statut WHERE id_ticket = :id_ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute($data);
    }

    public function deleteTicket(int $id_ticket) {
        $sql = "DELETE FROM ticket WHERE id_ticket = :id_ticket";
        $stmt = $this->link->prepare($sql);
        $stmt->execute(['id_ticket' => $id_ticket]);
    }
}