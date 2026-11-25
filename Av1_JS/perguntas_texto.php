<?php

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $pergunta = $_POST["pergunta"];
    $respostaTexto = $_POST["resposta"];
    if ($id == "" || $pergunta == "" || $respostaTexto == "") {
        $msg = "Preencha todos os campos!";
    } else {
        if (!file_exists("perguntas_texto.txt")) {
            $arqPergunta = fopen("perguntas_texto.txt", "w") or die("Erro ao criar!");
            $linha = "id;pergunta;resposta\n";
            fwrite($arqPergunta, $linha);
            fclose($arqPergunta);
        }
        $arqPergunta = fopen("perguntas_texto.txt", "a") or die("Erro ao abrir arquivo");
        $linha = $id . ";" . $pergunta . ";" . $respostaTexto . "\n";
        fwrite($arqPergunta, $linha);
        fclose($arqPergunta);
        $msg = "Pergunta criada com sucesso!!!";
    }
}
$resposta = ["mensagem" => $msg];

echo json_encode($resposta);

?>