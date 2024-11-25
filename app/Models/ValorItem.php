<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorItem extends Model
{
    use HasFactory;

    protected $fillable = ['valor', 'interpretacion', 'item_prueba_id'];

    public function itemPrueba(){

        return $this->belongsTo(ItemPrueba::class);
        
    }
}
