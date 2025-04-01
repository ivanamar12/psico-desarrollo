<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum Role: string
{
    use BaseEnum;

    case ADMIN = 'ADMIN';
    case ESPECIALISTA = 'ESPECIALISTA';
    case SECRETARIA = 'SECRETARIA';
    case BLOQUEADO = 'BLOQUEADO'; // Nuevo rol

    public static function translation()
    {
        return [
            'ADMIN' => 'ADMIN',
            'ESPECIALISTA' => 'ESPECIALISTA',
            'SECRETARIA' => 'SECRETARIA',
            'BLOQUEADO' => 'BLOQUEADO', // Nueva traducción
        ];
    }

    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'ADMIN',
            static::ESPECIALISTA => 'ESPECIALISTA',
            static::SECRETARIA => 'SECRETARIA',
            static::BLOQUEADO => 'BLOQUEADO', // Nuevo label
        };
    }
}