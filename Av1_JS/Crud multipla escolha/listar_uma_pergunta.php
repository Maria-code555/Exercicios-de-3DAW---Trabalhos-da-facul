<?php

$msg = "";
$encontrou = false;

$id = "";
$pergunta = "";
$letraA = "";
$letraB = "";
$letraC = "";
$letraD = "";
$correta = "";
$respostaTexto = "";
// BUSCAR PERGUNTA DE MÚLTIPLA ESCOLHA
if (isset($_POST["buscarMultipla"])) {
    $id = $_POST["idMultipla"];
    if (file_exists("perguntas.txt")) {
        $arqPergunta = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqPergunta);
        while (!feof($arqPergunta)) {
            $linha = fgets($arqPergunta);
            if ($linha != "") {
                $colunaDados = explode(";", $linha);
                if (trim($colunaDados[0]) == $id) {
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
// BUSCAR PERGUNTA DE TEXTO
if (isset($_POST["buscarTexto"])) {
    $id = $_POST["idTexto"];
    if (file_exists("perguntas_texto.txt")) {
        $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqPergunta);
        while (!feof($arqPergunta)) {
            $linha = fgets($arqPergunta);
            if ($linha != "") {
                $colunaDados = explode(";", $linha);
                if (trim($colunaDados[0]) == $id) {
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

?>