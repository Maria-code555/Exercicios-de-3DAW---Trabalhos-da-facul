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

    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $respostaTexto = $_POST["resposta"];

    if ($id == "" || $pergunta == "" || $respostaTexto == "") {
        $msg = "Preencha todos os campos!";
    } else {

        $id = (int) $id;
        $pergunta = $conn->real_escape_string($pergunta);
        $respostaTexto = $conn->real_escape_string($respostaTexto);

        $comandoSQL = "INSERT INTO perguntas_texto
                       (id, pergunta, resposta)
                       VALUES ($id, '$pergunta', '$respostaTexto')";

        $resultado = $conn->query($comandoSQL);

        if ($resultado == true) {
            $msg = "Pergunta criada com sucesso!!!";
        } else {
            $msg = "Erro ao criar pergunta!";
        }
    }
}

$resposta = ["mensagem" => $msg];

echo json_encode($resposta);

?>