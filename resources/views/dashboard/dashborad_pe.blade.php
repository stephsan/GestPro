@extends('layouts/base')
@section('title')
@section('dashboard_pe', 'active')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Tableau de bord du Programme entreprendre</h1>
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
                    <h3 >100</h3>
                    Avant-projets Enregistrés
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer block1">Plus de détails</a>

            </div>
                
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h3 >100</h3>
                    Projets soumis
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer block2">Plus de détails</a>

            </div>
                
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h3 > 100 000 000</h3>
                    Financement accordé
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer block3">Plus de détails</a>

            </div>
                
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-default">
                <div class="inner">
                    <h3 >100</h3>
                    Impacts
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer block4">Plus de détails</a>

            </div>
                
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 offset-0 ">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6" id="preprojet_par_region">

                            </div>
                            <div class="col-md-6" id="preprojet_par_secteur_dactivite">

                            </div>
                        </div>
                        <hr>
                            <div id="preprojet_par_region_par_sexe" style="margin-top: 10px;">
                                test
                            </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script language = "JavaScript">
    var url = "{{ route('preprojetpe.par_region_et_par_sexe') }}"
      $.ajax({
                 url: url,
                 type: 'GET',
                 dataType: 'json',
                 error:function(data){
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
                            text: 'Avant-projets enregistrés par sexe et par région'
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
</script>

<script language = "JavaScript">
    var url = "{{ route('preprojetpe.par_region') }}"
      $.ajax({
                 url: url,
                 type: 'GET',
                 dataType: 'json',
                 error:function(data){
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
                            text: 'Proportion des Avant-projets enregistrés par région'
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
</script>
<script language = "JavaScript">
    var url = "{{ route('preprojetpe.par_secteur_dactivite') }}"
      $.ajax({
                 url: url,
                 type: 'GET',
                 dataType: 'json',
                 error:function(data){
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
                            text: "Effectif des Avant-projets enregistrés par secteur d'activité"
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
</script>
@endsection
