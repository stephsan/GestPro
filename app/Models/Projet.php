<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function preprojet(){
        return $this->belongsTo(Preprojet::class);
    }
    public function investissements(){
        return $this->hasMany(InvestissementProjet::class);
    }
    public function investissementvalides(){
        return $this->hasMany(InvestissementProjet::class)->where('statut', 'valide');
    }
    protected static function boot(){
        parent::boot();
        static::creating(function($projet){
            $projet->slug= 'PRJ'.$projet->preprojet->num_projet.$projet->id;
  
        });
    }
       public function getRouteKeyName()
      {
          return 'slug';
      }
}
