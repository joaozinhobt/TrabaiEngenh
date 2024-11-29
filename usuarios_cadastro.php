<?php
include 'usuarios_controller.php';
include 'header.php';

session_start();
// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

// Pega todos os usuários
$users = getUsers();
$userToEdit = null;

// Verifica se existe o parâmetro edit
if (isset($_GET['edit'])) {
    $userToEdit = getUser($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 20px;
            max-width: 1000px;
        }

        .form-cadastro {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-cadastro .btn {
            border-radius: 20px;
        }

        .user-card {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-card h5 {
            margin: 0;
        }

        .user-card .user-actions a {
            margin: 0 5px;
        }

        .table th, .table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center text-primary">Gerenciamento de Usuários</h2>

        <!-- Formulário de Cadastro -->
        <div class="form-cadastro my-4">
            <form method="POST" action="">
                <input type="hidden" id="id" name="id" value="<?php echo $userToEdit['id'] ?? ''; ?>">

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" 
                        value="<?php echo $userToEdit['nome'] ?? ''; ?>" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" class="form-control" 
                            value="<?php echo $userToEdit['telefone'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" 
                            value="<?php echo $userToEdit['email'] ?? ''; ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" id="senha" name="senha" class="form-control" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" name="save" class="btn btn-success me-2">Salvar</button>
                    <button type="submit" name="update" class="btn btn-secondary me-2">Atualizar</button>
                    <button type="button" onclick="clearForm()" class="btn btn-danger">Limpar</button>
                </div>
            </form>
        </div>

        <!-- Lista de Usuários -->
        <h3 class="text-center mt-5">Usuários Cadastrados</h3>
        <div class="row mt-4">
            <?php foreach ($users as $user): ?>
                <div class="col-md-6 mb-4">
                    <div class="user-card">
                        <div>
                            <h5><?php echo $user['nome']; ?></h5>
                            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                            <p><strong>Telefone:</strong> <?php echo $user['telefone']; ?></p>
                        </div>
                        <div class="user-actions">
                            <a href="?edit=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="?delete=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir?');">
                                <i class="fas fa-trash"></i> Excluir
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function clearForm() {
            document.getElementById('nome').value = '';
            document.getElementById('telefone').value = '';
            document.getElementById('email').value = '';
            document.getElementById('senha').value = '';
            document.getElementById('id').value = '';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
