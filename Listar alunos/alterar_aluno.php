<?php

$msg = "";
$matricula = "";
$nome = "";
$email = "";
$cpf = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];

    $arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("alunosTemp.txt", "w") or die("Erro ao criar arquivo");

    $linha = fgets($arqAluno);

    fprintf($arqTemp, "%s", $linha);

    while(($linha = fgets($arqAluno)) !== false) {

        $colunaDados = explode(";", $linha);

        if(trim($colunaDados[1]) == $matricula) {

            fprintf($arqTemp, "%s;%s;%s;%s\n",
                $nome,
                $matricula,
                $email,
                $cpf
            );

        } else {

            fprintf($arqTemp, "%s", $linha);

        }
    }

    fclose($arqAluno);
    fclose($arqTemp);


    $arqAluno = fopen("alunos.txt", "w") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("alunosTemp.txt", "r") or die("Erro ao abrir arquivo");

    while(($linha = fgets($arqTemp)) !== false) {

        fprintf($arqAluno, "%s", $linha);

    }

    fclose($arqAluno);
    fclose($arqTemp);

    $msg = "Aluno alterado com sucesso!";

}


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['matricula'])) {

    $matricula = $_GET['matricula'];

    $arqAluno = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

    $linha = fgets($arqAluno);

    while(($linha = fgets($arqAluno)) !== false) {

        $colunaDados = explode(";", $linha);

        if(trim($colunaDados[1]) == $matricula) {

            $nome = trim($colunaDados[0]);
            $email = trim($colunaDados[2]);
            $cpf = trim($colunaDados[3]);

        }
    }

    fclose($arqAluno);

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Alterar Aluno</title>

</head>

<body>

<h1>Alterar Aluno</h1>

<form action="alterar_aluno.php" method="POST">

    <label>Matrícula:</label>

    <input type="number" name="matricula" value="<?php echo $matricula; ?>" readonly>

    <br><br>

    <label>Nome:</label>

    <input type="text" name="nome" value="<?php echo $nome; ?>" required>

    <br><br>

    <label>Email:</label>

    <input type="text" name="email" value="<?php echo $email; ?>" required>

    <br><br>

    <label>CPF:</label>

    <input type="text" name="cpf" value="<?php echo $cpf; ?>" required>

    <br><br>

    <input type="submit" value="Confirmar alteração">

</form>

<p><?php echo $msg; ?></p>

<br>

<a href="listar_alunos.php">Voltar para a lista de alunos</a>

<br><br>

<a href="incluir_aluno.php">Voltar para incluir aluno</a>

</body>
</html>