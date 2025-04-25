<?php
function calcular_pago($tipo_contrato, $horas_ordinarias, $horas_nocturnas, $horas_dominicales, $horas_festivas) {
    $SMMLV = 1300000;
    $HORAS_MENSUALES = 240;
    $valor_hora = $SMMLV / $HORAS_MENSUALES;

    if (strtolower($tipo_contrato) == "medio tiempo") {
        $valor_hora /= 2;
    }

    $recargo_nocturno = $valor_hora * 0.35;
    $recargo_dominical = $valor_hora * 0.75;
    $recargo_festivo = $valor_hora * 0.75;

    $pago_ordinario = $horas_ordinarias * $valor_hora;
    $pago_nocturno = $horas_nocturnas * ($valor_hora + $recargo_nocturno);
    $pago_dominical = $horas_dominicales * ($valor_hora + $recargo_dominical);
    $pago_festivo = $horas_festivas * ($valor_hora + $recargo_festivo);

    $total_devengado = $pago_ordinario + $pago_nocturno + $pago_dominical + $pago_festivo;
    $descuento_seguridad = $total_devengado * 0.08;
    $total_pagar = $total_devengado - $descuento_seguridad;

    return [
        "Pago Ordinario" => round($pago_ordinario, 2),
        "Pago Nocturno" => round($pago_nocturno, 2),
        "Pago Dominical" => round($pago_dominical, 2),
        "Pago Festivo" => round($pago_festivo, 2),
        "Total Devengado" => round($total_devengado, 2),
        "Descuento Seguridad Social" => round($descuento_seguridad, 2),
        "Total a Pagar" => round($total_pagar, 2)
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cálculo de Pago</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>Formulario de Cálculo de Pago</h2>
    <form method="POST">
        <label for="tipo">Tipo de Contrato:</label>
        <select name="tipo" required>
            <option value="Tiempo Completo">Tiempo Completo</option>
            <option value="Medio Tiempo">Medio Tiempo</option>
        </select>

        <label>Horas Ordinarias:</label>
        <input type="number" name="horas_ordinarias" required>

        <label>Horas Nocturnas:</label>
        <input type="number" name="horas_nocturnas" required>

        <label>Horas Dominicales:</label>
        <input type="number" name="horas_dominicales" required>

        <label>Horas Festivas:</label>
        <input type="number" name="horas_festivas" required>

        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tipo = $_POST["tipo"];
        $horas_ordinarias = $_POST["horas_ordinarias"];
        $horas_nocturnas = $_POST["horas_nocturnas"];
        $horas_dominicales = $_POST["horas_dominicales"];
        $horas_festivas = $_POST["horas_festivas"];

        $resultado = calcular_pago($tipo, $horas_ordinarias, $horas_nocturnas, $horas_dominicales, $horas_festivas);

        echo "<h3>Resultados:</h3><ul>";
        foreach ($resultado as $clave => $valor) {
            echo "<li><strong>$clave:</strong> $" . number_format($valor, 2, ',', '.') . "</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
