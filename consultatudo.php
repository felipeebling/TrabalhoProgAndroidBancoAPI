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
    case 'lista':
        ListarAtendimentoDia($pdo);
        break;
    default:
        die(json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida.']));
          
 }
}

function ListarAtendimentoDia($pdo) {
$diaAtual = date("Y-m-d");// corrigir dia

$sql = "SELECT * FROM atendimentos WHERE data = :diaAtual and situacao = 'agendado'";

echo($diaAtual);
if (!empty($_GET['idprofessor']) ){
$professorId = $_GET['idprofessor'];
$sql .=  "AND professor_id = $professorId";

}

try{
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':diaAtual', $diaAtual);

$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $results[] = [
            'id' => $row['id'],
            'professor_id' => $row['professor_id'],
            'aluno_id' => $row['aluno_id'],
             'data'=> $row['data'],
             'hora'=> $row['hora'],
             'duracao'=> $row['duracao'],
             'disciplina'=> $row['disciplina'],
             'tipo'=> $row['tipo'],
             'modalidade'=> $row['modalidade'],
             'local_link'=> $row['local_link'], ];
}

 die(json_encode($results));

}catch(PDOException $e) {
    die(json_encode(['status' => 'erro', 'mensagem' => 'Erro na consulta: ' . $e->getMessage()]));
}

}
function consultarTodos($pdo) {
 

try{
    $stmt = $pdo->prepare("SELECT * FROM professores");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $results[] = [
            'id' => $row['id'],
            'nome' => $row['nome'],
            'email' => $row['email']
        ];
    }

    die(json_encode($results));
}catch(PDOException $e) {
    die(json_encode(['status' => 'erro', 'mensagem' => 'Erro na consulta: ' . $e->getMessage()]));
}
}
 
        
    

?>