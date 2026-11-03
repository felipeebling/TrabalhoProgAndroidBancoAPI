<?php
require_once 'conecta.php';

//$query = "SELECT * FROM professores";
//$result = $conn->query($query);



$stmt = $pdo->prepare("SELECT * FROM professores WHERE nome = 'Daniel Boemo'");
$stmt->execute();

$result = $stmt->fetch();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $result['id'] = $row['id'];
    $result['nome'] = $row['nome'];
    $result['email'] = $row['email'];
}

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Nenhum registro encontrado.']);
}

?>