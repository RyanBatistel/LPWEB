<?php
class Cliente {
    private $id_cliente;
    private $nome_cliente;
    private $data_nascimento;
    private $data_cadastro;
    private $cpf_cnpj;
    private $genero;
    private $id_email;
    private $email_cliente;
    //private $tipo_cliente;
    private $id_endereco;
    private $logradouro;
    private $numero;
    private $cep;
    private $bairro;
    private $cidade;
    private $estado;
    private $tipo;
    private $id_fone;
    private $numero_cliente;
    private $tipo_cliente;
    private $contato_cliente;

    public function __construct(
        $id_cliente, $nome_cliente, $data_nascimento, $data_cadastro, $cpf_cnpj, $genero,
        $id_email, $email_cliente, $tipo_cliente,
        $id_endereco, $logradouro, $numero, $cep, $bairro, $cidade, $estado, $tipo,
        $id_fone, $numero_cliente, /*$tipo_cliente*/ $contato_cliente
    ) {
        $this->id_cliente = $id_cliente;
        $this->nome_cliente = $nome_cliente;
        $this->data_nascimento = $data_nascimento;
        $this->data_cadastro = $data_cadastro;
        $this->cpf_cnpj = $cpf_cnpj;
        $this->genero = $genero;
        $this->id_email = $id_email;
        $this->email_cliente = $email_cliente;
        //$this->tipo_cliente = $tipo_cliente;
        $this->id_endereco = $id_endereco;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->cep = $cep;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->tipo = $tipo;
        $this->id_fone = $id_fone;
        $this->numero_cliente = $numero_cliente;
        $this->tipo_cliente = $tipo_cliente;
        $this->contato_cliente = $contato_cliente;
    }

    // METODOS GETTERS 
    public function getIdCliente() {
        return $this->id_cliente;
    }

    public function getNomeCliente() {
        return $this->nome_cliente;
    }

    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function getDataCadastro() {
        return $this->data_cadastro;
    }

    public function getCpfCnpj() {
        return $this->cpf_cnpj;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getIdEmail() {
        return $this->id_email;
    }

    public function getEmailCliente() {
        return $this->email_cliente;
    }

    public function getTipoCliente() {
        return $this->tipo_cliente;
    }

    public function getIdEndereco() {
        return $this->id_endereco;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getIdFone() {
        return $this->id_fone;
    }

    public function getNumeroCliente() {
        return $this->numero_cliente;
    }

    /*public function getTipoCliente() {
        return $this->tipo_cliente;
    }*/

    public function getContatoCliente() {
        return $this->contato_cliente;
    }

    // METODOS SETTERS ============================================================
    public function setIdCliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    public function setNomeCliente($nome_cliente) {
        $this->nome_cliente = $nome_cliente;
    }

    public function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    public function setDataCadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    public function setCpfCnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setIdEmail($id_email) {
        $this->id_email = $id_email;
    }

    public function setEmailCliente($email_cliente) {
        $this->email_cliente = $email_cliente;
    }

    /*public function setTipoCliente($tipo_cliente) {
        $this->tipo_cliente = $tipo_cliente;
    }*/

    public function setIdEndereco($id_endereco) {
        $this->id_endereco = $id_endereco;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setIdFone($id_fone) {
        $this->id_fone = $id_fone;
    }

    public function setNumeroCliente($numero_cliente) {
        $this->numero_cliente = $numero_cliente;
    }

    public function setTipoCliente($tipo_cliente) {
        $this->tipo_cliente = $tipo_cliente;
    }

    public function setContatoCliente($contato_cliente) {
        $this->contato_cliente = $contato_cliente;
    }
}

?>