<?php

$msg = "";
$nome = "";
$matricula = "";
$email = "";
$cpf = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['matricula'])) {

    $matricula = $_GET['matricula'];

    $arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo");

    $linha = fgets($arqAluno);

    while (!feof($arqAluno)) {

        $linha = fgets($arqAluno);

        if ($linha != "") {

            $colunaDados = explode(";", $linha);

            if ($colunaDados[1] == $matricula) {

                $nome = $colunaDados[0];
                $email = $colunaDados[2];
                $cpf = $colunaDados[3];

            }
        }
    }

    fclose($arqAluno);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $matricula = $_POST["matricula"];

    $arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo");

    $alunos = "";

    $linha = fgets($arqAluno);

    $alunos = $linha;

    while (!feof($arqAluno)) {

        $linha = fgets($arqAluno);

        if ($linha != "") {

            $colunaDados = explode(";", $linha);

            if ($colunaDados[1] == $matricula) {

                $msg = "Aluno excluído com sucesso!";

            } else {

                $alunos = $alunos . $linha;

            }
        }
    }

    fclose($arqAluno);

    $arqAluno = fopen("alunos.txt", "w") or die("Erro ao abrir o arquivo");

    fwrite($arqAluno, $alunos);

    fclose($arqAluno);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Excluir Aluno</title>

</head>

<body>

    <h1>Excluir Aluno</h1>

    <?php if ($msg == "") { ?>

        <p>Confira os dados do aluno antes de excluir:</p>

        <p>Nome: <?php echo $nome; ?></p>

        <p>Matrícula: <?php echo $matricula; ?></p>

        <p>Email: <?php echo $email; ?></p>

        <p>CPF: <?php echo $cpf; ?></p>

        <form method="POST">

            <input type="hidden" name="matricula" value="<?php echo $matricula; ?>">

            <input type="submit" value="Confirmar exclusão">

        </form>

    <?php } ?>

    <p><?php echo $msg; ?></p>

    <br>

<a href="listar_alunos.php">Voltar para a lista de alunos</a>

</body>
</html>
