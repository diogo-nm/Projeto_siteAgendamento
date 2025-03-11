<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Atendimento - Marina Araujo Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="text-center">Consultar Atendimento</h2>
                <p class="text-center">Verifique os atendimentos agendados.</p>

                <form method="POST">
                    <div class="mb-4">
                        <label for="telefone" class="form-label"><strong>Telefone do Cliente:</strong></label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" pattern="[0-9]{11}" maxlength="11" placeholder="Digite o número sem espaçamento ou caracteres especiais." required>
                        <small>Exemplo: 18999999999</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </form>

                <?php
                    include('Conn.php');

                    $conn = new Conn();
                    $pdo = $conn->conectar();

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $telefone = $_POST['telefone'];

                        //busca o cliente com o telefone informado
                        $sql = "SELECT id, nome FROM clientes WHERE telefone = :telefone";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':telefone', $telefone);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
                            $cliente_id = $cliente['id'];
                            $nome_cliente = $cliente['nome'];

                            //busca os agendamentos do cliente
                            $sql = "SELECT * FROM agendamentos WHERE cliente_id = :cliente_id";
                            $stmt = $pdo->prepare($sql);
                            $stmt->bindParam(':cliente_id', $cliente_id);
                            $stmt->execute();

                            if ($stmt->rowCount() > 0) {
                                echo "<div class='mt-3'>O cliente $nome_cliente possui os seguintes atendimentos:</div>";
                                while ($atendimento = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<div class='alert alert-success mt-3'>Dia " . $atendimento['data_atendimento'] . " às " . $atendimento['horario_atendimento'] . "</div>";
                                }
                            } else {
                                echo "<div class='alert alert-warning mt-3'>Cliente sem agendamento.</div>";
                            }
                        } else {
                            echo "<div class='alert alert-warning mt-3'>Cliente não encontrado.</div>";
                        }
                    }
                    ?>


            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
