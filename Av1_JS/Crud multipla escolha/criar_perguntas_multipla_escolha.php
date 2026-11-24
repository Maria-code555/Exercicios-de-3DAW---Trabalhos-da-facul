<?php

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $letraA = $_POST["letraA"];
    $letraB = $_POST["letraB"];
    $letraC = $_POST["letraC"];
    $letraD = $_POST["letraD"];
    $correta = $_POST["correta"];

    if ($id == "" || $pergunta == "" || $letraA == "" || $letraB == "" || $letraC == "" || $letraD == "") {
        $msg = "Preencha todos os campos!";
    } else {
        if (!file_exists("perguntas.txt")) {
            $arqPergunta = fopen("perguntas.txt", "w") or die("Erro ao criar!");
            $linha = "id;pergunta;letraA;letraB;letraC;letraD;correta\n";
            fwrite($arqPergunta, $linha);
            fclose($arqPergunta);
        }
        $arqPergunta = fopen("perguntas.txt", "a") or die("Erro ao abrir arquivo");
        $linha = $id . ";" . $pergunta . ";" . $letraA . ";" . $letraB . ";" . $letraC . ";" . $letraD . ";" . $correta . "\n";
        fwrite($arqPergunta, $linha);
        fclose($arqPergunta);
        $msg = "Pergunta criada com sucesso!!!";
    }
}
$resposta = ["mensagem" => $msg];

echo json_encode($resposta);

?>
