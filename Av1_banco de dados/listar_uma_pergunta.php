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
$encontrou = false;

$id = "";
$pergunta = "";
$letraA = "";
$letraB = "";
$letraC = "";
$letraD = "";
$correta = "";
$respostaTexto = "";

//BUSCAR PERGUNTA DE MÚLTIPLA ESCOLHA
if (isset($_POST["buscarMultipla"])) {

    $id = (int) $_POST["idMultipla"];

    $comandoSQL = "SELECT * FROM perguntas_multipla
                   WHERE id = $id";

    $resultado = $conn->query($comandoSQL);

    if ($resultado == true && $resultado->num_rows > 0) {

        $linha = $resultado->fetch_assoc();

        $pergunta = $linha["pergunta"];
        $letraA = $linha["letraA"];
        $letraB = $linha["letraB"];
        $letraC = $linha["letraC"];
        $letraD = $linha["letraD"];
        $correta = $linha["correta"];

        $encontrou = true;

    } else {
        $msg = "Pergunta não encontrada!";
    }

    $resposta = [
        "mensagem" => $msg,
        "encontrou" => $encontrou,
        "id" => $id,
        "pergunta" => $pergunta,
        "letraA" => $letraA,
        "letraB" => $letraB,
        "letraC" => $letraC,
        "letraD" => $letraD,
        "correta" => $correta
    ];

    echo json_encode($resposta);
}

//BUSCAR PERGUNTA DE TEXTO
if (isset($_POST["buscarTexto"])) {

    $id = (int) $_POST["idTexto"];

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

?>