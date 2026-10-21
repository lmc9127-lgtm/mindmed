<?php

class User {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    
     
    public function register(string $pseudoName, string $email, string $password): bool|string {
        $check = $this->db->prepare(
            "SELECT user_id FROM users WHERE email = ? OR pseudo_name = ?"
        );
        $check->execute([$email, $pseudoName]);

        if ($check->rowCount() > 0) {
            return "Email or pseudonym already exists.";
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = $this->db->prepare(
            "INSERT INTO users (pseudo_name, email, password_hash) VALUES (?, ?, ?)"
        );

        if ($sql->execute([$pseudoName, $email, $passwordHash])) {
            return true;
        }

        return "Registration failed.";
    }

    /**
     * Authenticate and log in a user
     */
    public function login(string $email, string $password): bool|string {
        $sql = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password_hash"])) {
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["pseudo_name"] = $user["pseudo_name"];
            return true;
        }

        return $user ? "Incorrect password." : "Account not found.";
    }

    /**
     * Terminate the user session
     */
    public function logout(): void {
        session_unset();
        session_destroy();
    }
}