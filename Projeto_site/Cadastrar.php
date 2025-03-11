<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente - Marina Araujo Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="text-center">Cadastro de Cliente</h2>
                <p class="text-center">Cadastre as informações do cliente para manter nossos registros atualizados.</p>

                <form method="POST">
                    <div class="mb-4">
                        <label for="nome" class="form-label"><strong>Nome Completo:</strong></label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label"><strong>E-mail:</strong></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="telefone" class="form-label"><strong>Telefone:</strong></label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" pattern="[0-9]{11}" maxlength="11" placeholder="Ex: 18999999999" required>
                    </div>

                    <div class="mb-4">
                        <label for="senha" class="form-label"><strong>Senha:</strong></label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar Cliente</button>
                </form>

                <?php
                    include('Conn.php'); //acessando a conexão

                    $conn = new Conn();
                    $pdo = $conn->conectar();

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nome = $_POST['nome'];
                        $email = $_POST['email'];
                        $telefone = $_POST['telefone'];
                        $senha = $_POST['senha'];

                        //comando SQL para inserir o cliente
                        $sql = "INSERT INTO clientes (nome, email, telefone, senha) VALUES (:nome, :email, :telefone, :senha)";
                        $stmt = $pdo->prepare($sql);
                        
                        //parâmetros
                        $stmt->bindParam(':nome', $nome);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':telefone', $telefone);
                        $stmt->bindParam(':senha', $senha);

                        //executar o comando SQL
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success mt-3'>Cadastro realizado com sucesso!</div>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Erro ao realizar cadastro.</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
