<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Função para criar um novo usuário (já existente)
    public function create($login, $senha) {
        $query = "INSERT INTO usuario (login, senha) VALUES (:login, :senha)";
        $stmt = $this->conn->prepare($query);

        // Limpar os dados
        $login = htmlspecialchars(strip_tags($login));
        $hashed_senha = password_hash($senha, PASSWORD_DEFAULT); // Criptografar a senha

        // Vincular parâmetros
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $hashed_senha);

        // Executar a query
        return $stmt->execute();
    }

    // Função para verificar o login do usuário
    public function verifyLogin($login, $senha) {
        $query = "SELECT senha FROM usuario WHERE login = :login";
        $stmt = $this->conn->prepare($query);

        // Limpar o login
        $login = htmlspecialchars(strip_tags($login));

        // Vincular o login ao parâmetro
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        // Verificar se o login existe
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_senha = $row['senha'];

            // Verificar se a senha corresponde ao hash armazenado
            if (password_verify($senha, $hashed_senha)) {
                return true; // Login e senha estão corretos
            }
        }

        return false; // Credenciais inválidas
    }
}
?>
