<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infoeffectifentreprise extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function valeur(){
        return $this->belongsTo(Valeur::class);
    }
}
