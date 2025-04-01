<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Cita;
use Carbon\Carbon;
use App\Notifications\CitasDelDiaNotification;
use App\Notifications\CitasEspecialistaNotification;

class NotificarCitas extends Command
{
    protected $signature = 'notificar:citas';
    protected $description = 'Notificar a secretarias y especialistas sobre las citas del día';

    public function handle()
    {
        $hoy = Carbon::today();
        $citas = Cita::whereDate('fecha', $hoy)->get();

        $secretarias = User::role('secretaria')->get();
        foreach ($secretarias as $secretaria) {
            $secretaria->notify(new CitasDelDiaNotification($citas));
        }

        $especialistas = User::role('especialista')->get();
        foreach ($especialistas as $especialista) {
            $citasEspecialista = $citas->where('especialista_id', $especialista->id);
            if ($citasEspecialista->count() > 0) {
                $especialista->notify(new CitasEspecialistaNotification($citasEspecialista));
            }
        }
    }
}
