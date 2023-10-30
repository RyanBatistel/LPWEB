class Estoque {
    private $id_estoque;
    private $id_produto;
    private $qtd_estoque;
    private $id_filial;

    public function __construct($id_estoque, $id_produto, $qtd_estoque, $id_filial) {
        $this->id_estoque = $id_estoque;
        $this->id_produto = $id_produto;
        $this->qtd_estoque = $qtd_estoque;
        $this->id_filial = $id_filial;
    }

    // Getters e Setters
    public function getIdEstoque() {
        return $this->id_estoque;
    }

    public function setIdEstoque($id_estoque) {
        $this->id_estoque = $id_estoque;
    }

    public function getIdProduto() {
        return $this->id_produto;
    }

    public function setIdProduto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function getQtdEstoque() {
        return $this->qtd_estoque;
    }

    public function setQtdEstoque($qtd_estoque) {
        $this->qtd_estoque = $qtd_estoque;
    }

    public function getIdFilial() {
        return $this->id_filial;
    }

    public function setIdFilial($id_filial) {
        $this->id_filial = $id_filial;
    }
}

// Exemplo de uso da classe
$estoque = new Estoque(1, 1001, 50, 2);

// Acessando os atributos
echo "ID Estoque: " . $estoque->getIdEstoque() . "\n";
echo "ID Produto: " . $estoque->getIdProduto() . "\n";
echo "Quantidade em Estoque: " . $estoque->getQtdEstoque() . "\n";
echo "ID da Filial: " . $estoque->getIdFilial() . "\n";
