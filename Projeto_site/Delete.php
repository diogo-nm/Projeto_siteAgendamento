<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cliente - Marina Araujo Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="text-center">Excluir Cliente</h2>
                <p class="text-center">Remova um cliente de nossos registros caso necessário.</p>

                <form method="POST">
                    <div class="mb-4">
                        <label for="telefone" class="form-label"><strong>Telefone do Cliente:</strong></label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" pattern="[0-9]{11}" maxlength="11" placeholder="Digite o telefone do cliente" required>
                        <small>Exemplo: 18999999999</small>
                    </div>

                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>

                <?php
                include 'Conn.php';

                $conn = new Conn();
                $pdo = $conn->conectar();

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $telefone = $_POST['telefone'];

                    //verifica se o cliente existe
                    $sql = "SELECT id FROM clientes WHERE telefone = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$telefone]);
                    $cliente = $stmt->fetch();

                    if ($cliente) {
                        $cliente_id = $cliente['id'];

                        //se o cliente possui agendamentos
                        $sql = "SELECT COUNT(*) FROM agendamentos WHERE cliente_id = ?";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$cliente_id]);
                        $agendamentos = $stmt->fetchColumn();

                        if ($agendamentos > 0) {
                            //se cliente tem agendamento, não pode ser excluído
                            echo "<div class='alert alert-warning mt-3'>Esse cliente possui um horário marcado!</div>";
                        } else {
                            //se não tem agendamentos, exclui
                            $sql = "DELETE FROM clientes WHERE telefone = ?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$telefone]);
                            echo "<div class='alert alert-success mt-3'>Cliente excluído com sucesso!</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Cliente não encontrado!</div>";
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
