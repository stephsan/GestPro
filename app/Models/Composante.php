<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composante extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function activites(){
        return $this->hasMany(Activite::class);
    }
    public function projet(){
        return $this->belongsTo(Projet::class);
    }
    public function getTauxPhysiqueAttribute() {
        $totalPoids = $this->activites->count();
        if ($totalPoids == 0) return 0; 
        return round(
            $this->activites->sum('last_taux_physique')/$totalPoids, 
            2
        );
    }
    public function getTauxFinancierAttribute() {
        $totalPoids = $this->activites->count();
        if ($totalPoids == 0) return 0; 
        return round(
            $this->activites->sum('last_taux_financier')/$totalPoids, 
            2
        );
    }
    public function getTauxDecaissementAttribute() {
        $totalPoids = $this->activites->count();
        if ($totalPoids == 0) return 0; 
        return round(
            $this->activites->sum('last_taux_decaissement')/$totalPoids, 
            2
        );
    }
    public function getDelaisConsommeAttribute() {
        $totalPoids = $this->activites->count();
        if ($totalPoids == 0) return 0; 
        return round(
            $this->activites->sum('last_delais_consomme')/$totalPoids, 
            2
        );
    }
    public function getCiblePrevuAttribute() {
        $totalPoids = $this->activites->count();
        if ($totalPoids == 0) return 0; 
        return round(
            $this->activites->sum('last_cible_prevu')/$totalPoids, 
            2
        );
    }
    public function getCibleRealiseAttribute() {
        $totalPoids = $this->activites->count();
        if ($totalPoids == 0) return 0; 
        return round(
            $this->activites->sum('last_cible_realise')/$totalPoids, 
            2
        );
    }
    public function getTauxCibleAttribute() {
        $totalPoids = $this->activites->count();
        if ($totalPoids == 0) return 0; 
        return round(
            $this->activites->sum('last_taux_cible')/$totalPoids, 
            2
        );
    }
   
    // public function getTauxFinancierAttribute() {
    //     //$totalPoids = $this->activites->sum('poids');
    //     $totalPoids = $this->activites->count();
    //     return round(
    //         $this->activites->sum(fn($act) => $act->taux_financier)/$this->activites->count(), 
    //         2
    //     );
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'code_composante'
            ]
        ];
    }
    protected static function boot(){
        parent::boot();
        static::creating(function($composante){
            $composante->slug= 'CPT00'.$composante->code_composante;
        });
    }
       public function getRouteKeyName()
      {
          return 'slug';
      }
}
