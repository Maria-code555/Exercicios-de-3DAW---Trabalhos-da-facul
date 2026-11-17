<?php

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST["nome"];
    $email = $_POST["email"];

    if (!file_exists("usuarios.txt")) {
        $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao criar!");
        $linha = "nome;email\n";
        fwrite($arqUsuario, $linha);
        fclose($arqUsuario);
    }

    $arqUsuario = fopen("usuarios.txt", "a") or die("Erro ao abrir arquivo");
    $linha = $nome . ";" . $email . "\n";
    fwrite($arqUsuario, $linha);
    fclose($arqUsuario);
    $msg = "Usuário criado com sucesso!!!";
}

echo json_encode(["mensagem" => $msg]);

?>
