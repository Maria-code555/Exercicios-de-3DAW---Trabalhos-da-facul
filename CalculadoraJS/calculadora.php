<?php
//informando q a resposta será em json
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //recebendo os dados do js
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

    //devolvendo o resultado em formato json
    echo json_encode(["resultado" => $resultado]);

}

?>
