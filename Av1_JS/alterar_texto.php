<?php

$msg = "";

$id = "";
$pergunta = "";
$respostaTexto = "";

$encontrou = false;
$alterou = false;

if (isset($_POST["buscar"])) {
    $id = $_POST["id"];
    if (file_exists("perguntas_texto.txt")) {
        $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqPergunta);
        while (!feof($arqPergunta)) {
            $linha = fgets($arqPergunta);
            if ($linha != "") {
                $colunaDados = explode(";", $linha);
                if ($colunaDados[0] == $id) {
                    $pergunta = $colunaDados[1];
                    $respostaTexto = trim($colunaDados[2]);
                    $encontrou = true;
                    break;
                }
            }
        }
        fclose($arqPergunta);
        if ($encontrou == false) {
            $msg = "Pergunta não encontrada!";
        }
    } else {
        $msg = "Nenhuma pergunta cadastrada!";
    }
    $resposta = [
        "mensagem" => $msg,
        "encontrou" => $encontrou,
        "id" => $id,
        "pergunta" => $pergunta,
        "respostaTexto" => $respostaTexto
    ];
    echo json_encode($resposta);
}
if (isset($_POST["alterar"])) {
    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $respostaTexto = $_POST["resposta"];

    if ($id == "" || $pergunta == "" || $respostaTexto == "") {
        $msg = "Preencha todos os campos!";
    } else if (file_exists("perguntas_texto.txt")) {
        $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");
        $arqTemp = fopen("perguntas_textoTemp.txt", "w") or die("Erro ao criar arquivo");
        $linha = fgets($arqPergunta);
        fprintf($arqTemp, "%s", $linha);
        while (!feof($arqPergunta)) {
            $linha = fgets($arqPergunta);
            if ($linha != "") {
                $colunaDados = explode(";", $linha);
                if ($colunaDados[0] == $id) {
                    fprintf($arqTemp, "%s;%s;%s\n", $id, $pergunta, $respostaTexto);
                    $alterou = true;
                } else {
                    fprintf($arqTemp, "%s", $linha);
                }
            }
        }
        fclose($arqPergunta);
        fclose($arqTemp);
        if ($alterou == true) {
            $arqPergunta = fopen("perguntas_texto.txt", "w") or die("Erro ao abrir arquivo");
            $arqTemp = fopen("perguntas_textoTemp.txt", "r") or die("Erro ao abrir arquivo");
            while (!feof($arqTemp)) {
                $linha = fgets($arqTemp);
                if ($linha != "") {
                    fprintf($arqPergunta, "%s", $linha);
                }
            }
            fclose($arqPergunta);
            fclose($arqTemp);
            $msg = "Pergunta alterada com sucesso!";
        } else {
            $msg = "Pergunta não encontrada!";
        }
    } else {
        $msg = "Nenhuma pergunta cadastrada!";
    }
    $resposta = [
        "mensagem" => $msg,
        "alterou" => $alterou
    ];
    echo json_encode($resposta);
}

?>