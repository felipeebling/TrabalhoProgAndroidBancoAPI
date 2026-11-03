<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "sistema_atendimentos";


$conn = new mysqli($servidor, $usuario, $senha, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}else
echo "Conexão realizada com sucesso!";