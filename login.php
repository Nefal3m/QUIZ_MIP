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
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação dos campos (adapte conforme necessário)
    if (empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos.";
    } else {
        // Consulta o banco de dados para verificar o usuário pelo email
        $sql = "SELECT id, nome, senha FROM participantes WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $nome = $row['nome'];
            $senha_hash = $row['senha'];

            // Verifica se a senha corresponde à senha criptografada no banco de dados
            if (password_verify($senha, $senha_hash)) {
                // A senha está correta, o usuário está autenticado com sucesso
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['nome'] = $nome;
                header("Location: dashboard.php"); // Redireciona para o painel
                exit();
            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "Email não encontrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Login</h1>
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
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
                <p class="mt-3">Não tem uma conta? <a href="register.php">Registre-se aqui</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>
