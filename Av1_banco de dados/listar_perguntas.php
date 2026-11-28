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

$multipla = [];
$texto = [];

//LISTAR PERGUNTAS DE MÚLTIPLA ESCOLHA
$comandoSQL = "SELECT * FROM perguntas_multipla";

$resultado = $conn->query($comandoSQL);

if ($resultado == true) {

    $i = 0;

    while ($linha = $resultado->fetch_assoc()) {
        $multipla[$i] = $linha;
        $i++;
    }
}

//LISTAR PERGUNTAS DE TEXTO
$comandoSQL = "SELECT * FROM perguntas_texto";

$resultado = $conn->query($comandoSQL);

if ($resultado == true) {

    $i = 0;

    while ($linha = $resultado->fetch_assoc()) {
        $texto[$i] = $linha;
        $i++;
    }
}

$resposta = [
    "multipla" => $multipla,
    "texto" => $texto
];

echo json_encode($resposta);

?>