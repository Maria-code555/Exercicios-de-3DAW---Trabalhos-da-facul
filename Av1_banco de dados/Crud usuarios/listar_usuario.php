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

$usuarios = [];

$comandoSQL = "SELECT * FROM usuarios";

$resultado = $conn->query($comandoSQL);

if ($resultado == true) {
    $i = 0;

    while ($linha = $resultado->fetch_assoc()) {
        $usuarios[$i] = $linha;
        $i++;
    }
}

echo json_encode($usuarios);

?>