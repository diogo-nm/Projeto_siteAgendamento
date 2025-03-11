<?php
$msg = "";
if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h2 class="text-center mb-4">Formulário de Login</h2>
                
                <!-- Exibe mensagem de erro ou sucesso -->
                <?php if ($msg): ?>
                    <div class="alert alert-info text-center"><?php echo $msg; ?></div>
                <?php endif; ?>

                <!-- Formulário de login -->
                <form action="process_login.php" method="post" class="border p-4 rounded shadow-sm">
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>E-mail:</strong></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label"><strong>Senha:</strong></label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Logar</button>
                </form>

                <!-- Link para cadastro -->
                <p class="text-center mt-3"><a href="novo_cadastro.php" class="text-decoration-none">Cadastrar novo usuário</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
