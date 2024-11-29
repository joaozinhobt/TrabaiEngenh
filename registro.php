<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nova Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #007bff; /* Fundo azul */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .register-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #007bff;
            text-align: center;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-primary {
            border-radius: 20px;
            width: 100%;
        }

        .alert {
            border-radius: 20px;
        }

        .extra-options {
            text-align: center;
            margin-top: 20px;
        }

        .extra-options a {
            text-decoration: none;
            color: #007bff;
        }

        .extra-options a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Criar Nova Conta</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="processa_registro.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome Completo:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
            </div>
            <div class="mb-3">
                <label for="confirma_senha" class="form-label">Confirmar Senha:</label>
                <input type="password" id="confirma_senha" name="confirma_senha" class="form-control" placeholder="Confirme sua senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar Conta</button>
        </form>

        <div class="extra-options mt-3">
            <p>Já possui uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
