<?php
//conectando ao banco de dados
$servidor = "localhost";
$username = "root";
$senha = "";
$database = "av1_bd";

mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli($servidor, $username, $senha, $database);

if ($conn->connect_error) {
    die("Conexao falhou, avise o administrador do sistema");
}

$conn->set_charset("utf8mb4");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if ($nome == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Preencha os dados corretamente!";
    } else {
        $nome = $conn->real_escape_string($nome);
        $email = $conn->real_escape_string($email);

        $comandoSQL = "INSERT INTO usuarios (nome, email)
                       VALUES ('$nome', '$email')";
        $resultado = $conn->query($comandoSQL);

        if ($resultado == true) {
            $msg = "Usuário criado com sucesso!!!";
        } else {
            $msg = "Erro ao criar usuário!";
        }
    }
}

$resposta = ["mensagem" => $msg];

echo json_encode($resposta);

?> 