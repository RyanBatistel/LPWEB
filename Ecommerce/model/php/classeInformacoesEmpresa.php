<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("mysqliConexao.php");

class InformacoesEmpresa {
    private $id;
    private $sobre;
    private $missao;
    private $visao;
    private $valores;

    public function __construct($id, $sobre, $missao, $visao, $valores) {
        $this->id = $id;
        $this->sobre = $sobre;
        $this->missao = $missao;
        $this->visao = $visao;
        $this->valores = $valores;
    }

    // Métodos getters

    public function getId() {
        return $this->id;
    }

    public function getSobre() {
        return $this->sobre;
    }

    public function getMissao() {
        return $this->missao;
    }

    public function getVisao() {
        return $this->visao;
    }

    public function getValores() {
        return $this->valores;
    }

    // Métodos setters

    public function setId($id) {
        $this->id = $id;
    }

    public function setSobre($sobre) {
        $this->sobre = $sobre;
    }

    public function setMissao($missao) {
        $this->missao = $missao;
    }

    public function setVisao($visao) {
        $this->visao = $visao;
    }

    public function setValores($valores) {
        $this->valores = $valores;
    }

    // Método para atualizar informações no banco de dados
    public function atualizarInformacoesNoBanco() {
        global $conn;
    
        $sql = "UPDATE informacoes_empresa SET sobre = '$this->sobre', missao = '$this->missao', visao = '$this->visao', valores = '$this->valores' WHERE id = $this->id";
    
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $response = array('success' => true, 'message' => 'Dados atualizados com sucesso.');
        } else {
            $response = array('success' => false, 'message' => 'Falha ao editar os dados.');
        }
    
        // Retorna a resposta como JSON com Content-Type apropriado
        header('Content-Type: application/json');
        echo json_encode($response);
        exit; // Certifique-se de encerrar a execução do script após enviar a resposta JSON
    }

     // Método para buscar informações do banco de dados
     public static function buscarInformacoesNoBanco() {
        global $conn;
    
        $sql = "SELECT * FROM informacoes_empresa WHERE id = 1";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
    
            // Retorna os dados como JSON
            echo json_encode($row);
        } else {
            // Retorna um JSON indicando falha
            echo json_encode(null);
        }
    }
}

// Verificar se há uma solicitação GET para buscar informações
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    InformacoesEmpresa::buscarInformacoesNoBanco();
}
?>
