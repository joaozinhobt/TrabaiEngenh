<?php
include 'produtos_controller.php';
include 'header.php';

// Pega todos os produtos para preencher os dados
$products = getProducts();
$productToEdit = null;

// Verifica se existe o parâmetro edit pelo método GET
if (isset($_GET['edit'])) {
    $productToEdit = getProduct($_GET['edit']);
}

session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 20px;
            max-width: 1200px;
        }

        .form-cadastro {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-cadastro .btn {
            border-radius: 20px;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            max-width: 100%;
            border-radius: 8px;
        }

        .product-card .product-status {
            font-size: 14px;
            font-weight: bold;
        }

        .product-status.active {
            color: green;
        }

        .product-status.inactive {
            color: red;
        }

        .product-actions a {
            margin: 0 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center text-primary">Gerenciamento de Produtos</h2>

        <!-- Formulário de Cadastro -->
        <div class="form-cadastro my-4">
            <form method="POST" action="">
                <input type="hidden" id="id" name="id" value="<?php echo $productToEdit['id'] ?? ''; ?>">

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Produto:</label>
                    <input type="text" id="nome" name="nome" class="form-control"
                        value="<?php echo $productToEdit['nome'] ?? ''; ?>" required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="marca" class="form-label">Marca:</label>
                        <input type="text" id="marca" name="marca" class="form-control"
                            value="<?php echo $productToEdit['marca'] ?? ''; ?>" required>
                    </div>
                    <div class="col">
                        <label for="modelo" class="form-label">Modelo:</label>
                        <input type="text" id="modelo" name="modelo" class="form-control"
                            value="<?php echo $productToEdit['modelo'] ?? ''; ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea id="descricao" name="descricao" class="form-control" rows="3"
                        required><?php echo $productToEdit['descricao'] ?? ''; ?></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="valor-unitario" class="form-label">Valor Unitário (R$):</label>
                        <input type="text" id="valor-unitario" name="valorunitario" class="form-control"
                            value="<?php echo $productToEdit['valorunitario'] ?? ''; ?>" required>
                    </div>
                    <div class="col">
                        <label for="categoria" class="form-label">Categoria:</label>
                        <input type="text" id="categoria" name="categoria" class="form-control"
                            value="<?php echo $productToEdit['categoria'] ?? ''; ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="url-imagem" class="form-label">URL da Imagem:</label>
                    <input type="text" id="url-imagem" name="url_img" class="form-control"
                        value="<?php echo $productToEdit['url_img'] ?? ''; ?>" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="ativo" name="ativo" value="1"
                        <?php echo isset($productToEdit) && $productToEdit['ativo'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="ativo">Ativo</label>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2" name="save">Cadastrar</button>
                    <button type="submit" class="btn btn-secondary me-2" name="update">Salvar Alteração</button>
                    <button type="button" class="btn btn-danger" onclick="clearForm()">Limpar</button>
                </div>
            </form>
        </div>

        <!-- Lista de Produtos -->
        <div class="row">
            <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="product-card">
                    <img src="<?php echo $product['url_img']; ?>" alt="Imagem do Produto">
                    <h5 class="mt-3"><?php echo $product['nome']; ?></h5>
                    <p><?php echo $product['descricao']; ?></p>
                    <p><strong>Preço:</strong> R$ <?php echo number_format($product['valorunitario'], 2, ',', '.'); ?></p>
                    <p class="product-status <?php echo $product['ativo'] ? 'active' : 'inactive'; ?>">
                        <?php echo $product['ativo'] ? 'Ativo' : 'Inativo'; ?>
                    </p>
                    <div class="product-actions">
                        <a href="?edit=<?php echo $product['id']; ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="?delete=<?php echo $product['id']; ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir?');">
                            <i class="fas fa-trash"></i> Excluir
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
