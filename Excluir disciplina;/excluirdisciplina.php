<?php

$msg = "";
$disciplina = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST["nome"];

    $arqDisciplina = fopen("disciplinas.txt", "r") or die("Erro ao abrir o arquivo");

    while (!feof($arqDisciplina)) {

        $linha = fgets($arqDisciplina);
        $colunaDados = explode(";", $linha);

        if ($colunaDados[0] == $nome) {

            $msg = "Disciplina excluída com sucesso!";

        } else {

            $disciplina = $disciplina . $linha;
        }
    }

    fclose($arqDisciplina);

    $arqDisciplina = fopen("disciplinas.txt", "w") or die("Erro ao abrir o arquivo");

    fwrite($arqDisciplina, $disciplina);

    fclose($arqDisciplina);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Disciplina</title>
</head>

<body>

    <h1>Excluir Disciplina</h1>

    <form method="POST">

        Nome da disciplina:
        <input type="text" name="nome" required>

        <br><br>

        <input type="submit" value="Excluir Disciplina">

    </form>

    <?php echo $msg; ?>

</body>

</html>
