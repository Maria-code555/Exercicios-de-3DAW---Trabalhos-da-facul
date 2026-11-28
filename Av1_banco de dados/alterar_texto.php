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
$alterou = false;

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

//ALTERAR PERGUNTA
if (isset($_POST["alterar"])) {

    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $respostaTexto = $_POST["resposta"];

    if ($id == "" || $pergunta == "" || $respostaTexto == "") {
        $msg = "Preencha todos os campos!";
    } else {

        $id = (int) $id;
        $pergunta = $conn->real_escape_string($pergunta);
        $respostaTexto = $conn->real_escape_string($respostaTexto);

        $comandoSQL = "UPDATE perguntas_texto
                       SET pergunta = '$pergunta',
                           resposta = '$respostaTexto'
                       WHERE id = $id";

        $resultado = $conn->query($comandoSQL);

        if ($resultado == true) {

            if ($conn->affected_rows > 0) {
                $alterou = true;
                $msg = "Pergunta alterada com sucesso!";
            } else {
                $msg = "Nenhum dado foi alterado!";
            }

        } else {
            $msg = "Erro ao alterar pergunta!";
        }
    }

    $resposta = [
        "mensagem" => $msg,
        "alterou" => $alterou
    ];

    echo json_encode($resposta);
}

?>