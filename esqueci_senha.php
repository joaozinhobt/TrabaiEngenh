<?php
// Inclui a conexão com o banco
include 'db.php';

$error = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verifica se o email está cadastrado
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Simula o envio do link de recuperação
        $successMessage = "Um link para redefinir sua senha foi enviado para: " . htmlspecialchars($email);
    } else {
        $error = "Email não encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a Senha</title>
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

        .card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .card h3 {
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
    </style>
</head>
<body>
    <div class="card shadow">
        <h3 class="text-center">Recuperar Senha</h3>

        <!-- Exibe a mensagem de erro ou sucesso -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?php echo $error; ?>
            </div>
        <?php elseif (!empty($successMessage)): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo $successMessage; ?>
            </div>
        <?php endif; ?>

        <!-- Formulário de recuperação de senha -->
        <form action="esqueci_senha.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Digite seu email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
