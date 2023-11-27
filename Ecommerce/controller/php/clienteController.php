<?php
require_once("../model/php/classeCliente.php");
require_once("../model/php/updateCliente.php");

class ClienteController {
    public function listarClientes() {
        // Aqui você pode criar uma instância da classe Cliente e obter a lista de clientes
        $clientes = new Cliente();
        $listaClientes = $clientes->obterListaClientes();

        // Agora, você pode passar $listaClientes para a visão adequada
        include("../view/php/readCliente.php");
    }

    public function excluirCliente($id) {
        // Aqui você pode criar uma instância da classe Cliente e chamar o método de exclusão
        $cliente = new Cliente();
        $cliente->excluirCliente($id);

        // Redirecionar para a lista de clientes após a exclusão
        $this->listarClientes();
    }
}

// Instanciar o controlador para uso em outros arquivos
$clienteController = new ClienteController();
?>