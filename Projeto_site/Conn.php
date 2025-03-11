<?php

class Conn {
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "marina_beauty";
    public $port = 3306;
    public $connect = null;

    public function conectar() {
        try {
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" .  $this->dbname, $this->user, $this->pass);
            return $this->connect;
        } catch (Exception $err) {
            echo "ERRO: Conexão não realizada com sucesso! Erro Gerado: $err";
            return false;
        }
    }
}
?>
