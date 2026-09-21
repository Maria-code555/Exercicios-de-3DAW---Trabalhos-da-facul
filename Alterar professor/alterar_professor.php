<?php

$msg = "";
$matricula = "";
$nome = "";
$endereco = "";
$cpf = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') { //(POST) altera os dados

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $endereco = $_POST["endereco"];
    $cpf = $_POST["cpf"];

    $arqprof = fopen("prof.txt", "r") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("profTemp.txt", "w") or die("Erro ao criar arquivo"); //arquivo temporario para alterar os dados

    $linha = fgets($arqprof);

    fprintf($arqTemp, "%s", $linha); //escreve dentro do arquivo

    while(!feof($arqprof)) {

        $linha = fgets($arqprof);

        $colunaDados = explode(";", $linha); //coluna das informações

        if($colunaDados[0] == $matricula) {

            fprintf($arqTemp, "%s;%s;%s;%s\n",$matricula,$nome,$cpf,$endereco);

        } else {

            fprintf($arqTemp, "%s", $linha);

        }
    }

    fclose($arqprof);
    fclose($arqTemp);


    $arqprof = fopen("prof.txt", "w") or die("Erro ao abrir arquivo");

    $arqTemp = fopen("profTemp.txt", "r") or die("Erro ao abrir arquivo");

    while(!feof($arqTemp)) {

        $linha = fgets($arqTemp);

        fprintf($arqprof, "%s", $linha);

    }

    fclose($arqprof);
    fclose($arqTemp);

    $msg = "Professor alterado com sucesso!";

}


if($_SERVER['REQUEST_METHOD'] == 'GET') { //(GET)colocar as informações do professor

    $matricula = $_GET["matricula"];

    $arqprof = fopen("prof.txt", "r") or die("Erro ao abrir arquivo");

    $linha = fgets($arqprof);

    while(!feof($arqprof)) {

        $linha = fgets($arqprof);

        $colunaDados = explode(";", $linha);

        if($colunaDados[0] == $matricula) {//((TRIM))tira espaços em branco do começo e do final de um texto

            $nome = $colunaDados[1];
            $cpf = $colunaDados[2];
            $endereco = $colunaDados[3];

            break;
        }
    }

    fclose($arqprof);

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Professor</title>
</head>

<body>

    <form action="alterar_professor.php" method="POST">

        <h3>Insira as informações para alterar Professor</h3> 
        <br>

        Matricula
        <input type="number" name="matricula" id="matricula" value="<?php echo $matricula ?>">
        <br><br>

        Nome
        <input type="text" name="nome" id="nome" value="<?php echo $nome ?>">
        <br><br>

        CPF
        <input type="text" name="cpf" id="cpf" value="<?php echo $cpf ?>">
        <br><br>

        Endereço
        <input type="text" name="endereco" id="endereco" value="<?php echo $endereco ?>">
        <br><br>

        <input type="submit" value="Confirmar alteração">

    </form>

    <?php echo " $msg";?>

    <br>    

    <a href="listarProfessor.php">Voltar para a listagem de professores</a>

</body>

</html>
