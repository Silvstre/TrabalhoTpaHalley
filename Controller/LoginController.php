<?php
session_start(); // Iniciar a sessão

require_once '../Model/conexao.php';
require_once '../Model/UserModel.php';

class LoginController {
    private $db;
    private $user;

    public function __construct() {
        // Conectar ao banco de dados
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Função para processar o login
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Coletar dados do formulário
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            // Validar os dados
            if (!empty($login) && !empty($senha)) {
                // Verificar as credenciais no model
                if ($this->user->verifyLogin($login, $senha)) {
                    // Credenciais válidas, criar sessão
                    $_SESSION['loggedin'] = true;
                    $_SESSION['login'] = $login;

                    // Redirecionar para a página pt.html
                    header("Location: ../View/pt.php");
                    exit(); // Parar a execução após o redirecionamento
                } else {
                    // Credenciais inválidas
                    echo "Login ou senha incorretos!";
                }
            } else {
                echo "Por favor, preencha todos os campos!";
            }
        }
    }
}

// Processar a requisição
$controller = new LoginController();
$controller->login();
?>
