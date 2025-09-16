<?php

namespace App\Services;

use App\Models\HistoriaClinica;

class RiesgoService
{
  // Pesos para cada factor de riesgo social
  private $pesosSocial = [
    'tipo_vivienda' => [
      'casa_unifamiliar' => 1,
      'apartamento' => 1,
      'vivienda social' => 2,
      'precaria' => 3,
    ],
    'hacinamiento' => 1, // por cada persona extra
    'servicios_basicos' => [
      'falta_1' => 1,
      'falta_2' => 2,
      'falta_3_o_mas' => 3,
    ],
  ];

  // Pesos para cada factor de riesgo biológico
  private $pesosBiologico = [
    'consumo_sustancias' => [
      'medicamento_embarazo' => 1,
      'fumo_embarazo' => 2,
      'alcohol_embarazo' => 3,
      'droga_embarazo' => 4,
    ],
    'antecedentes_familiares' => [
      'discapacidad' => 1,
      'enfermedad_cronica' => 2,
    ],
    'antecedentes_personales' => [
      'enfermedad_infecciosa' => 1,
      'enfermedad_no_infecciosa' => 1,
      'enfermedad_cronica' => 2,
      'discapacidad' => 2,
    ],
  ];

  public function calcularRiesgoSocial($datosEconomico)
  {
    $riesgo = 0;

    // Tipo de vivienda
    $riesgo += $this->pesosSocial['tipo_vivienda'][$datosEconomico->tipo_vivienda] ?? 0;

    // Hacinamiento
    $hacinamiento = $datosEconomico->cantidad_personas - ($datosEconomico->cantidad_habitaciones + 1);
    if ($hacinamiento > 0) {
      $riesgo += $hacinamiento * $this->pesosSocial['hacinamiento'];
    }

    // Servicios básicos
    $serviciosNo = collect([
      $datosEconomico->servecio_agua_potable,
      $datosEconomico->servecio_gas,
      $datosEconomico->servecio_electricidad,
      $datosEconomico->servecio_drenaje,
      $datosEconomico->disponibilidad_internet,
    ])->filter(fn($v) => $v === 'no')->count();

    if ($serviciosNo >= 3) {
      $riesgo += $this->pesosSocial['servicios_basicos']['falta_3_o_mas'];
    } elseif ($serviciosNo === 2) {
      $riesgo += $this->pesosSocial['servicios_basicos']['falta_2'];
    } elseif ($serviciosNo === 1) {
      $riesgo += $this->pesosSocial['servicios_basicos']['falta_1'];
    }

    return $this->normalizar($riesgo, 0, 10); // Normalizar a escala 0-10
  }

  public function calcularRiesgoBiologico($historia)
  {
    $riesgo = 0;

    // Antecedentes familiares
    if ($historia->parentescos) {
      foreach ($historia->parentescos as $familiar) {
        if ($familiar->discapacidad === 'si') {
          $riesgo += $this->pesosBiologico['antecedentes_familiares']['discapacidad'];
        }
        if ($familiar->enfermedad_cronica === 'si') {
          $riesgo += $this->pesosBiologico['antecedentes_familiares']['enfermedad_cronica'];
        }
      }
    }

    // Antecedentes personales
    $antecedentes = $historia->antecedenteMedico;
    if ($antecedentes) {
      foreach ($this->pesosBiologico['antecedentes_personales'] as $key => $peso) {
        if ($antecedentes->$key === 'si') {
          $riesgo += $peso;
        }
      }
    }

    // Desarrollo
    $desarrollo = $historia->historiaDesarrollo;
    if ($desarrollo) {
      foreach ($this->pesosBiologico['consumo_sustancias'] as $key => $peso) {
        if ($desarrollo->$key === 'si') {
          $riesgo += $peso;
        }
      }
    }

    return $this->normalizar($riesgo, 0, 15); // Suponiendo máximo teórico de 15
  }

  public function calcularRiesgoGlobal($riesgoSocial, $riesgoBiologico)
  {
    $total = ($riesgoSocial + $riesgoBiologico) / 2; // Promedio ponderado

    return match (true) {
      $total >= 7 => 'alto',
      $total >= 4 => 'medio',
      default => 'bajo',
    };
  }

  private function normalizar($valor, $min, $max)
  {
    return max(0, min(10, round(($valor / $max) * 10)));
  }
}
