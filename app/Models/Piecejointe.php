<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piecejointe extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function promotrice(){
        return $this->belongsTo(Promotrice::class);
    }
}

