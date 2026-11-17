<?php
// Informa que a resposta será em JSON
header("Content-Type: application/json; charset=utf-8");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST["nome"];
    $email = $_POST["email"];

    // Cria o arquivo se ele não existir
    if (!file_exists("usuarios.txt")) {

        $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao criar!");

        $linha = "nome;email\n";

        fwrite($arqUsuario, $linha);

        fclose($arqUsuario);
    }

    // Abre o arquivo para adicionar o usuário
    $arqUsuario = fopen("usuarios.txt", "a") or die("Erro ao abrir arquivo");

    $linha = $nome . ";" . $email . "\n";

    fwrite($arqUsuario, $linha);

    fclose($arqUsuario);

    $msg = "Usuário criado com sucesso!!!";
}

echo json_encode(["mensagem" => $msg]);

?>
