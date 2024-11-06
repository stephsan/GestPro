<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestissementProjet extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function projet(){
        return $this->belongsTo(Preprojet::class);
    }
}
