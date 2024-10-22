<?php
require_once '../Model/EquipamentoModel.php';

class EquipamentoController {
    private $equipamento;

    public function __construct() {
        $this->equipamento = new Equipamento();
    }

    public function listarEquipamentos() {
        return $this->equipamento->getAll();
    }

    public function criarEquipamento() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $tipo = $_POST['tipo'];
            $funcao = $_POST['funcao'];

            if (!empty($nome) && !empty($tipo) && !empty($funcao)) {
                if ($this->equipamento->create($nome, $tipo, $funcao)) {
                    header("Location: ../View/pt.php");
                    exit();
                } else {
                    echo "Erro ao criar equipamento!";
                }
            } else {
                echo "Preencha todos os campos!";
            }
        }
    }

    public function editarEquipamento($id) {
        return $this->equipamento->getById($id);
    }

    public function atualizarEquipamento($id) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $tipo = $_POST['tipo'];
            $funcao = $_POST['funcao'];

            if (!empty($nome) && !empty($tipo) && !empty($funcao)) {
                if ($this->equipamento->update($id, $nome, $tipo, $funcao)) {
                    header("Location: ../View/pt.php");
                    exit();
                } else {
                    echo "Erro ao atualizar equipamento!";
                }
            } else {
                echo "Preencha todos os campos!";
            }
        }
    }

    public function deletarEquipamento($id) {
        if ($this->equipamento->delete($id)) {
            header("Location: ../View/pt.php");
            exit();
        } else {
            echo "Erro ao deletar equipamento!";
        }
    }
}
?>
