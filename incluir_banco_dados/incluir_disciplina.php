<?php
//conectando ao banco de dados
$servidor = "localhost";
$username = "root";
$senha = "";
$database = "incluir_disciplinas";

$conn = new mysqli($servidor, $username, $senha, $database);

//verificando conexão
if ($conn->connect_error) {
    die("Conexao falhou, avise o administrador do sistema");
}

$incluiu = false;

$sigla = $_POST["sigla"];
$nome = $_POST["nome"];
$carga_horaria = $_POST["carga_horaria"];

if ($sigla == "" || $nome == "" || $carga_horaria <= 0) {
    $msg = "Preencha todos os campos corretamente!";
} else {

    $sigla = $conn->real_escape_string($sigla);
    $nome = $conn->real_escape_string($nome);
    $carga_horaria = (int) $carga_horaria;

    $comandoSQL = "INSERT INTO disciplinas (sigla, nome, carga_horaria)
                   VALUES ('$sigla', '$nome', $carga_horaria)";

    mysqli_report(MYSQLI_REPORT_OFF);

    $resultado = $conn->query($comandoSQL);

    if ($resultado == true) {
        $msg = "Disciplina incluida com sucesso!!!";
        $incluiu = true;
    } else {
        $msg = "Erro ao incluir disciplina!";
    }
}

$resposta = [
    "mensagem" => $msg,
    "incluiu" => $incluiu
];

echo json_encode($resposta);

?>