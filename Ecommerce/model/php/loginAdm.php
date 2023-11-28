<?php
// Inclua o arquivo de conexão ao banco de dados
require_once("mysqliConexao.php");

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores do formulário
    $email = $_POST["email"];
    $senha = $_POST["password"];

    // Verifica se o email e a senha estão no formato correto
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, insira um email válido.";
        exit;
    }

    // Proteção contra SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $senha = mysqli_real_escape_string($conn, $senha);

    // Consulta SQL para verificar se as credenciais são válidas
    $query = "SELECT * FROM administradores WHERE email = '$email' AND senha = '$senha'";
    $result = mysqli_query($conn, $query);

    // Verifica se a consulta retornou algum resultado
    if ($result) {
        // Verifica se há exatamente um administrador com essas credenciais
        if (mysqli_num_rows($result) == 1) {
            // Login bem-sucedido
            // Redireciona para a página de administrador
            header("Location: ../../view/html/admin.html");
            exit;
        } else {
            echo "Credenciais inválidas. Tente novamente.";
        }
    } else {
        echo "Erro na consulta: " . mysqli_error($conn);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conn);
} else {
    // Se o formulário não foi submetido, redirecione para a página de login
    header("Location: ../../view/html/loginAdministrador.html");
    exit;
}
?>
