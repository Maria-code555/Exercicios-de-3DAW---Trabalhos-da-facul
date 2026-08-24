<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $op = $_POST["operacao"];

    switch ($op) {

        case "+":
            $resultado = $num1 + $num2;
            break;

        case "-":
            $resultado = $num1 - $num2;
            break;

        case "*":
            $resultado = $num1 * $num2;
            break;

        case "/":
            if ($num2 != 0) {
                $resultado = $num1 / $num2;
            } else {
                $resultado = "Não é possível dividir por zero.";
            }
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Calculadora</title>

</head>

<body>

    <h1>Calculadora</h1>

    <form action="calculadora.php" method="POST">

        <label>Primeiro número:</label>

        <input type="number" name="num1" required>

        <br><br>

        <label>Segundo número:</label>

        <input type="number" name="num2" required>

        <br><br>

        <label>Operação:</label>

        <select name="operacao">

            <option value="+">Soma (+)</option>
            <option value="-">Subtração (-)</option>
            <option value="*">Multiplicação (*)</option>
            <option value="/">Divisão (/)</option>

        </select>

        <br><br>

        <input type="submit" value="Calcular">

    </form>

    <?php echo "<h2>Resultado: $resultado</h2>"; ?>

</body>

</html>