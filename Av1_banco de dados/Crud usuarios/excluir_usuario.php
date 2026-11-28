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

$nome = "";
$email = "";

$encontrou = false;
$excluiu = false;

//BUSCAR USUÁRIO
if (isset($_POST["buscar"])) {

    $nome = $_POST["nome"];
    $nomeBusca = $conn->real_escape_string($nome);

    $comandoSQL = "SELECT * FROM usuarios
                   WHERE nome = '$nomeBusca'";

    $resultado = $conn->query($comandoSQL);

    if ($resultado == true && $resultado->num_rows > 0) {

        $linha = $resultado->fetch_assoc();

        $nome = $linha["nome"];
        $email = $linha["email"];

        $encontrou = true;
        $msg = "Usuário encontrado!";

    } else {
        $msg = "Usuário não encontrado!";
    }

    $resposta = [
        "mensagem" => $msg,
        "encontrou" => $encontrou,
        "nome" => $nome,
        "email" => $email
    ];

    echo json_encode($resposta);
}

//EXCLUIR USUÁRIO
if (isset($_POST["excluir"])) {

    $nome = $_POST["nome"];
    $nome = $conn->real_escape_string($nome);

    $comandoSQL = "DELETE FROM usuarios
                   WHERE nome = '$nome'";

    $resultado = $conn->query($comandoSQL);

    if ($resultado == true) {

        if ($conn->affected_rows > 0) {
            $excluiu = true;
            $msg = "Usuário excluído com sucesso!";
        } else {
            $msg = "Usuário não encontrado!";
        }

    } else {
        $msg = "Erro ao excluir usuário!";
    }

    $resposta = [
        "mensagem" => $msg,
        "excluiu" => $excluiu
    ];

    echo json_encode($resposta);
}

?>