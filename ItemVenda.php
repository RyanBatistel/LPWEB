class ItemVenda {
    private $id_item;
    private $id_venda;
    private $vlr_venda;
    private $qtd_venda;
    private $status_venda;
    private $id_cliente;
    private $data_venda;
    private $nr_documento_venda;
    private $prc_desconto_venda;

    public function __construct($id_item, $id_venda, $vlr_venda, $qtd_venda, $status_venda, $id_cliente, $data_venda, $nr_documento_venda, $prc_desconto_venda) {
        $this->id_item = $id_item;
        $this->id_venda = $id_venda;
        $this->vlr_venda = $vlr_venda;
        $this->qtd_venda = $qtd_venda;
        $this->status_venda = $status_venda;
        $this->id_cliente = $id_cliente;
        $this->data_venda = $data_venda;
        $this->nr_documento_venda = $nr_documento_venda;
        $this->prc_desconto_venda = $prc_desconto_venda;
    }

    // Métodos getter para acessar os atributos
    public function getIdItem() {
        return $this->id_item;
    }

    public function getIdVenda() {
        return $this->id_venda;
    }

    public function getVlrVenda() {
        return $this->vlr_venda;
    }

    public function getQtdVenda() {
        return $this->qtd_venda;
    }

    public function getStatusVenda() {
        return $this->status_venda;
    }

    public function getIdCliente() {
        return $this->id_cliente;
    }

    public function getDataVenda() {
        return $this->data_venda;
    }

    public function getNrDocumentoVenda() {
        return $this->nr_documento_venda;
    }

    public function getPrcDescontoVenda() {
        return $this->prc_desconto_venda;
    }
}
