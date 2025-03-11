<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Atendimento - Marina Araujo Beauty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h2 class="text-center">Agendar Atendimento</h2>
                <p class="text-center">Agende um atendimento para o cliente informado.</p>

                <form method="POST">
                    <div class="mb-4">
                        <label for="telefone" class="form-label"><strong>Telefone do Cliente:</strong></label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" pattern="[0-9]{11}" maxlength="11" placeholder="Digite o telefone do cliente" required>
                        <small>Exemplo: 18999999999</small>
                    </div>

                    <div class="mb-4">
                        <label for="data" class="form-label"><strong>Data do Atendimento:</strong></label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>

                    <div class="mb-4">
                        <label for="hora" class="form-label"><strong>Hora do Atendimento:</strong></label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Agendar Atendimento</button>
                </form>

                <?php
                    include('Conn.php'); //conexão

                    $conn = new Conn();
                    $pdo = $conn->conectar();

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $telefone = $_POST['telefone'];
                        $data = $_POST['data'];
                        $hora = $_POST['hora'];

                        //verifica se o telefone do cliente existe
                        $sql = "SELECT id FROM clientes WHERE telefone = :telefone";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':telefone', $telefone);
                        $stmt->execute();

                        if ($stmt->rowCount() > 0) {
                            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
                            $cliente_id = $cliente['id'];

                            //comando SQL para inserir o agendamento
                            $sql = "INSERT INTO agendamentos (cliente_id, data_atendimento, horario_atendimento) VALUES (:cliente_id, :data_atendimento, :horario_atendimento)";
                            $stmt = $pdo->prepare($sql);

                            $stmt->bindParam(':cliente_id', $cliente_id);
                            $stmt->bindParam(':data_atendimento', $data);
                            $stmt->bindParam(':horario_atendimento', $hora);

                            //comando SQL
                            if ($stmt->execute()) {
                                echo "<div class='alert alert-success mt-3'>Atendimento agendado com sucesso!</div>";
                            } else {
                                echo "<div class='alert alert-danger mt-3'>Erro ao agendar atendimento.</div>";
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
