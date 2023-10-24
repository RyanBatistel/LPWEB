<?php
class Contato {
    // Atributos da classe
    private $assunto;
    private $nome;
    private $email;
    private $telefone;
    private $mensagem;

    // Construtor da classe
    public function __construct($assunto, $nome, $email, $telefone, $mensagem) {
        $this->assunto = $assunto;
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->mensagem = $mensagem;
    }

    // Métodos para acessar os atributos (getters)
    public function getAssunto() {
        return $this->assunto;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    // Métodos para modificar os atributos (setters)
    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }
}

// Exemplo de uso da classe
$contato = new Contato("Dúvida", "João", "joao@example.com", "123-456-7890", "Olá, tenho uma pergunta.");
echo "Assunto: " . $contato->getAssunto() . "<br>";
echo "Nome: " . $contato->getNome() . "<br>";
echo "E-mail: " . $contato->getEmail() . "<br>";
echo "Telefone: " . $contato->getTelefone() . "<br>";
echo "Mensagem: " . $contato->getMensagem() . "<br>";
