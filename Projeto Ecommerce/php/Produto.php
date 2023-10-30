class Produto {
    private $id_produto;
    private $id_modelo;
    private $id_cor;
    private $desc_produto;
    private $capacidade_modelo;
    private $vlr_sugerido;
    private $vlr_custo;
    private $voltagem;
    private $id_linha;
    private $desc_linha;
    private $id_marca;
    private $desc_modelo;
    private $desc_marca;
    private $desc_cor;

    public function __construct(
        $id_produto,
        $id_modelo,
        $id_cor,
        $desc_produto,
        $capacidade_modelo,
        $vlr_sugerido,
        $vlr_custo,
        $voltagem,
        $id_linha,
        $desc_linha,
        $id_marca,
        $desc_modelo,
        $desc_marca,
        $desc_cor
    ) {
        $this->id_produto = $id_produto;
        $this->id_modelo = $id_modelo;
        $this->id_cor = $id_cor;
        $this->desc_produto = $desc_produto;
        $this->capacidade_modelo = $capacidade_modelo;
        $this->vlr_sugerido = $vlr_sugerido;
        $this->vlr_custo = $vlr_custo;
        $this->voltagem = $voltagem;
        $this->id_linha = $id_linha;
        $this->desc_linha = $desc_linha;
        $this->id_marca = $id_marca;
        $this->desc_modelo = $desc_modelo;
        $this->desc_marca = $desc_marca;
        $this->desc_cor = $desc_cor;
    }

    // Getters
    public function getIdProduto() {
        return $this->id_produto;
    }

    public function getIdModelo() {
        return $this->id_modelo;
    }

    public function getIdCor() {
        return $this->id_cor;
    }

    public function getDescProduto() {
        return $this->desc_produto;
    }

    public function getCapacidadeModelo() {
        return $this->capacidade_modelo;
    }

    public function getVlrSugerido() {
        return $this->vlr_sugerido;
    }

    public function getVlrCusto() {
        return $this->vlr_custo;
    }

    public function getVoltagem() {
        return $this->voltagem;
    }

    public function getIdLinha() {
        return $this->id_linha;
    }

    public function getDescLinha() {
        return $this->desc_linha;
    }

    public function getIdMarca() {
        return $this->id_marca;
    }

    public function getDescModelo() {
        return $this->desc_modelo;
    }

    public function getDescMarca() {
        return $this->desc_marca;
    }

    public function getDescCor() {
        return $this->desc_cor;
    }

    // Setters
    public function setIdProduto($id_produto) {
        $this->id_produto = $id_produto;
    }

    public function setIdModelo($id_modelo) {
        $this->id_modelo = $id_modelo;
    }

    public function setIdCor($id_cor) {
        $this->id_cor = $id_cor;
    }

    public function setDescProduto($desc_produto) {
        $this->desc_produto = $desc_produto;
    }

    public function setCapacidadeModelo($capacidade_modelo) {
        $this->capacidade_modelo = $capacidade_modelo;
    }

    public function setVlrSugerido($vlr_sugerido) {
        $this->vlr_sugerido = $vlr_sugerido;
    }

    public function setVlrCusto($vlr_custo) {
        $this->vlr_custo = $vlr_custo;
    }

    public function setVoltagem($voltagem) {
        $this->voltagem = $voltagem;
    }

    public function setIdLinha($id_linha) {
        $this->id_linha = $id_linha;
    }

    public function setDescLinha($desc_linha) {
        $this->desc_linha = $desc_linha;
    }

    public function setIdMarca($id_marca) {
        $this->id_marca = $id_marca;
    }

    public function setDescModelo($desc_modelo) {
        $this->desc_modelo = $desc_modelo;
    }

    public function setDescMarca($desc_marca) {
        $this->desc_marca = $desc_marca;
    }

    public function setDescCor($desc_cor) {
        $this->desc_cor = $desc_cor;
    }
}
