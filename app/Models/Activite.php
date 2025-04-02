<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function composante(){
        return $this->belongsTo(Projet::class);
    }
    public function realisations() {
        return $this->hasMany(Realisation::class);
    }
    

    public function getLastTauxPhysiqueAttribute() {
        return $this->realisations()->latest('annee')->value('taux_physique') ?? 0;
    }
    public function getLastTauxFinancierAttribute() {
        return $this->realisations()->latest('annee')->value('taux_financier') ?? 0;
    }
    public function getLastTauxDecaissementAttribute() {
        return $this->realisations()->latest('annee')->value('taux_decaissement') ?? 0;
    }
    public function getLastDelaisConsommeAttribute() {
        return $this->realisations()->latest('annee')->value('delais_consomme') ?? 0;
    }
    public function getLastCiblePrevuAttribute() {
        return $this->realisations()->latest('annee')->value('cible_prevu') ?? 0;
    }
    public function getLastCibleRealiseAttribute() {
        return $this->realisations()->latest('annee')->value('cible_realise') ?? 0;
    }
    public function getLastTauxCibleAttribute() {
        return $this->realisations()->latest('annee')->value('taux_cible') ?? 0;
    }
   
}
