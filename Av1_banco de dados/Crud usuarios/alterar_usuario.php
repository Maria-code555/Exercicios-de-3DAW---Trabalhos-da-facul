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
$nomeAntigo = "";

$encontrou = false;
$alterou = false;

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

//ALTERAR USUÁRIO
if (isset($_POST["alterar"])) {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $nomeAntigo = $_POST["nomeAntigo"];

    if ($nome == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Preencha os dados corretamente!";
    } else {

        $nome = $conn->real_escape_string($nome);
        $email = $conn->real_escape_string($email);
        $nomeAntigo = $conn->real_escape_string($nomeAntigo);

        $comandoSQL = "UPDATE usuarios
                       SET nome = '$nome', email = '$email'
                       WHERE nome = '$nomeAntigo'";

        $resultado = $conn->query($comandoSQL);

        if ($resultado == true) {

            if ($conn->affected_rows > 0) {
                $alterou = true;
                $msg = "Usuário alterado com sucesso!";
            } else {
                $msg = "Nenhum dado foi alterado!";
            }

        } else {
            $msg = "Erro ao alterar usuário!";
        }
    }

    $resposta = [
        "mensagem" => $msg,
        "alterou" => $alterou
    ];

    echo json_encode($resposta);
}

?>