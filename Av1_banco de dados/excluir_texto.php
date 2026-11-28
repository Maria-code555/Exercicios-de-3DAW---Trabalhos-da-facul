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

$id = "";
$pergunta = "";
$respostaTexto = "";

$encontrou = false;
$excluiu = false;

//BUSCAR PERGUNTA
if (isset($_POST["buscar"])) {

    $id = (int) $_POST["id"];

    $comandoSQL = "SELECT * FROM perguntas_texto
                   WHERE id = $id";

    $resultado = $conn->query($comandoSQL);

    if ($resultado == true && $resultado->num_rows > 0) {

        $linha = $resultado->fetch_assoc();

        $pergunta = $linha["pergunta"];
        $respostaTexto = $linha["resposta"];

        $encontrou = true;

    } else {
        $msg = "Pergunta não encontrada!";
    }

    $resposta = [
        "mensagem" => $msg,
        "encontrou" => $encontrou,
        "id" => $id,
        "pergunta" => $pergunta,
        "respostaTexto" => $respostaTexto
    ];

    echo json_encode($resposta);
}

//EXCLUIR PERGUNTA
if (isset($_POST["excluir"])) {

    $id = (int) $_POST["id"];

    $comandoSQL = "DELETE FROM perguntas_texto
                   WHERE id = $id";

    $resultado = $conn->query($comandoSQL);

    if ($resultado == true) {

        if ($conn->affected_rows > 0) {
            $excluiu = true;
            $msg = "Pergunta excluída com sucesso!";
        } else {
            $msg = "Pergunta não encontrada!";
        }

    } else {
        $msg = "Erro ao excluir pergunta!";
    }

    $resposta = [
        "mensagem" => $msg,
        "excluiu" => $excluiu
    ];

    echo json_encode($resposta);
}

?>