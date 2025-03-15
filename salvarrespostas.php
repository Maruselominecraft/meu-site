<?php
// Conectar ao MySQL
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "quiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Receber dados do POST
$data = json_decode(file_get_contents("php://input"), true);
$ip = $data['ip'];
$respostas = $data['answers'];

// Inserir as respostas no banco de dados
foreach ($respostas as $pergunta => $resposta) {
    $sql = "INSERT INTO respostas (ip, pergunta, resposta) VALUES ('$ip', '$pergunta', '$resposta')";
    $conn->query($sql);
}

$conn->close();
echo json_encode(["message" => "Respostas salvas com sucesso!"]);
?>