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
