<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Educativo</title>
    <!-- Incluindo o Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Incluindo um arquivo CSS personalizado -->
    <link rel="stylesheet" href="styles.css">
    <!-- Estilo CSS para a seção de introdução com a imagem de fundo -->
    <style>
        body {
            background-color: #f8f9fa; /* Adicione um plano de fundo geral mais suave */
        }

        .navbar {
            background-color: #ffffff; /* Barra de navegação em branco */
        }

        .navbar-brand {
            font-weight: bold;
        }

        .intro-section {
            background-image: url('foto.jpg');
            background-size: cover;
            background-position: center;
            color: #ffffff;
            padding: 100px 0;
            text-align: center;
            max-height: 400px; /* Altura máxima da seção de introdução */
            overflow: hidden; /* Oculta qualquer conteúdo que exceda a altura máxima */
        }

        .intro-section h1 {
            font-size: 36px;
            margin-bottom: 20px; /* Adicione espaço inferior para separar o título do texto */
        }

        .intro-section p {
            font-size: 18px;
        }

        /* Estilo para os cards dos quizzes */
        .quiz-card {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Quiz Educativo</a>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <!-- Título e introdução com imagem de fundo -->
        <div class="intro-section">
            <div class="container">
                <h1>Bem-vindo ao Quiz Educativo</h1>
                <p>Explore e aprimore seus conhecimentos em inglês, português e matemática com os quizzes interativos disponíveis nesta plataforma educativa. 
                Nossos quizzes foram projetados para serem divertidos e educacionais, adequados para estudantes de todas as idades.</p>
            </div>
        </div>
        
        <!-- Os 3 elementos de clique -->
        <div class="row">
            <div class="col-md-6">
                <div class="card quiz-card">
                    <div class="card-body">
                        <h5 class="card-title">Quiz de Inglês</h5>
                        <p class="card-text">Aperfeiçoe suas habilidades em inglês testando seus conhecimentos de vocabulário, gramática e compreensão escrita.</p>
                        <a href="quiz.php?materia=ingles" class="btn btn-primary">Iniciar Quiz</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card quiz-card">
                    <div class="card-body">
                        <h5 class="card-title">Quiz de Português</h5>
                        <p class="card-text">Desafie-se com perguntas sobre ortografia, gramática e interpretação de texto em nosso quiz de português.</p>
                        <a href="quiz.php?materia=portugues" class="btn btn-primary">Iniciar Quiz</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card quiz-card">
                    <div class="card-body">
                        <h5 class="card-title">Quiz de Matemática</h5>
                        <p class="card-text">Teste suas habilidades matemáticas com nosso quiz desafiador.</p>
                        <a href="quiz.php?materia=matematica" class="btn btn-primary">Iniciar Quiz</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluindo o Bootstrap JS (opcional, dependendo do seu uso) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
