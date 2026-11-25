<?php

$msg = "";

$id = "";
$pergunta = "";
$respostaTexto = "";

$encontrou = false;
$excluiu = false;
//BUSCAR PERGUNTA
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
// EXCLUIR PERGUNTA
if (isset($_POST["excluir"])) {

    $id = $_POST["id"];

    if (file_exists("perguntas_texto.txt")) {

        $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");

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

            $arqPergunta = fopen("perguntas_texto.txt", "w") or die("Erro ao abrir arquivo");

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