<?php
require_once '../Model/conexao.php';
require_once '../Model/UserModel.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        // Conectar ao banco de dados
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Função para criar usuário
    public function createUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Coletar dados do formulário
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            // Validar dados
            if (!empty($login) && !empty($senha)) {
                // Chamar o model para criar o usuário
                if ($this->user->create($login, $senha)) {
                    // Usuário criado com sucesso, redirecionar para a página de login
                    header("Location: ../View/login.html");
                    exit(); // Importante usar exit() após redirecionar
                } else {
                    echo "Erro ao criar usuário!";
                }
            } else {
                echo "Preencha todos os campos!";
            }
        }
    }
}

// Processar requisição
$controller = new UserController();
$controller->createUser();
?>
