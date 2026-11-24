<?php

$msg = "";

$nome = "";
$email = "";

$encontrou = false;
$excluiu = false;

if(isset($_POST["buscar"])) {
    $nome = $_POST["nome"];
    if(file_exists("usuarios.txt")) {
        $arqUsuario = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqUsuario);
        while(!feof($arqUsuario)) {
            $linha = fgets($arqUsuario);
            if($linha != "") {
                $colunaDados = explode(";", $linha);
                if(trim($colunaDados[0]) == $nome) {
                    $email = trim($colunaDados[1]);
                    $encontrou = true;
                    break;
                }
            }
        }
        fclose($arqUsuario);
    }
    if($encontrou == true) {
        $msg = "Usuário encontrado!";
    } else {
        $msg = "Usuário não encontrado!";
    }
    echo json_encode([
        "mensagem" => $msg,
        "encontrou" => $encontrou,
        "nome" => $nome,
        "email" => $email
    ]);
}
if(isset($_POST["excluir"])) {
    $nome = $_POST["nome"];
    if(file_exists("usuarios.txt")) {
        $arqUsuario = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");
        $usuarios = "";
        $linha = fgets($arqUsuario);
        $usuarios = $linha;
        while(!feof($arqUsuario)) {
            $linha = fgets($arqUsuario);
            if($linha != "") {
                $colunaDados = explode(";", $linha);
                if(trim($colunaDados[0]) == $nome) {
                    $excluiu = true;
                } else {
                    $usuarios = $usuarios . $linha;
                }
            }
        }
        fclose($arqUsuario);
        if($excluiu == true) {
            $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao abrir arquivo");
            fwrite($arqUsuario, $usuarios);
            fclose($arqUsuario);
            $msg = "Usuário excluído com sucesso!";
        } else {
            $msg = "Usuário não encontrado!";
        }
    } else {
        $msg = "Arquivo de usuários não encontrado!";
    }
    echo json_encode([
        "mensagem" => $msg,
        "excluiu" => $excluiu
    ]);
}

?>