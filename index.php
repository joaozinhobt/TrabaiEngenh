<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema e-Commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #007bff, #6c757d);
            color: #fff;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            color: #212529;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            animation: slideIn 0.7s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 25px;
            height: 45px;
        }

        .btn-primary {
            border-radius: 25px;
            height: 45px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .extra-options {
            margin-top: 15px;
            text-align: center;
        }

        .extra-options a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .extra-options a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Bem-vindo</h2>
            <p>Faça login para continuar</p>
        </div>
        <form action="login.php" method="POST">
            <!-- Campo Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Digite seu email" required>
            </div>

            <!-- Campo Senha -->
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
            </div>

            <!-- Botão Entrar -->
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>

        <div class="extra-options">
            <p><a href="#">Esqueceu sua senha?</a></p>
            <p><a href="registro.php">Criar nova conta</a></p>
        </div>

        <div class="footer">
            <small>© 2024 Sistema e-Commerce. Todos os direitos reservados.</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
