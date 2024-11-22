<?php
include 'usuarios_controller.php';

 include 'header.php';

session_start();

// Verifica se o usuário está registrado na sessão (logado)
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

//Pega todos os usuários para preencher os dados da tabela
$users = getUsers();

//Variável que guarda o ID do usuário que será editado
$userToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
// e sé há um ID para edição de usuário
if (isset($_GET['edit'])) {
    $userToEdit = getUser($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function clearForm() {
            document.getElementById('nome').value = '';
            document.getElementById('telefone').value = '';
            document.getElementById('email').value = '';
            document.getElementById('senha').value = '';
            document.getElementById('id').value = '';
        }
    </script>
    <style>
        /* Customizações extras */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin-top: 50px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2rem;
        }

        .btn-custom {
            border-radius: 50px;
            padding: 10px 25px;
            font-size: 1rem;
        }

        .form-control {
            border-radius: 10px;
            box-shadow: none;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .actions a {
            margin: 0 5px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Título do Formulário -->
        <h2>Cadastro de Usuários</h2>

        <!-- Formulário de cadastro -->
        <form method="POST" action="" class="row g-3">
            <input type="hidden" id="id" name="id" value="<?php echo $userToEdit['id'] ?? ''; ?>">

            <div class="col-md-6">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $userToEdit['nome'] ?? ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo $userToEdit['telefone'] ?? ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $userToEdit['email'] ?? ''; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>

            <div class="col-12 text-center">
                <button type="submit" name="save" class="btn btn-primary btn-custom">Salvar</button>
                <button type="submit" name="update" class="btn btn-success btn-custom">Atualizar</button>
                <button type="button" onclick="clearForm()" class="btn btn-secondary btn-custom">Novo</button>
            </div>
        </form>

        <!-- Tabela de Usuários -->
        <h2 class="mt-5">Usuários Cadastrados</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mt-3">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Faz um loop FOR no resultset de usuários e preenche a tabela -->
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['nome']; ?></td>
                            <td><?php echo $user['telefone']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td class="actions">
                                <div class="btn-group">
                                    <a href="?edit=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="?delete=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');" class="btn btn-danger btn-sm">Excluir</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rodapé -->
    <div class="footer">
        <p>&copy; 2024 CRUD de Usuários. Todos os direitos reservados.</p>
    </div>

    <!-- Link do Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>