<?php
header('Content-Type: application/json');
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "sistema_atendimentos";

 

try {
    $pdo = new PDO("mysql:host=$servidor;dbname=$dbname", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode([
        'status' => 'erro',
        'mensagem' => 'Falha na conexão: ' . $e->getMessage()
    ]);
}