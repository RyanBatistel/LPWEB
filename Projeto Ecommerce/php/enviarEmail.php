<?php
$nome = addslashes($_POST['nome']);
$email = addslashes($_POST['email']);
$telefone = addslashes($_POST['telefone']);
$msg_mensagem = addslashes($_POST['mensagem']);


if(isset($nome) && isset($_email) && isset($_msg_mensagem) && 
!empty($nome) && !empty($_email) && !empty($_telefone) && !empty($_msg_mensagem) )
{
    $para = 'admin@email.com.br';
    $assunto = 'Nova mensagem de contato ('.$nome.')';
    $corpo = "Nome:".$nome."\r\n".
             "Email:" .$email."\r\n".
             "telefone:".$telefone."\r\n".
             "Mensagem:".$msg_mensagem."\r\n";

    $cabecalho = "From:contato@magicShop.com.br"."\r\n".
                 "Reply-To:".$email."\r\n".
                 "X=Mailer:PHP/".phpversion();

    if(mail($para, $assunto, $msg_mensagem, $cabecalho)){
        echo 'email enviado';
    }else{
        echo 'o email nao pode ser enviado';
    }
}      
else {
    echo 'todos os campos precisam ser preenchidos antes de enviar';
}