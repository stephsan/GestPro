<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationPCA extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='evaluation_pcas';
    public function critere(){
        return $this->belongsTo(GrilleEvalPca::class,'grilleeval_id');
    }
}
