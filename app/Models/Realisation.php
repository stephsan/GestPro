<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function activite(){
        return $this->belongsTo(Activite::class);
    }
}
