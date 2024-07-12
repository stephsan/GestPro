<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promoteur extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function piecejointes(){
        return $this->hasMany(Piecejointe::class, 'promotrice_id');
    }
    public function entreprises(){
        return $this->hasMany(Entreprise::class,'promotrice_id');
    }
    // public function entreprise_formes(){
    //     return $this->hasMany(Entreprise::class,'promotrice_id')->where('participer_a_la_formation', 1);
    // }
    //changer la clé id par une autre dans le cas présent il sera remplacé par slug
    protected static function boot(){
        parent::boot();
        static::creating(function($promoteur){
            $promoteur->slug= $promoteur->code_promoteur;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

     public function sluggable(): array
     {
         return [
             'slug' => [
                 'source' => 'code_promoteur'
             ]
         ];
     }
}
