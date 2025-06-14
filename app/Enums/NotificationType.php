<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum NotificationType: string
{
  use BaseEnum;

  case MENSAJES = 'MENSAJES';
  case SEGURIDAD = 'SEGURIDAD';
  case SISTEMA = 'SISTEMA';
}
