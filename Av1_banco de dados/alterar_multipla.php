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
$letraA = "";
$letraB = "";
$letraC = "";
$letraD = "";
$correta = "";

$encontrou = false;
$alterou = false;

//BUSCAR PERGUNTA
if (isset($_POST["buscar"])) {

    $id = (int) $_POST["id"];

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

//ALTERAR PERGUNTA
if (isset($_POST["alterar"])) {

    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $letraA = $_POST["letraA"];
    $letraB = $_POST["letraB"];
    $letraC = $_POST["letraC"];
    $letraD = $_POST["letraD"];
    $correta = $_POST["correta"];

    if ($id == "" || $pergunta == "" || $letraA == "" || $letraB == "" || $letraC == "" || $letraD == "") {
        $msg = "Preencha todos os campos!";
    } else {

        $id = (int) $id;
        $pergunta = $conn->real_escape_string($pergunta);
        $letraA = $conn->real_escape_string($letraA);
        $letraB = $conn->real_escape_string($letraB);
        $letraC = $conn->real_escape_string($letraC);
        $letraD = $conn->real_escape_string($letraD);
        $correta = $conn->real_escape_string($correta);

        $comandoSQL = "UPDATE perguntas_multipla
                       SET pergunta = '$pergunta',
                           letraA = '$letraA',
                           letraB = '$letraB',
                           letraC = '$letraC',
                           letraD = '$letraD',
                           correta = '$correta'
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