<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\SubEscala;

class BenderItemsSeeder extends Seeder
{
    public function run()
    {
        $figuraA = SubEscala::where('sub_escala', 'Figura A')->first();

        if ($figuraA) {
            Item::create(['sub_escala_id' => $figuraA->id, 'item' => 'Distorsión de la forma (Una u otra forma excesivamente distorsionada)']);
            Item::create(['sub_escala_id' => $figuraA->id, 'item' => 'Distorsión de la forma (Tamaño desproporcionado uno, dos o mas veces)']);
            Item::create(['sub_escala_id' => $figuraA->id, 'item' => 'Rotación (45° o más)']);
            Item::create(['sub_escala_id' => $figuraA->id, 'item' => 'Integración (Figuras no unidas)']);
        }

        $figura1 = SubEscala::where('sub_escala', 'Figura 1')->first();

        if ($figura1) {
            Item::create(['sub_escala_id' => $figura1->id, 'item' => 'Distorsión de la forma (5 o más circulos)']);
            Item::create(['sub_escala_id' => $figura1->id, 'item' => 'Rotación (45° o más)']);
            Item::create(['sub_escala_id' => $figura1->id, 'item' => 'Integración (+ de 15 puntos)']);
            Item::create(['sub_escala_id' => $figura1->id, 'item' => 'Item significativo ( aucencia o angulo extra)']);
        }

        $figura2 = SubEscala::where('sub_escala', 'Figura 2')->first();

        if ($figura2) {
            Item::create(['sub_escala_id' => $figura2->id, 'item' => 'Rotación (45° o más)']);
            Item::create(['sub_escala_id' => $figura2->id, 'item' => 'Integración (Filas omitidas o agregdas)']);
            Item::create(['sub_escala_id' => $figura2->id, 'item' => 'Perseverancia (más de 14 columnas)']);
        }

        $figura3 = SubEscala::where('sub_escala', 'Figura 3')->first();

        if ($figura3) {
            Item::create(['sub_escala_id' => $figura3->id, 'item' => 'Distorsión de la forma (5 o más circulos)']);
            Item::create(['sub_escala_id' => $figura3->id, 'item' => 'Rotación (45° o más)']);
            Item::create(['sub_escala_id' => $figura3->id, 'item' => 'Integración (Perdida de la forma)']);
            Item::create(['sub_escala_id' => $figura3->id, 'item' => 'Integración (Lineas en vez de puntos)']);
        }

        $figura4 = SubEscala::where('sub_escala', 'Figura 4')->first();

        if ($figura4) {
            Item::create(['sub_escala_id' => $figura4->id, 'item' => 'Rotación (45° o más)']);
            Item::create(['sub_escala_id' => $figura4->id, 'item' => '1/8 de pulgada o más entr las figuras']);
        }

        $figura5 = SubEscala::where('sub_escala', 'Figura 5')->first();

        if ($figura5) {
        	Item::create(['sub_escala_id' => $figura5->id, 'item' => 'Distorsión de la forma (5 o más circulos)']);
            Item::create(['sub_escala_id' => $figura5->id, 'item' => 'Rotación (45° o más)']);
           	Item::create(['sub_escala_id' => $figura5->id, 'item' => 'Integración (Perdida de la forma)']);
            Item::create(['sub_escala_id' => $figura5->id, 'item' => 'Integración (Lineas en vez de puntos)']);
        }

        $figura6 = SubEscala::where('sub_escala', 'Figura 6')->first();

        if ($figura6) {
        	Item::create(['sub_escala_id' => $figura6->id, 'item' => 'Distorsión de la forma (30 o más angulos)']);
            Item::create(['sub_escala_id' => $figura6->id, 'item' => 'Distorsión de la forma (ausencia de curvas y lineas rectas)']);
           	Item::create(['sub_escala_id' => $figura6->id, 'item' => 'Integración (ausencia de cruces)']);
            Item::create(['sub_escala_id' => $figura6->id, 'item' => 'Persiverancia (6 o más curvas)']);
        }

		$figura7 = SubEscala::where('sub_escala', 'Figura 7')->first();

        if ($figura7) {
        	Item::create(['sub_escala_id' => $figura7->id, 'item' => 'Distorsión de la forma (Tamaño desproporcionado uno más grande que el otro)']);
            Item::create(['sub_escala_id' => $figura7->id, 'item' => 'Distorsión de la forma (perdida de la forma del hexagono; perdida de angulos extras)']);
           	Item::create(['sub_escala_id' => $figura7->id, 'item' => 'Rotación (45° o más)']);
            Item::create(['sub_escala_id' => $figura7->id, 'item' => 'Integración (ausencia o exceso de superposición)']);
        }

        $figura8 = SubEscala::where('sub_escala', 'Figura 8')->first();

        if ($figura8) {
        	Item::create(['sub_escala_id' => $figura8->id, 'item' => 'Distorsión de la forma (Perdida de la forma de cualquiera de las figuras, angulos extras o ausentes; distante omitido)']);
            Item::create(['sub_escala_id' => $figura8->id, 'item' => 'Rotación (45° o más)']);
        }
    }
}

