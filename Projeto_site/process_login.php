<?php
include('Conn.php');

$conn = new Conn();
$pdo = $conn->conectar();

$email = $_POST['email'];
$senha = $_POST['senha'];

try{

    //busca o cliente com o telefone informado
    $sql = "SELECT * FROM clientes WHERE email = :email AND senha = :senha";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    $res = $stmt->fetchAll();

    if(count($res) > 0){
        foreach ($res as $row){
            $id = $row['id'];
        }
            header("Location:restrito.php");
    }
    else {
        header("Location:index.php?msg=Falha no Login");
    }
} catch(PDOException $e){
    $e->getMessage();
}
?>
