<?php
session_start();
include 'db.php';

$error = "";
$success = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verifica se o token existe no banco
    $stmt = $conn->prepare("SELECT email FROM reset_senha WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $senha = trim($_POST['senha']);
            
            if (empty($senha)) {
                $error = "Por favor, informe uma nova senha.";
            } else {
                // Recupera o email do token
                $stmt->bind_result($email);
                $stmt->fetch();
                
                // Atualiza a senha do usuário
                $stmt = $conn->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
                $stmt->bind_param("ss", $senha, $email);
                if ($stmt->execute()) {
                    // Exclui o token após a utilização
                    $stmt = $conn->prepare("DELETE FROM reset_senha WHERE token = ?");
                    $stmt->bind_param("s", $token);
                    $stmt->execute();

                    $success = "Senha alterada com sucesso! Você pode fazer login agora.";
                } else {
                    $error = "Erro ao alterar a senha. Tente novamente.";
                }
            }
        }
    } else {
        $error = "Token inválido ou expirado.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Redefinir Senha</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="senha" class="form-label">Nova Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Alterar Senha</button>
        </form>
    </div>
</body>
</html>
