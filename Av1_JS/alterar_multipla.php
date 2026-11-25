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
$alterou = false;

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
if (isset($_POST["alterar"])) {

    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $letraA = $_POST["letraA"];
    $letraB = $_POST["letraB"];
    $letraC = $_POST["letraC"];
    $letraD = $_POST["letraD"];
    $correta = $_POST["correta"];

    if ($id == "" || $pergunta == "" || $letraA == "" || $letraB == "" || $letraC == "" || $letraD == "") {
        $msg = "Preencha todos os campos!";
    } else if (file_exists("perguntas.txt")) {
        $arqPergunta = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo");
        $arqTemp = fopen("perguntasTemp.txt", "w") or die("Erro ao criar arquivo");
        $linha = fgets($arqPergunta);
        fprintf($arqTemp, "%s", $linha);
        while (!feof($arqPergunta)) {
            $linha = fgets($arqPergunta);
            if ($linha != "") {
                $colunaDados = explode(";", $linha);
                if ($colunaDados[0] == $id) {
                    fprintf($arqTemp, "%s;%s;%s;%s;%s;%s;%s\n",
                            $id, $pergunta, $letraA, $letraB,
                            $letraC, $letraD, $correta);
                    $alterou = true;
                } else {
                    fprintf($arqTemp, "%s", $linha);
                }
            }
        }
        fclose($arqPergunta);
        fclose($arqTemp);
        if ($alterou == true) {
            $arqPergunta = fopen("perguntas.txt", "w") or die("Erro ao abrir arquivo");
            $arqTemp = fopen("perguntasTemp.txt", "r") or die("Erro ao abrir arquivo");
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