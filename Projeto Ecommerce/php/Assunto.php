class Assunto {
    private $id_assunto;
    private $desc_assunto;
    private $id_mensagem;
    private $id_email;
    private $id_fone;
    private $nome;
    private $desc_mensagem;

    public function __construct(
        $id_assunto,
        $desc_assunto,
        $id_mensagem,
        $id_email,
        $id_fone,
        $nome,
        $desc_mensagem
    ) {
        $this->id_assunto = $id_assunto;
        $this->desc_assunto = $desc_assunto;
        $this->id_mensagem = $id_mensagem;
        $this->id_email = $id_email;
        $this->id_fone = $id_fone;
        $this->nome = $nome;
        $this->desc_mensagem = $desc_mensagem;
    }

    // Getters
    public function getIdAssunto() {
        return $this->id_assunto;
    }

    public function getDescAssunto() {
        return $this->desc_assunto;
    }

    public function getIdMensagem() {
        return $this->id_mensagem;
    }

    public function getIdEmail() {
        return $this->id_email;
    }

    public function getIdFone() {
        return $this->id_fone;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescMensagem() {
        return $this->desc_mensagem;
    }

    // Setters
    public function setIdAssunto($id_assunto) {
        $this->id_assunto = $id_assunto;
    }

    public function setDescAssunto($desc_assunto) {
        $this->desc_assunto = $desc_assunto;
    }

    public function setIdMensagem($id_mensagem) {
        $this->id_mensagem = $id_mensagem;
    }

    public function setIdEmail($id_email) {
        $this->id_email = $id_email;
    }

    public function setIdFone($id_fone) {
        $this->id_fone = $id_fone;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setDescMensagem($desc_mensagem) {
        $this->desc_mensagem = $desc_mensagem;
    }
}
