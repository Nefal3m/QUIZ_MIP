<?php
$servername = "Localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
// Variáveis de erro e sucesso
$erro = "";
$sucesso = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    // Validação dos campos (adapte conforme necessário)
    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos.";
    } else {
        // Verifica se o email já está em uso (substitua com sua consulta SQL)
        $sql = "SELECT id FROM participantes WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $erro = "Este email já está em uso.";
        } else {
            // Insere o novo participante no banco de dados
     $sql = "INSERT INTO participantes (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
            if ($conn->query($sql) === TRUE) {
                $sucesso = "Registro concluído com sucesso.";
            } else {
                $erro = "Erro ao registrar: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Link para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Inclua seu link para CSS aqui -->
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Registro</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                // Exibe mensagens de erro ou sucesso
                if (!empty($erro)) {
                    echo '<div class="alert alert-danger" role="alert">' . $erro . '</div>';
                }
                if (!empty($sucesso)) {
                    echo '<div class="alert alert-success" role="alert">' . $sucesso . '</div>';
                }
                ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
                <p class="mt-3">Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>
