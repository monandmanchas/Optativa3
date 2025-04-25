<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../calculo.php';

class CalculoTest extends TestCase
{
    public function test_calculo_tiempo_completo()
{
    $resultado = calcular_pago("Tiempo Completo", 100, 10, 5, 5);

    $this->assertEqualsWithDelta(541666.67, $resultado["Pago Ordinario"], 0.01);
    $this->assertEqualsWithDelta(73125.00, $resultado["Pago Nocturno"], 0.01);
    $this->assertEqualsWithDelta(47395.83, $resultado["Pago Dominical"], 0.01);
    $this->assertEqualsWithDelta(47395.83, $resultado["Pago Festivo"], 0.01);
    $this->assertEqualsWithDelta(709583.33, $resultado["Total Devengado"], 0.01);
    $this->assertEqualsWithDelta(56766.67, $resultado["Descuento Seguridad Social"], 0.01);
    $this->assertEqualsWithDelta(326408.34, $resultado["Total a Pagar"], 0.01);
}

public function test_calculo_medio_tiempo()
{
    $resultado = calcular_pago("Medio Tiempo", 100, 10, 5, 5);

    $this->assertEqualsWithDelta(270833.33, $resultado["Pago Ordinario"], 0.01);
    $this->assertEqualsWithDelta(36562.50, $resultado["Pago Nocturno"], 0.01);
    $this->assertEqualsWithDelta(23697.92, $resultado["Pago Dominical"], 0.01);
    $this->assertEqualsWithDelta(23697.92, $resultado["Pago Festivo"], 0.01);
    $this->assertEqualsWithDelta(354791.67, $resultado["Total Devengado"], 0.01);
    $this->assertEqualsWithDelta(28383.33, $resultado["Descuento Seguridad Social"], 0.01);
    $this->assertEqualsWithDelta(326408.34, $resultado["Total a Pagar"], 0.01);
}

}
