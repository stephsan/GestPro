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
    public function composantes(){
        return $this->hasMany(Composante::class,'projet_id');
    }
    public function getTauxPhysiqueAttribute() {
        return round($this->composantes->avg('taux_physique'), 2);
    }
    public function getTauxFinancierAttribute() {
        return round($this->composantes->avg('taux_financier'), 2);
    }
    public function getTauxDecaissementAttribute() {
        return round($this->composantes->avg('taux_decaissement'), 2);
    }
   
   
    protected static function boot(){
        parent::boot();
        static::creating(function($projet){
            $projet->slug= 'PRJ00'.$projet->code_projet;
  
        });
    }

    public function sluggable(): array
     {
         return [
             'slug' => [
                 'source' => 'code_projet'
             ]
         ];
     }
       public function getRouteKeyName()
      {
          return 'slug';
      }
}
