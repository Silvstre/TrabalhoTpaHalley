<?php
session_start(); // Inicia a sessão

// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirecionar para a página de login se não estiver logado
    header('Location: login.html');
    exit;
}

// Adicionando o código para deslogar
if (isset($_POST['logout'])) {
    session_destroy(); // Destroi a sessão
    header('Location: login.html'); // Redireciona para a página de login
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipamentos</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e0f7fa; /* Azul claro */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Branco */
        }

        a {
            color: #0056b3; /* Azul mais escuro */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout-button {
            background-color: #ff4d4d; /* Vermelho */
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .logout-button:hover {
            background-color: #cc0000; /* Vermelho escuro */
        }
    </style>
</head>
<body>
    <h2>Lista de Equipamentos</h2>

    <form method="POST">
        <button type="submit" name="logout" class="logout-button">Deslogar</button>
    </form>

    <a href="st.php">Adicionar Novo Equipamento</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Função</th>
            <th>Ações</th>
        </tr>
        <?php
        require_once '../Controller/EquipamentoController.php';
        $controller = new EquipamentoController();
        $equipamentos = $controller->listarEquipamentos();

        if (count($equipamentos) > 0) {
            foreach ($equipamentos as $equipamento) {
                echo "<tr>
                    <td>{$equipamento['id']}</td>
                    <td>{$equipamento['nome']}</td>
                    <td>{$equipamento['tipo']}</td>
                    <td>{$equipamento['funcao']}</td>
                    <td>
                        <a href='edit.php?id={$equipamento['id']}'>Editar</a>
                        <a href='pt.php?id={$equipamento['id']}&acao=deletar'>Deletar</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Nenhum registro encontrado!</td></tr>";
        }
        ?>
    </table>

    <?php
    // Deletar equipamento
    if (isset($_GET['acao']) && $_GET['acao'] == 'deletar' && isset($_GET['id'])) {
        $controller->deletarEquipamento($_GET['id']);
    }
    ?>
</body>
</html>
