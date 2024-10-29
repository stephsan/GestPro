@extends('layouts/base')
@section('title')
@section('dashboard_fp', 'active')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Tableau de bord du fond de partenariat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-dark">Accueil</li>
                <li class="breadcrumb-item active text-dark">Tableau de bord</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h3 >{{ $preprojet_soumis->count() }}</h3>
                    Avant-projets Enregistrés
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer block1" onclick="change_details('avant_projets_soumis','projets_soumis','financement','impacts')">Plus de détails</a>

            </div>
                
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h3 >0</h3>
                    Projets soumis
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer block2" onclick="change_details('projets_soumis','avant_projets_soumis','financement','impacts')">Plus de détails</a>
            </div>
                
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h3 > 0 </h3>
                    Financement accordé
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer block3" onclick="change_details('financement','avant_projets_soumis','projets_soumis','impacts')">Plus de détails</a>

            </div>
                
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h3 >0</h3>
                    Impacts
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer block4" onclick="change_details('impacts','avant_projets_soumis','projets_soumis','financement')">Plus de détails</a>

            </div>
                
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 offset-0 ">
                <div class="card mt-2">
                    <div class="card-body">
                    <div class="row" id="avant_projets_soumis">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="dash-block">
                                    <div class="dash-block-title">
                                        <h2 class="dash-compteur">
                                            Avants-projets MPMEs Existantes
                                        </h2>
                                    </div>
                                   <div class="themed-background-muted-light">
                                        <a href="javascript:void(0)" onclick="graphiquedynamique('mpme', 'soumis');"  class="widget widget-hover-effect2 themed-background-muted-light">
                                            <h4 class="text-left compteur">
                                                    <strong class="text-danger">{{ $preprojet_soumis->count() }}</strong>
                                                    <br>
                                                    <small>
                                                        Avants-projets Enregistrés
                                                    </small>
                                            </h4>
                                        </a>
                                   </div>
                                   
                                   <div class="themed-background-muted-light">
                                        <a href="javascript:void(0)" onclick="graphiquedynamique('mpme', 'eligible');"  class="widget widget-hover-effect2 themed-background-muted-light">
                                                <h4 class="text-left compteur">
                                                        <strong class="text-danger">{{ $nombre_de_preprojet_eligible }}</strong>
                                                        <br>
                                                        <small>
                                                        Avant-projets Eligibles
                                                        </small>
                                                </h4>
                                        </a>
                                    </div>
                                    <div class="themed-background-muted-light">
                                        <a href="javascript:void(0)" onclick="graphiquedynamique('mpme', 'selectionne');"  class="widget widget-hover-effect2 themed-background-muted-light">
                                        <h4 class="text-left compteur">
                                                <strong class="text-danger">{{ $nombre_de_preprojet_selectionne }}</strong>
                                                <br>
                                                <small>
                                                   Avant-projets préselectionnés par le comité
                                                </small>
                                        </h4>
                                        </a>
                                    </div>
                                    <div class="themed-background-muted-light">
                                        <a href="javascript:void(0)" onclick="graphiquedynamique_money('mpme', 'soumis');"  class="widget widget-hover-effect2 themed-background-muted-light">
                                        <h4 class="text-left compteur">
                                                <strong class="text-danger">{{ format_prix($preprojet_soumis->sum('cout_total')) }}</strong>
                                                <br>
                                                <small>
                                                    Montant total des projets soumis
                                                 </small>
                                        </h4>
                                        </a>
                                    </div>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dash-block">
                                    <div class="dash-block-title">
                                        <h2 class="dash-compteur">
                                            Avants-projets Startup
                                        </h2>
                                    </div>
                                    <div class="themed-background-muted-light">
                                        <h4 class="text-left compteur">
                                                <strong class="text-danger">0</strong>
                                                <br>
                                                <small>
                                                   Avant-projets Enregistrés
                                                </small>
                                        </h4>
                                        </div>
                                        <div class="themed-background-muted-light">
                                            <h4 class="text-left compteur">
                                                    <strong class="text-danger">0</strong>
                                                    <br>
                                                    <small>
                                                        Avant-projets Eligibles
                                                    </small>
                                            </h4>
                                        </div>
                                        <div class="themed-background-muted-light">
                                            <h4 class="text-left compteur">
                                                    <strong class="text-danger">0</strong>
                                                    <br>
                                                    <small>
                                                        Avant-projets préselectionnés par le comité
                                                    </small>
                                            </h4>
                                        </div>
                                        <div class="themed-background-muted-light">
                                            <a href="javascript:void(0)" onclick="graphiquedynamique_money('startup', 'soumis');"  class="widget widget-hover-effect2 themed-background-muted-light">
                                            <h4 class="text-left compteur">
                                                    <strong class="text-danger">0</strong>
                                                    <br>
                                                    <small>
                                                       Montant total des projets soumis 
                                                    </small>
                                            </h4>
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                            </div>
                             <div class="row">
                                <div id="preprojet_par_region_par_sexe" style="margin-top: 10px;">
                                    test
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6" id="preprojet_par_region">
        
                                    </div>
                                    <div class="col-md-6" id="preprojet_par_secteur_dactivite">
        
                                    </div>
                                    
                                </div>
                                <hr>
                                    
                                    <div id="preprojet_selectionne_par_region_par_sexe" style="margin-top: 10px;">
                                        test
                                    </div>
                             </div>
                            
                            </div>
                       
                    <div class="row" id="projets_soumis" style="display: none">
                        <div class="row">
                            <div class="col-md-6" id="projet_par_region">

                            </div>
                            <div class="col-md-6" id="projet_par_secteur_dactivite">

                            </div>
                        </div>
                        <hr>
                            <div id="projet_par_region_par_sexe" style="margin-top: 10px;">
                                test projets
                            </div>
                    </div>
                    <div class="row" id="financement" style="display: none">
                        <div class="row">
                            <div class="col-md-6" id="projet_par_region">

                            </div>
                            <div class="col-md-6" id="projet_par_secteur_dactivite">

                            </div>
                        </div>
                        <hr>
                            <div id="projet_par_region_par_sexe" style="margin-top: 10px;">
                                test projets
                            </div>
                    </div>
                    <div class="row" id="impact" style="display: none">
                        <div class="row">
                            <div class="col-md-6" id="projet_par_region">

                            </div>
                            <div class="col-md-6" id="projet_par_secteur_dactivite">

                            </div>
                        </div>
                        <hr>
                            <div id="projet_par_region_par_sexe" style="margin-top: 10px;">
                                test projets
                            </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

<script>
    function change_details(page_active_id, autre_page_1, autre_page_2, autre_page_3,){
        $('#'+page_active_id).show();
        $('#'+autre_page_1).hide();
        $('#'+autre_page_2).hide();
        $('#'+autre_page_3).hide();
        
    }
</script>

<script language = "JavaScript">
function graphiquedynamique(type_entreprise, status_projet){
    //alert('ok');
var url = "{{ route('preprojet.par_region_et_par_sexe') }}"
$.ajax({
                 url: url,
                 type: 'GET',
                 dataType: 'json',
                data:{type_entreprise:type_entreprise, statut:status_projet},
                 error:function(donne){
                    if (xhr.status == 401) {
                        window.location.href = ''
                    }
                },
                 success: function (donnee) {
                        var masculin= [];
                        var feminin= [];
                     
                        var donnch= new Array();
                        var status = new Array();
                    for(var i=0; i<donnee.length; i++)
                    {
                        masculin.push(parseInt(donnee[i].masculin));
                        feminin.push(parseInt(donnee[i].feminin));
                       // en_attente_de_paiement.push(parseInt(donnee[i].nbre_facture_en_attente));
                    }
                    donnch.push({
                                name: 'masculin',
                                data:masculin,
                                color:'blue',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                    donnch.push({
                                name: 'féminin',
                                data:feminin,
                                color:'green',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                    console.log(donnch);
                    for(var i=0; i<donnee.length; i++)
                            {
                                    status[i] = donnee[i].region
                            }
                    
                    Highcharts.chart('preprojet_par_region_par_sexe', {
                        chart: {
                                    type: 'column'
                                },
                        xAxis: {
                                 categories: status
                            },
                        title: {
                            text: "Avant-projets "+ status_projet + " par sexe et par région"
                        },
                       
                        credits : {
                            enabled: false
                        },
                       
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                    showInLegend: true
                            }
                        },
                        series:donnch
                    });

}

});
  var url = "{{ route('preprojet.par_region') }}"
  $.ajax({
                 url: url,
                 type: 'GET',
                 data:{type_entreprise:type_entreprise, statut:status_projet},
                 dataType: 'json',
                 error:function(donne){
                    if (xhr.status == 401) {
                        window.location.href = ''
                    }
                },
                 success: function (donnee) {
                     
                        var donnch= new Array();
                        var regions = new Array();
                    for(var i=0; i<donnee.length; i++)
                    {
                                    donnch.push({
                                    name: donnee[i].region,
                                    y:  parseInt(donnee[i].nombre)} )
                
                    }
                    
                    console.log(donnch);
                    for(var i=0; i<donnee.length; i++)
                            {
                                    regions[i] = donnee[i].region
                            }
                    
                    Highcharts.chart('preprojet_par_region', {
                        chart: {
                                    type: 'pie'
                                },
                        xAxis: {
                                 categories: regions
                            },
                        title: {
                            text: "Proportion des Avant-projets "+ status_projet + " par région"

                        },
                       
                        credits : {
                            enabled: false
                        },
                       
                        plotOptions: {
                            pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                        }
                    }
                        },
                        series: [{
                    name: 'Nombre',
                    colorByPoint: true,
                    data: donnch
                }]
                    });

}

});
var url = "{{ route('preprojet.par_secteur_dactivite') }}"
$.ajax({
                 url: url,
                 type: 'GET',
                 data:{type_entreprise:type_entreprise, statut:status_projet},
                 dataType: 'json',
                 error:function(donne){
                    if (xhr.status == 401) {
                        window.location.href = ''
                    }
                },
                 success: function (donnee) {
                     
                        var donnch= new Array();
                        var secteur_dactivites = new Array();
                    for(var i=0; i<donnee.length; i++)
                    {
                                    donnch.push({
                                    name: donnee[i].secteur_dactivite,
                                    y:  parseInt(donnee[i].nombre)} )
                
                    }
                    
                    console.log(donnch);
                    for(var i=0; i<donnee.length; i++)
                            {
                                secteur_dactivites[i] = donnee[i].secteur_dactivite
                            }
                    
                    Highcharts.chart('preprojet_par_secteur_dactivite', {
                        chart: {
                                    type: 'pie'
                                },
                        xAxis: {
                                 categories: secteur_dactivites
                            },
                            tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        title: {
                            text: "Effectif des Avant-projets "+ status_projet + " par secteur d'activité"
                        },
                        credits : {
                            enabled: false
                        },
                       
                        plotOptions: {
                            pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.1f}'
                        }
                    }
                        },
                        series: [{
                    name: 'Nombre',
                    colorByPoint: true,
                    data: donnch
                }]
                    });

}

});
}          
</script>
<script>
    $(function() {
        graphiquedynamique('mpme', 'soumis');
    })
</script>
<script>

function graphiquedynamique_money(type_entreprise, status_projet){
var url = "{{ route('preprojet.par_guichet_par_region') }}"
$.ajax({
                 url: url,
                 type: 'GET',
                 dataType: 'json',
                data:{type_entreprise:type_entreprise, statut:status_projet},
                 error:function(donne){
                    if (xhr.status == 401) {
                        window.location.href = ''
                    }
                },
                 success: function (donnee) {
                        var guichet_1= [];
                        var guichet_2= [];
                        var guichet_3= [];
                        var donnch= new Array();
                        var status = new Array();
                    for(var i=0; i<donnee.length; i++)
                    {
                        guichet_1.push(parseInt(donnee[i].guichet_1));
                        guichet_2.push(parseInt(donnee[i].guichet_2));
                        guichet_3.push(parseInt(donnee[i].guichet_3));
                    }
                    donnch.push({
                                name: 'Guichet 1',
                                data:guichet_1,
                                color:'blue',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                    donnch.push({
                                name: 'Guichet 2',
                                data:guichet_2,
                                color:'orange',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                        donnch.push({
                            name: 'Guichet 3',
                            data:guichet_3,
                            color:'green',
                            dataLabels: {
                            enabled: true,
                            }
                        })
                    console.log(donnch);
                    for(var i=0; i<donnee.length; i++)
                            {
                                    status[i] = donnee[i].region
                            }
                    
                    Highcharts.chart('preprojet_par_region_par_sexe', {
                        chart: {
                                    type: 'column'
                                },
                        xAxis: {
                                 categories: status
                            },
                        title: {
                            text: "Avant-projets "+ status_projet + " par guichet et par région"
                        },
                       
                        credits : {
                            enabled: false
                        },
                       
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                    showInLegend: true
                            }
                        },
                        series:donnch
                    });
}
});
var url = "{{ route('preprojet.par_guichet') }}"
$.ajax({
                 url: url,
                 type: 'GET',
                 data:{type_entreprise:type_entreprise, statut:status_projet},
                 dataType: 'json',
                 error:function(donne){
                    if (xhr.status == 401) {
                        window.location.href = ''
                    }
                },
                 success: function (donnee) {
                        var donnch= new Array();
                        var guichets = new Array();
                    for(var i=0; i<donnee.length; i++)
                    {
                                    donnch.push({
                                    name: donnee[i].guichet,
                                    y:  parseInt(donnee[i].nombre)} )
                    }
                    console.log(donnch);
                    for(var i=0; i<donnee.length; i++)
                            {
                                guichets[i] = donnee[i].guichet
                            }
                    Highcharts.chart('preprojet_par_secteur_dactivite', {
                        chart: {
                                    type: 'pie'
                                },
                        xAxis: {
                                 categories: guichets
                            },
                            tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        title: {
                            text: "Effectif des Avant-projets "+ status_projet + " par guichet"
                        },
                        credits : {
                            enabled: false
                        },
                       
                        plotOptions: {
                            pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.y:.1f}'
                        }
                    }
                        },
                        series: [{
                    name: 'Nombre',
                    colorByPoint: true,
                    data: donnch
                }]
                    });

}

});
  

} 
</script>
@endsection
