<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preprojet extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function projet(){
        return $this->belongsTo(projet::class,'preprojet_id');
    }
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
    }
    public function effectif_previsionnels(){
        return $this->hasMany(Infoeffectifentreprise::class,'preprojet_id');
    }
    public function evaluations(){
        return $this->hasMany(Evaluation::class,'preprojet_id');
    }
    public function historiques(){
        return $this->hasMany(HistoriquePreprojet::class,'preprojet_id');
    }
    
    protected static function boot(){
        parent::boot();
        static::creating(function($preprojet){
            $preprojet->slug= $preprojet->num_projet;
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
                 'source' => 'num_projet'
             ]
         ];
     }
    public function innovations(){
        return $this->hasMany(InnovationProjet::class);
   }
   public function promoteur(){
    return $this->belongsTo(Promoteur::class);
}
}
