<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesarrolloGlobal extends Model
{
    use HasFactory;

    protected $fillable = ['prueba','percentil','36-42 meses','43-48 meses','49-54 meses','55-60 meses','61-66 meses','67-78 meses','descripcion'];
}
