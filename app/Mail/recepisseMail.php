<?php

namespace App\Mail;

use App\Models\Preprojet;
use App\Models\PreprojetPe;
use App\Models\Promoteur;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use PDF;

class recepisseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $id_promoteur;
    public $programme_type;
    public function __construct($id, $programme)
    {
        $this->id_promoteur = $id;
        $this->programme_type = $programme;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $id_promo = $this->id_promoteur;
        $programme = $this->programme_type;
        $promoteur= Promoteur::where("id", $id_promo)->first();
        if($this->programme_type=='FP'){
           $preprojet= Preprojet::where("promoteur_id", $promoteur->id)->orderBy('created_at','desc')->first();
        }
        else{
           $preprojet= PreprojetPe::where("promoteur_id", $promoteur->id)->orderBy('created_at','desc')->first();
        }
       // dd($preprojet);
        //$entreprise= Entreprise::where("code_promoteur", $promoteur->code_promoteur)->orderBy('created_at','desc')->first();
        $data["email"] = $promoteur->email_promoteur;
        $this->email= $promoteur->email_promoteur;
        $qrcode =  base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate("Ceci est un recepissé généré par la plateforme de gestion des bénéficiaires du projet ECOTEC"."Code didentification:"." ".$promoteur->code_promoteur."_".$promoteur->id."ECOTEC"));
        $pdf = PDF::loadView('pdf.recepisse', compact('programme','promoteur','preprojet','qrcode'));
        $details['email'] = $promoteur->email;
        $details['nom'] = $promoteur->nom;
        $details['prenom'] = $promoteur->prenom;
        return $this->view('recepisse',compact('details','programme'))->attachData($pdf->output(), "recépissé.pdf");
    }
}
