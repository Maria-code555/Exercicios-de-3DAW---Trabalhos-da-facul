<?php

$usuarios = [];
if (file_exists("usuarios.txt")) {
    $arqUsuario = fopen("usuarios.txt", "r")
        or die("Erro ao abrir arquivo");
    $linha = fgets($arqUsuario);
    while (!feof($arqUsuario)) {
        $linha = fgets($arqUsuario);
        if ($linha != "") {
            $colunaDados = explode(";", $linha);
            $usuarios[] = [
                "nome" => $colunaDados[0],
                "email" => trim($colunaDados[1])
            ];
        }
    }
    fclose($arqUsuario);
}

echo json_encode($usuarios);

?>