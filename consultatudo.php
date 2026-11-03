<?php
require_once 'conecta.php';

//$query = "SELECT * FROM professores";
//$result = $conn->query($query);

$acao = $_GET['acao'];

if($acao == "") {
    die(json_encode(['status' => 'erro', 'mensagem' => 'Acao nula']));
}else{

 switch($acao) {
   
    case 'consultar_professores':
        consultarTodos($pdo);
        break;
    default:
        die(json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida.']));
        break ;  
 }
}

function ListarAtendimentoDia($pdo) {
$professorId = $_GET['idprofessor'];

 $diaAtual = date("Y-m-d");
$stmt = $pdo->prepare("SELECT * FROM atendimentos WHERE data = :diaAtual and situacao = 'agendado' and professor_id = :professorId");
$stmt->bindParam(':diaAtual', $diaAtual);
$stmt->bindParam(':professorId', $professorId);
$stmt->execute();

}
function consultarTodos($pdo) {
    
    $stmt = $pdo->prepare("SELECT * FROM professores");
    $stmt->execute();
    
    
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $results[] = [
            'id' => $row['id'],
            'nome' => $row['nome'],
            'email' => $row['email']
        ];
    }
    
    if (!empty($results)) {
        die(json_encode($results));
    } else {
        die(json_encode(['status' => 'erro', 'mensagem' => 'Nenhum registro encontrado.']));
    }
}

?>