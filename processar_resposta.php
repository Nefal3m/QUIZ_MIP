<?php
// Conexão com o banco de dados (substitua pelas suas configurações)
$servername = "Localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Dados da resposta enviada pelo formulário
$id_pergunta = $_POST['id_pergunta'];
$resposta_selecionada = $_POST['resposta'];

// Consulta SQL para obter a resposta correta da pergunta
$sql = "SELECT resposta_correta FROM perguntas WHERE id = '$id_pergunta'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $resposta_correta = $row['resposta_correta'];

    // Verifica se a resposta selecionada pelo usuário está correta
    if ($resposta_selecionada == $resposta_correta) {
        echo "Resposta correta!";
    } else {
        echo "Resposta incorreta. A resposta correta era: $resposta_correta";
    }
} else {
    echo "Pergunta não encontrada.";
}

$conn->close();
?>
