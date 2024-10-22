<?php
session_start(); // Inicia a sessão

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirecionar para a página de login se não estiver logado
    header('Location: login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Equipamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Azul claro */
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #0056b3; /* Azul mais escuro */
        }

        form {
            background-color: #e0f7fa; /* Azul claro */
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #0056b3; /* Azul mais escuro */
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }

        button:hover {
            background-color: #004494; /* Azul ainda mais escuro */
        }
    </style>
</head>
<body>
    <h2>Adicionar Equipamento</h2>
    <form action="st.php" method="POST">
        <label for="nome">Nome do Equipamento:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="tipo">Tipo de Equipamento:</label>
        <input type="text" id="tipo" name="tipo" required>

        <label for="funcao">Função do Equipamento:</label>
        <input type="text" id="funcao" name="funcao" required>

        <button type="submit">Adicionar Equipamento</button>
    </form>
    <?php
    require_once '../Controller/EquipamentoController.php';
    $controller = new EquipamentoController();
    $controller->criarEquipamento();
    ?>
</body>
</html>
