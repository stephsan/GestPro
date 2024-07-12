<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preprojet extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function entreprise(){
        return $this->belongsTo(Entreprise::class);
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
}
