<?php

$msg = "";

$id = "";
$pergunta = "";
$letraA = "";
$letraB = "";
$letraC = "";
$letraD = "";
$correta = "";

$encontrou = false;
$excluiu = false;
// BUSCAR PERGUNTA
if (isset($_POST["buscar"])) {
    $id = $_POST["id"];
    if (file_exists("perguntas.txt")) {
        $arqPergunta = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqPergunta);
        while (!feof($arqPergunta)) {
            $linha = fgets($arqPergunta);
            if ($linha != "") {
                $colunaDados = explode(";", $linha);
                if ($colunaDados[0] == $id) {
                    $pergunta = $colunaDados[1];
                    $letraA = $colunaDados[2];
                    $letraB = $colunaDados[3];
                    $letraC = $colunaDados[4];
                    $letraD = $colunaDados[5];
                    $correta = trim($colunaDados[6]);
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
        "letraA" => $letraA,
        "letraB" => $letraB,
        "letraC" => $letraC,
        "letraD" => $letraD,
        "correta" => $correta
    ];
    echo json_encode($resposta);
}
// EXCLUIR PERGUNTA
if (isset($_POST["excluir"])) {
    $id = $_POST["id"];
    if (file_exists("perguntas.txt")) {
        $arqPergunta = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo");
        $perguntas = "";
        $linha = fgets($arqPergunta);
        $perguntas = $linha;
        while (!feof($arqPergunta)) {
            $linha = fgets($arqPergunta);
            if ($linha != "") {
                $colunaDados = explode(";", $linha);
                if ($colunaDados[0] == $id) {
                    $excluiu = true;
                } else {
                    $perguntas = $perguntas . $linha;
                }
            }
        }
        fclose($arqPergunta);
        if ($excluiu == true) {
            $arqPergunta = fopen("perguntas.txt", "w") or die("Erro ao abrir arquivo");
            fwrite($arqPergunta, $perguntas);
            fclose($arqPergunta);
            $msg = "Pergunta excluída com sucesso!";
        } else {
            $msg = "Pergunta não encontrada!";
        }
    } else {
        $msg = "Nenhuma pergunta cadastrada!";
    }
    $resposta = [
        "mensagem" => $msg,
        "excluiu" => $excluiu
    ];
    echo json_encode($resposta);
}

?>