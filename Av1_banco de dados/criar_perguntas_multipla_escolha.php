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

        $comandoSQL = "INSERT INTO perguntas_multipla
                       (id, pergunta, letraA, letraB, letraC, letraD, correta)
                       VALUES ($id, '$pergunta', '$letraA', '$letraB', '$letraC', '$letraD', '$correta')";

        $resultado = $conn->query($comandoSQL);

        if ($resultado == true) {
            $msg = "Pergunta criada com sucesso!!!";
        } else {
            $msg = "Erro ao criar pergunta!!";
        }
    }
}

$resposta = ["mensagem" => $msg];

echo json_encode($resposta);

?>