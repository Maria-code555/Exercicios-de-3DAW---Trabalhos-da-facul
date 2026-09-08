<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Lista de Alunos</title>

</head>

<body>

    <h1>Lista de Alunos</h1>

      <table>
        <tr><th>MATRÍCULA</th><th>NOME</th><th>EMAIL</th><th>AÇÕES</th></tr>
        
        <?php

$arqAluno = fopen("alunos.txt", "r") or die("erro ao abrir arquivo");

$linha = fgets($arqAluno);

while(!feof($arqAluno)) {

    $linha = fgets($arqAluno);

    if($linha != "") {

        $colunaDados = explode(";", $linha);

        echo "<tr><td>" . $colunaDados[1] . "</td>" .
            "<td>" . $colunaDados[0] . "</td>" .
            "<td>" . $colunaDados[2] . "</td>" .
            "<td>" .
            "<a href='alterar_aluno.php?matricula=" . $colunaDados[1] . "'>Alterar</a> " .
            "<a href='excluir_aluno.php?matricula=" . $colunaDados[1] . "'>Excluir</a>" .
            "</td></tr>";
    }
}

fclose($arqAluno);

?>

</table>

</body>
</html>



