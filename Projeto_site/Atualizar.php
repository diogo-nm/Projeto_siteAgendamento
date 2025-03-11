<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cliente - Marina Araujo Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="text-center">Atualizar Cliente</h2>
                <p class="text-center">Atualize as informações do cliente para manter nossos registros atualizados.</p>

                <form method="POST">
                    <div class="mb-4">
                        <label for="telefone" class="form-label"><strong>Telefone do Cliente:</strong></label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" pattern="[0-9]{11}" maxlength="11" placeholder="Digite o telefone do cliente" required>
                        <small>Exemplo: 18999999999</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Consultar</button>
                </form>

                <?php
                    include 'Conn.php';

                    //conexão com o banco
                    $conn = new Conn();
                    $pdo = $conn->conectar();

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['telefone'])) {
                        $telefone = $_POST['telefone'];

                        //verifica se a conexão foi estabelecida
                        if ($pdo) {
                            //busca o cliente pelo telefone
                            $sql = "SELECT * FROM clientes WHERE telefone = ?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$telefone]);
                            $cliente = $stmt->fetch();

                            if ($cliente) {
                                echo "
                                <form method='POST'>
                                    <div class='mb-3'>
                                        <label for='nome' class='form-label'><strong>Nome Completo:</strong></label>
                                        <input type='text' class='form-control' id='nome' name='nome' value='{$cliente['nome']}' required>
                                    </div>
                                    <div class='mb-3'>
                                        <label for='email' class='form-label'><strong>E-mail:</strong></label>
                                        <input type='email' class='form-control' id='email' name='email' value='{$cliente['email']}' required>
                                    </div>
                                    <input type='hidden' name='telefone_antigo' value='{$cliente['telefone']}'>
                                    <button type='submit' class='btn btn-warning'>Atualizar</button>
                                </form>";
                            } else {
                                echo "<div class='alert alert-danger mt-3'>Cliente não encontrado!</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Erro de conexão com o banco de dados!</div>";
                        }
                    }

                    //atualiza cliente
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome']) && isset($_POST['telefone_antigo'])) {
                        $nome = $_POST['nome'];
                        $email = $_POST['email'];
                        $telefone_antigo = $_POST['telefone_antigo'];
                        $telefone_novo = isset($_POST['telefone']) ? $_POST['telefone'] : $telefone_antigo;

                        //atualiza os dados do cliente
                        if ($pdo) {
                            $sql = "UPDATE clientes SET nome = ?, email = ?, telefone = ? WHERE telefone = ?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$nome, $email, $telefone_novo, $telefone_antigo]);
                            echo "<div class='alert alert-success mt-3'>Cliente atualizado com sucesso!</div>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Erro de conexão com o banco de dados!</div>";
                        }
                    }
                ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
