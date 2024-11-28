<?php 
include 'header.php';

// Inclusão dos arquivos de conexão e de usuário
require_once '../../db/Database.php';
require_once '../models/Usuario.php';

// Conexão com o banco de dados
$database = new Database();  // Conecta ao banco de dados
$conn = $database->getConnection(); // Recupera a conexão

// Variáveis padrão para usuário não logado
$nome_usuario = 'Visitante';
$foto_perfil = '../img/projetos/fotoperfil.png'; // Foto de perfil padrão

// Verifica se o usuário está logado
if (isset($_SESSION['usuario_email'])) {
    $email_usuario = $_SESSION['usuario_email'];  // Recupera o e-mail do usuário logado
    $usuario = new Usuario($conn);  // Cria um objeto da classe Usuario
    
    // Chama o método buscarUsuarioPorEmail para buscar os dados do usuário
    $usuario_data = $usuario->buscarUsuarioPorEmail($email_usuario);

    // Verifica se os dados do usuário foram encontrados
    if ($usuario_data) {
        // Verifica se o usuário tem foto de perfil, senão usa a foto padrão
        $foto_perfil = !empty($usuario_data['foto_perfil']) ? $usuario_data['foto_perfil'] : $foto_perfil;

        // Verifica se o nome do usuário foi encontrado
        $nome_usuario = !empty($usuario_data['nome']) ? $usuario_data['nome'] : $nome_usuario;
    } else {
        // Caso o usuário não seja encontrado
        $foto_perfil = '../img/projetos/fotoperfil.png';  // Foto padrão
        $nome_usuario = 'Visitante';  // Nome padrão
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - CemFreelas</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
<main class="main-content">
    <div class="container">
        <!-- Seção de boas-vindas -->
        <section class="welcome-section">
            <div class="user-info">
                <img src="../../img/projetos/fotoperfil.png" alt="Foto de Perfil" class="profile-pic">

                <div>
                    <h2>Seja bem-vindo, Visitante!</h2>
                    <p>Estamos muito felizes em te ter por aqui. Vamos ajudar você a encontrar as melhores oportunidades ou freelancers para o seu projeto.</p>
                </div>
            </div>
        </section>

        <!-- Container de boas-vindas adicional -->
        <div class="extra-container">
            <p>Bem-vindo ao CemFreelas, a plataforma que conecta freelancers talentosos e clientes em busca de soluções criativas. Encontre o profissional ideal para seu projeto ou publique suas oportunidades para conquistar novos desafios. Cadastre-se agora e comece a explorar as melhores opções para seu trabalho ou projeto!</p>
        </div>

        <!-- Como funciona - Cartões informativos -->
        <section class="how-it-work-cards">
            <div class="how-it-work-card">
                <img src="../../img/projetos/publiquepj.jpg" alt="Login" class="card-image">
                <p class="card-description">Acesse sua conta ou cadastre-se para começar a explorar.</p>
            </div>
            <div class="how-it-work-card">
                <img src="../../img/projetos/selecione.avif" alt="Freelancer" class="card-image">
                <p class="card-description">Encontre freelancers talentosos prontos para trabalhar no seu projeto.</p>
            </div>
            <div class="how-it-work-card">
                <img src="../../img/projetos/obtenha.webp" alt="Contrate" class="card-image">
                <p class="card-description">Contrate o freelancer ideal e comece a trabalhar no seu projeto.</p>
            </div>
            <div class="how-it-work-card">
                <img src="../../img/projetos/pagando.avif" alt="Pagamento" class="card-image">
                <p class="card-description">Nós garantimos que o pagamento seja seguro e que ambas as partes fiquem satisfeitas.</p>
            </div>
        </section>
    </div>

    <!-- Rodapé -->
    <?php include 'footer.php'; ?>
</main>

<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }
</script>

</body>
</html>

<style>
    /* Resetando estilos */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Corpo da Página */
    body {
        font-family: 'Arial', sans-serif;
        background: linear-gradient(135deg, #4A76A8, #6A4C9C, #D8A6D1); /* Gradiente azul, roxo e rosa */
        color: #333;
        min-height: 100vh;
        line-height: 1,5;
    }

    /* Layout principal */
    .main-content {
        padding: 40px 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Seção de boas-vindas */
    .welcome-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 40px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .profile-pic {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin-right: 20px;
        border: 4px solid #D8A6D1;
        object-fit: cover;
    }

    h2 {
        font-size: 26px;
        color: black;
        
    }

    p {
        font-size: 18px;
        color: black ;
    }
    /* Foto de perfil */
.profile-pic {
    border-radius: 50%;
    width: 80px;  /* Ajuste o tamanho conforme necessário */
    height: 80px; /* Ajuste o tamanho conforme necessário */
    object-fit: cover;
    border: 4px solid #D8A6D1;  /* Border para destacar a imagem */
    margin-right: 20px;
}


    /* Cartões informativos */
    .how-it-work-cards {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 30px;
        margin-top: 40px;
    }

    .how-it-work-card {
        background-color: #ffffff;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        width: 22%;
        padding: 20px;
        border-radius: 8px;
        transition: transform 0.3s ease;
        text-align: center;
        overflow: hidden;
    }

    .how-it-work-card:hover {
        transform: translateY(-10px);
    }

    .card-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 20px;
        color: black;
        margin-bottom: 10px;
    }

    .card-description {
        font-size: 16px;
        color: #666;
    }

    /* Container adicional de boas-vindas */
    .extra-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
        color: black ;
    }

    .extra-container p {
        font-size: 16px;
        color: #555;
    }

    /* Responsividade */
    @media (max-width: 768px) {
        .how-it-work-cards {
            flex-direction: column;
            align-items: center;
        }

        .how-it-work-card {
            width: 80%;
            margin: 10px 0;
        }

        .hamburger-menu {
            display: block;
        }

        .nav-links {
            display: none;
            width: 100%;
            background-color: #D8A6D1;
            padding: 10px 0;
            position: absolute;
            top: 60px;
            left: 0;
        }

        .nav-links.active {
            display: block;
        }

        .hamburger-menu div {
            width: 30px;
            height: 4px;
            background-color: white;
            margin: 5px 0;
        }

        .hamburger-menu {
            cursor: pointer;
            display: none;
        }
    }
    
</style>