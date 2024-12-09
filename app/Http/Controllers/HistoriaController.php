<?php

namespace App\Http\Controllers;

use App\Models\AntecedenteMedico;
use App\Models\DatosSocioeconomico;
use App\Models\HistoriaClinica;
use App\Models\HistoriaDesarrollo;
use App\Models\HistoriaEscolar;
use App\Models\Parentesco;
use App\Models\Paciente;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use PDF; 

class HistoriaController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all();
        $historias = HistoriaClinica::all();
        return view('historias.index', [
            'pacientes' => $pacientes, 
            'historias' => $historias
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
  
        DB::beginTransaction();
        try {
            $datosSocioeconomicos = DatosSocioeconomico::create($request->only([
                'tipo_vivienda', 
                'cantidad_habitaciones', 
                'cantidad_personas', 
                'servecio_agua_potable', 
                'servecio_gas', 
                'servecio_electricidad', 
                'servecio_drenaje', 
                'disponibilidad_internet', 
                'tipo_conexion_internet', 
                'acceso_servcios_publicos', 
                'fuente_ingreso_familiar'
            ]));

            $historiaDesarrollo = HistoriaDesarrollo::create(array_merge($request->only([
                'medicamento_embarazo', 
                'tipo_medicamento', 
                'fumo_embarazo', 
                'cantidad', 
                'alcohol_embarazo', 
                'tipo_alcohol', 
                'cantidad_consumia_alcohol', 
                'droga_embarazo', 
                'tipo_droga', 
                'forceps_parto', 
                'cesarea', 
                'razon_cesarea', 
                'niño_prematuro', 
                'meses_prematuro', 
                'peso_nacer_niño', 
                'complicaciones_nacer', 
                'tipo_complicacion', 
                'problema_alimentacion', 
                'tipo_problema_alimenticio', 
                'problema_dormir', 
                'tipo_problema_dormir', 
                'tranquilo_recien_nacido', 
                'gustaba_cargaran_recien_nacido', 
                'alerta_recien_nacido', 
                'problemas_desarrollo_primeros_años', 
                'cuales_problemas'
            ]), ['datosocioeconomico_id' => $datosSocioeconomicos->id]));

            $antecedenteMedico = AntecedenteMedico::create($request->only([
                'enfermedad_infecciosa', 
                'tipo_enfermedad_infecciosa', 
                'enfermedad_no_infecciosa', 
                'tipo_enfermedad_no_infecciosa', 
                'enfermedad_cronica', 
                'tipo_enfermedad_cronica', 
                'discapacidad', 
                'tipo_discapacidad', 
                'otros'
            ]));

            $historiaEscolar = HistoriaEscolar::create($request->only([
                'escolarizado', 
                'tipo_educaion', 
                'tutoria_terapias', 
                'tutoria_terapias_cuales', 
                'dificultad_lectura', 
                'dificultad_aritmetica', 
                'dificultad_escribir', 
                'agrada_escuela'
            ]));

            foreach ($request->parentescos as $parentescoData) {
                if ($parentescoData['discapacidad'] === 'no') {
                    continue; 
                }
                Parentesco::create(array_merge($parentescoData, [
                    'datosocioeconomico_id' => $datosSocioeconomicos->id
                ]));
            }

            HistoriaClinica::create([
                'paciente_id' => $request->paciente_id,
                'datosocioeconomico_id' => $datosSocioeconomicos->id,
                'historia_desarrollo_id' => $historiaDesarrollo->id,
                'antecedente_medico_id' => $antecedenteMedico->id,
                'historia_escolar_id' => $historiaEscolar->id,
                'codigo' => $request->codigo,
                'referencia' => $request->referencia,
                'especialista_refirio' => $request->especialista_refirio,
                'motivo' => $request->motivo,
            ]);

            DB::commit();
            return response()->json(['success' => 'Datos guardados correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al guardar los datos: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function verHistoria($id, $tipo)
    {
        $historia = HistoriaClinica::obtenerHistoriaCompleta($id);

        if (!$historia) {
            if ($tipo === 'api') {
                return response()->json(['error' => 'Historia clínica no encontrada.'], 404);
            }
            return redirect()->back()->with('error', 'La historia clínica no fue encontrada.');
        }

        // Calcular riesgos
        $riesgoSocial = $this->calcularRiesgoSocial($historia->datosEconomicos);
        $riesgoBiologico = $this->calcularRiesgoBiologico($historia);
        $riesgoGlobal = $this->calcularRiesgoGlobal($riesgoSocial, $riesgoBiologico);

        if ($tipo === 'api') {
            return response()->json([
                'historia' => $historia,
                'riesgoSocial' => $riesgoSocial,
                'riesgoBiologico' => $riesgoBiologico,
                'riesgoGlobal' => $riesgoGlobal,
            ]);
        }

        return view('historia.ver', compact('historia', 'riesgoSocial', 'riesgoBiologico', 'riesgoGlobal'));
    }

    private function calcularRiesgoSocial($datosEconomicos)
    {
        $riesgo = 0;

        // Tipo de vivienda
        $tiposViviendaRiesgo = [
            'unifamiliar' => 1,
            'apartamento' => 1,
            'vivienda social' => 2,
            'precaria' => 3,
        ];
        $riesgo += $tiposViviendaRiesgo[$datosEconomicos->tipo_vivienda] ?? 0;

        // Personas por habitación
        $riesgo += ($datosEconomicos->cantidad_personas > ($datosEconomicos->cantidad_habitaciones + 5)) ? 1 : 0;

        // Servicios básicos
        $serviciosNo = collect([
            $datosEconomicos->servecio_agua_potable,
            $datosEconomicos->servecio_gas,
            $datosEconomicos->servecio_electricidad,
            $datosEconomicos->servecio_drenaje,
            $datosEconomicos->disponibilidad_internet,
        ])->filter(fn($v) => $v === 'no')->count();

        $riesgo += match (true) {
            $serviciosNo >= 3 => 3,
            $serviciosNo === 2 => 2,
            default => 1,
        };

        return $riesgo;
    }

    private function calcularRiesgoBiologico($historia)
    {
        $riesgo = 0;

        // Condiciones familiares
        foreach ($historia->parentescos as $familiar) {
            if ($familiar->discapacidad === 'si') $riesgo += 1;
            if ($familiar->enfermedad_cronica === 'si') $riesgo += 1;
        }

        // Antecedentes médicos
        $antecedentes = $historia->antecedenteMedico;
        $riesgo += collect([
            $antecedentes->enfermedad_infecciosa,
            $antecedentes->enfermedad_no_infecciosa,
            $antecedentes->enfermedad_cronica,
            $antecedentes->discapacidad,
        ])->filter(fn($v) => $v === 'si')->count();

        // Desarrollo infantil
        $desarrollo = $historia->historiaDesarrollo;
        $riesgo += collect([
            $desarrollo->medicamento_embarazo,
            $desarrollo->fumo_embarazo,
            $desarrollo->alcohol_embarazo,
            $desarrollo->droga_embarazo,
        ])->filter(fn($v) => $v === 'si')->count();

        return $riesgo;
    }

    private function calcularRiesgoGlobal($riesgoSocial, $riesgoBiologico)
    {
        $riesgoTotal = $riesgoSocial + $riesgoBiologico;

        return match (true) {
            $riesgoTotal >= 15 => 'alto',
            $riesgoTotal >= 8 => 'medio',
            default => 'bajo',
        };
    }
}
