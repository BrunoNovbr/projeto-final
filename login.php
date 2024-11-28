<?php include 'header.php'?><?php
// login.php - Formulário de login e processamento
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lógica de validação de login aqui
    require_once '../../db/Database.php';  // Conexão com o banco de dados
    require_once '../../app/controllers/UsuarioController.php';

    $usuarioController = new UsuarioController();
    
    // Valida o login e obtém os dados do usuário
    $usuario = $usuarioController->validarLogin($_POST['email'], $_POST['senha']);
    
    if ($usuario) {
        // Se o login for válido, verifica o tipo de usuário e redireciona
        session_start(); // Inicia a sessão
        $_SESSION['user_id'] = $usuario['id']; // Salva o id do usuário na sessão
        $_SESSION['user_tipo'] = $usuario['tipo']; // Salva o tipo de usuário (cliente ou freelancer)

        // Redireciona para o painel correto
        if ($usuario['tipo'] == 'freelancer') {
            header('Location: painel_freelancer.php');
        } else if ($usuario['tipo'] == 'cliente') {
            header('Location: painel_cliente.php');
        } else {
            // Se o tipo de usuário for inválido, redireciona para a página inicial ou erro
            header('Location: index.php');
        }
        exit(); // Finaliza o script após o redirecionamento
    } else {
        // Se a validação falhar
        $erro = 'Email ou senha incorretos!';
    }
}
?>


<?php if (isset($erro)): ?>
    <p style="color: red;"><?php echo $erro; ?></p>
<?php endif; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CemFreelas</title>
    <style>
        /* Resetando estilos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #4A76A8, #D8A6D1); /* Gradiente roxo e rosa */
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Container principal */
        .container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin: 50px 50px 50px 450px  ;
            text-align: center;
            align-items: center;
            justify-content: center; /* Centraliza verticalmente */
        }

        h1 {
            font-size: 32px;
            color: #3b3f47;
            margin-bottom: 30px;
        }

        /* Estilos para o formulário */
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="email"], input[type="password"] {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #D8A6D1; /* Rosa claro */
            background-color: #ffffff;
        }

        button {
            padding: 12px 20px;
            background-color: #6A4C9C; /* Roxo */
            width: 50%;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4A76A8; /* Roxo mais claro */
        }

        /* Estilos para links */
        a {
            color: #D8A6D1; /* Rosa claro */
            text-decoration: none;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<!-- Conteúdo principal -->
<div class="container">
    <h1>Login</h1>

    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>

        <button type="submit">Login</button>
    </form>

    <a href="cadastro.php">Ainda não tem uma conta? Registre-se</a>
</div>

</body>
</html>