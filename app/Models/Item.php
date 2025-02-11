<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['sub_escala_id', 'item'];

    public function SubEscala(){

        return $this->belongsTo(SubEscala::class);
        
    }
}
