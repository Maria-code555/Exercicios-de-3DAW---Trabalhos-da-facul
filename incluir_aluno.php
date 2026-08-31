<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $email = $_POST["email"];
    $cpf = $_POST["cpf"];

    $msg = "";

    if (!file_exists("alunos.txt")) {

        $arqAluno = fopen("alunos.txt", "w") or die("Erro ao criar!");

        $linha = "nome;matricula;email;cpf\n";

        fwrite($arqAluno, $linha);

        fclose($arqAluno);
    }

    $arqAluno = fopen("alunos.txt", "a") or die("erro ao criar");

    $linha = $nome . ";" . $matricula . ";" . $email . ";" . $cpf . "\n";

    fwrite($arqAluno, $linha);

    fclose($arqAluno);

    $msg = "Aluna(o) incluido com sucesso! 💗";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Incluir Aluno</title>
</head>

<body>
        <h1>Incluir Aluno</h1>

        <p class="subtitulo">
            Preencha os dados do aluno
        </p>

        <form action="incluir_aluno.php" method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>

        <br><br>

        <label for="matricula">Matrícula:</label>
        <input type="number" name="matricula" required>

        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" required>

        <br><br>

        <label for="cpf">CPF:</label>
        <input type="number" name="cpf" required>

        <br><br>

        <input type="submit" value="incluir Aluno">

        </form>   
        <p><?php echo $msg; ?></p>

</body>
</html>
