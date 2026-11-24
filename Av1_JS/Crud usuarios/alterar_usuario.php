<?php
$msg = "";

$nome = "";
$email = "";
$nomeAntigo = "";

$encontrou = false;
$alterou = false;
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
if(isset($_POST["alterar"])) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $nomeAntigo = $_POST["nomeAntigo"];
    if($nome == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "Preencha os dados corretamente!";
    } else if(!file_exists("usuarios.txt")) {
        $msg = "Arquivo de usuários não encontrado!";
    } else {
        $arqUsuario = fopen("usuarios.txt", "r") or die("Erro ao abrir arquivo");
        $arqTemp = fopen("usuariosTemp.txt", "w") or die("Erro ao criar arquivo");
        $linha = fgets($arqUsuario);
        fprintf($arqTemp, "%s", $linha);
        while(!feof($arqUsuario)) {
            $linha = fgets($arqUsuario);
            if($linha != "") {
                $colunaDados = explode(";", $linha);
                if(trim($colunaDados[0]) == $nomeAntigo) {
                    fprintf($arqTemp, "%s;%s\n", $nome, $email);
                    $alterou = true;
                } else {
                    fprintf($arqTemp, "%s", $linha);
                }
            }
        }
        fclose($arqUsuario);
        fclose($arqTemp);
        if($alterou == true) {
            $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao abrir arquivo");
            $arqTemp = fopen("usuariosTemp.txt", "r") or die("Erro ao abrir arquivo");
            while(!feof($arqTemp)) {
                $linha = fgets($arqTemp);
                if($linha != "") {
                    fprintf($arqUsuario, "%s", $linha);
                }
            }
            fclose($arqUsuario);
            fclose($arqTemp);
            $msg = "Usuário alterado com sucesso!";
        } else {
            $msg = "Usuário não encontrado!";
        }
    }
    echo json_encode([
        "mensagem" => $msg,
        "alterou" => $alterou
    ]);
}
?>