<?php

$multipla = [];
$texto = [];
// LISTAR PERGUNTAS DE MÚLTIPLA ESCOLHA
if (file_exists("perguntas.txt")) {
    $arqPergunta = fopen("perguntas.txt", "r") or die("Erro ao abrir arquivo");
    $linha = fgets($arqPergunta);
    while (!feof($arqPergunta)) {
        $linha = fgets($arqPergunta);
        if ($linha != "") {
            $colunaDados = explode(";", $linha);
            $multipla[] = [
                "id" => $colunaDados[0],
                "pergunta" => $colunaDados[1],
                "letraA" => $colunaDados[2],
                "letraB" => $colunaDados[3],
                "letraC" => $colunaDados[4],
                "letraD" => $colunaDados[5],
                "correta" => trim($colunaDados[6])
            ];
        }
    }
    fclose($arqPergunta);
}
// LISTAR PERGUNTAS DE TEXTO
if (file_exists("perguntas_texto.txt")) {
    $arqPergunta = fopen("perguntas_texto.txt", "r") or die("Erro ao abrir arquivo");
    $linha = fgets($arqPergunta);
    while (!feof($arqPergunta)) {
        $linha = fgets($arqPergunta);
        if ($linha != "") {
            $colunaDados = explode(";", $linha);
            $texto[] = [
                "id" => $colunaDados[0],
                "pergunta" => $colunaDados[1],
                "resposta" => trim($colunaDados[2])
            ];
        }
    }
    fclose($arqPergunta);
}
$resposta = [
    "multipla" => $multipla,
    "texto" => $texto
];
echo json_encode($resposta);

?>