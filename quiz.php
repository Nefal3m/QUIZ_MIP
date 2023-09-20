<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['materia'])) {
    $materia_escolhida = $_GET['materia'];

    // Consulta o banco de dados para obter uma pergunta da matéria escolhida
    $sql = "SELECT * FROM perguntas WHERE materia = '$materia_escolhida' ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $pergunta = $result->fetch_assoc();
        $id_pergunta = $pergunta['id'];
        $texto_pergunta = $pergunta['pergunta'];
        $opcao1 = $pergunta['opcao1'];
        $opcao2 = $pergunta['opcao2'];
        $opcao3 = $pergunta['opcao3'];
        $opcao4 = $pergunta['opcao4'];
        $resposta_correta = $pergunta['resposta_correta'];
    } else {
        $erro = "Não há perguntas disponíveis para a matéria selecionada.";
    }
} else {
    $erro = "A matéria não foi especificada.";
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resposta_usuario = $_POST['resposta'];

    // Verifica se a resposta do usuário está correta
    if ($resposta_usuario == $resposta_correta) {
        $feedback = "Resposta correta!";
        
        // Incrementa a quantidade de perguntas respondidas corretamente no cookie
        if (isset($_COOKIE['acertos'])) {
            $acertos = $_COOKIE['acertos'] + 1;
        } else {
            $acertos = 1;
        }
        setcookie('acertos', $acertos, time() + 3600, '/'); // Armazena o número de acertos em um cookie por 1 hora
    } else {
        $feedback = "Resposta incorreta. A resposta correta é: " . $resposta_correta;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?php echo $materia_escolhida; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Quiz - <?php echo $materia_escolhida; ?></h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (!empty($erro)) {
                    echo '<div class="alert alert-danger" role="alert">' . $erro . '</div>';
                }
                ?>

                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($feedback)) {
                            echo '<div class="alert alert-info">' . $feedback . '</div>';
                        }
                        ?>

                        <h5 class="card-title">Pergunta:</h5>
                        <p class="card-text"><?php echo $texto_pergunta; ?></p>
                        <form id="quiz-form">
                            <input type="hidden" name="id_pergunta" value="<?php echo $id_pergunta; ?>">
                            <input type="hidden" name="materia" value="<?php echo $materia_escolhida; ?>">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="opcao1" name="resposta" value="1">
                                <label class="form-check-label" for="opcao1"><?php echo $opcao1; ?></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="opcao2" name="resposta" value="2">
                                <label class="form-check-label" for="opcao2"><?php echo $opcao2; ?></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="opcao3" name="resposta" value="3">
                                <label class="form-check-label" for="opcao3"><?php echo $opcao3; ?></label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="opcao4" name="resposta" value="4">
                                <label class="form-check-label" for="opcao4"><?php echo $opcao4; ?></label>
                            </div>
                            <button type="button" id="submit-button" class="btn btn-primary mt-3">Enviar Resposta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Manipula o envio do formulário sem recarregar a página
            $("#submit-button").click(function () {
                $.post("processar_resposta.php", $("#quiz-form").serialize(), function (data) {
                    // Redireciona para a próxima pergunta
                    window.location.href = "quiz.php?materia=" + data.materia;
                }, "json");
            });
        });
    </script>
</body>
</html>
