@extends('layouts/base')
@section('title')
@section('dashboard_fp', 'active')
@endsection
@section('css')
@endsection
@section('content')
    <div class="pagetitle">
        <h1 class="text-success">Tableau de bord </h1>
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
                    <h3 >{{ $all_projet->count() }}</h3>
                        Réalisations en cours
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
                    <h3 >{{ $all_projet->count() }}</h3>
                    Projets en etudes
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
                   Financements en cours
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
                    Financements 
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
                                            Projets en cours
                                        </h2>
                                    </div>
                                @foreach ( $projets_en_cours as $projets_en_cour )
                                        <div class="themed-background-muted-light">
                                            <a href="javascript:void(0)" onclick="graphiquedynamique('{{ $projets_en_cour->id }}');"  class="widget widget-hover-effect2 themed-background-muted-light">
                                                <h4 class="text-left compteur">
                                                        {{-- <strong class="text-danger">{{ $all_projet->count() }}</strong> --}}
                                                        <br>
                                                        <small>
                                                           {{ $projets_en_cour->denomination }}
                                                        </small>
                                                </h4>
                                            </a>
                                    </div>
                                @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dash-block">
                                    <div class="dash-block-title">
                                        <h2 class="dash-compteur">
                                            Projets finalisés
                                        </h2>
                                    </div>
                                    @foreach ($projets_en_cours as $projets_en_cour )
                                        <div class="themed-background-muted-light">
                                            <a href="javascript:void(0)" onclick="graphiquedynamique('{{ $projets_en_cour->id }}', 'soumis');"  class="widget widget-hover-effect2 themed-background-muted-light">
                                                <h4 class="text-left compteur">
                                                        {{-- <strong class="text-danger">{{ $all_projet->count() }}</strong> --}}
                                                        <br>
                                                        <small>
                                                        {{ $projets_en_cour->denomination }}
                                                        </small>
                                                </h4>
                                            </a>
                                        </div>
                                    @endforeach
                                        </div>
                                    </div>
                            </div>
                            
                             <div class="row">
                                <div class="col-md-6" id="taux_de_composante">
        
                                </div>
                                <div class="col-md-6" id="taux_par_categorie_dactivite">
    
                                </div>
                                <hr>
                                <div class="row">
                                    
                                    <div class="col-md-6" id="differents_taux">
                                        <h4 style="text-align: center">Situation sur la réalisation du projet</h4>
                                            <table id="table_taux">
                                                <tr style="border: solid 1px black">
                                                    <td>Taux physique</td>
                                                    <td id="taux_physique"></td>
                                                </tr>
                                                <tr>
                                                    <td>Taux financier</td>
                                                    <td id="taux_financier"></td>
                                                </tr>
                                                <tr>
                                                    <td>Taux de decaissement</td>
                                                    <td id="taux_decaissement"></td>
                                                </tr>
                                                <tr>
                                                    <td>Délais consommé</td>
                                                    <td id="delais_consomme"></td>
                                                </tr>
                                            </table>
                                    </div>
                                    <div class="col-md-6" id="par_statut_dactivite">
        
                                    </div>
                                    
                                </div>
                                <hr>
                                    
                                    <div id="preprojet_selectionne_par_region_par_sexe" style="margin-top: 10px;">
                                        test
                                    </div>
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
<script language = "JavaScript">
    function graphiquedynamique(projet_id){
        //alert('ok');
    var url = "{{ route('projet.taux_par_composante') }}"
    $.ajax({
                     url: url,
                     type: 'GET',
                     dataType: 'json',
                    data:{projet_id:projet_id},
                     error:function(donne){
                        if (xhr.status == 401) {
                            window.location.href = ''
                        }
                    },
                     success: function (donnee) {
                            var taux_physique= [];
                            var taux_financier= [];
                         
                            var donnch= new Array();
                            var status = new Array();
                        for(var i=0; i<donnee.length; i++)
                        {
                            taux_physique.push(parseInt(donnee[i].taux_physique));
                            taux_financier.push(parseInt(donnee[i].taux_financier));
                           // en_attente_de_paiement.push(parseInt(donnee[i].nbre_facture_en_attente));
                        }
                        donnch.push({
                                    name: 'Taux physique',
                                    data:taux_physique,
                                    color:'blue',
                                    dataLabels: {
                                    enabled: true,
                                    }
                                })
                        donnch.push({
                                    name: 'Taux financier',
                                    data:taux_financier,
                                    color:'grey',
                                    dataLabels: {
                                    enabled: true,
                                    }
                                })
                        console.log(donnch);
                        for(var i=0; i<donnee.length; i++)
                                {
                                        status[i] = donnee[i].libelle
                                }
                        
                        Highcharts.chart('taux_de_composante', {
                            chart: {
                                        type: 'column'
                                    },
                            xAxis: {
                                     categories: status
                                },
                                yAxis: { 
                                    title: { text: 'Pourcentage (%)' },
                                    max: 100
                                },
                                tooltip: {
                        pointFormat: '<b>{point.y}%</b>' // Ajout du %
                    },
                            plotOptions: {
                                column: {
                                    dataLabels: {
                                        enabled: true,
                                        format: '{y}%' // Ajout du % sur les valeurs affichées
                                    }
                                }
                            },
                                    title: {
                                text: "Statut projet  par composante"
                            },
                           
                            credits : {
                                enabled: false
                            },
                           
                         
                            series:donnch
                        });
    
    }
    
    });
       var url = "{{ route('projet.getTaux') }}"
       $.ajax({
                      url: url,
                      type: 'GET',
                      data:{projet_id:projet_id},
                      dataType: 'json',
                      error:function(donne){
                         if (xhr.status == 401) {
                             window.location.href = ''
                         }
                     },
                      success: function (donnee) {
                        $('#taux_physique').html(donnee.taux_physique +' %')
                        $('#taux_financier').html(donnee.taux_financier +' %')
                        $('#taux_decaissement').html(donnee.taux_decaissement +' %')  
                        $('#delais_consomme').html(donnee.delais_consomme +' %')
     }
     });
     var url = "{{ route('projet.taux_par_categorie') }}"
       $.ajax({
                      url: url,
                      type: 'GET',
                      data:{projet_id:projet_id},
                      dataType: 'json',
                      error:function(donne){
                         if (xhr.status == 401) {
                             window.location.href = ''
                         }
                     },
                      success: function (donnee) {
        {
                            var donnch= new Array();
                            var categories = new Array();
                        for(var i=0; i<donnee.length; i++)
                        {
                          donnch.push({
                                    name: donnee[i].categorie,
                                    y:  parseInt(donnee[i].moyenne_taux),
                                    dataLabels: {
                                                enabled: true,
                                        }
                                } )
                        }
                        for(var i=0; i<donnee.length; i++)
                            {
    
                                    categories[i] = donnee[i].categorie
    
                            }
                        Highcharts.chart('taux_par_categorie_dactivite', {
                            chart: {
                                        type: 'column'
                                    },
                                    xAxis: {
                                     categories: categories
                                },
                          
                                yAxis: { 
                                    title: { text: name+ ' Pourcentage (%)' },
                                    max: 100
                                },
                            title: {
                                text: 'Progression du projet par categorie'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            credits:{
                                enabled:false,
                            },
                            plotOptions: {
                                column: {
                                    dataLabels: {
                                        enabled: true,
                                        format: '{y}%' // Ajout du % sur les valeurs affichées
                                    }
                                }
                            },
                           
                            series: [{
                                name: 'Taux',
                                colorByPoint: true,
                                data: donnch
                            }]
                        });

    }
     }
     });
     
     var url = "{{ route('activite.repartition_par_statut') }}"
       $.ajax({
                      url: url,
                      type: 'GET',
                      data:{projet_id:projet_id},
                      dataType: 'json',
                      error:function(donne){
                         if (xhr.status == 401) {
                             window.location.href = ''
                         }
                     },
                      success: function (donnee) {
        {
                            var donnch= new Array();
                            var status = new Array();
                        for(var i=0; i<donnee.length; i++)
                        {
                          donnch.push({
                                    name: donnee[i].statut,
                                    y:  parseInt(donnee[i].nombre_activite),
                                    dataLabels: {
                                                enabled: true,
                                        }
                                } )
                        }
                        for(var i=0; i<donnee.length; i++)
                            {
    
                                    status[i] = donnee[i].statut
    
                            }
                        Highcharts.chart('par_statut_dactivite', {
                            chart: {
                                        type: 'pie'
                                    },
                                    xAxis: {
                                     categories: status
                                },
                          
                                yAxis: { 
                                    title: { text: name+ ' Pourcentage (%)' },
                                   
                                },
                            title: {
                                text: 'Statut des activités'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            credits:{
                                enabled:false,
                            },
                            plotOptions: {
                                pie: {
                                    size: '80%', 
                                    innerSize: '50%',   // Définit la taille du graphique (70% du conteneur)
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.name}: {point.y}'
                                    }
                                }
                                },
                           
                            series: [{
                                name: 'Taux',
                                colorByPoint: true,
                                data: donnch
                            }]
                        });

    }
     }
     });
    }          
</script>
<script>
    function change_details(page_active_id, autre_page_1, autre_page_2, autre_page_3,){
        $('#'+page_active_id).show();
        $('#'+autre_page_1).hide();
        $('#'+autre_page_2).hide();
        $('#'+autre_page_3).hide();
        graphiquedynamique_PA('mpme','soumis')
    }
</script>

<script language = "JavaScript">
    function graphiquedynamique_PA(type_entreprise, status_projet){
    var url = "{{ route('projet.par_region_et_par_sexe') }}"
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
                        
                        Highcharts.chart('projet_par_region_par_sexe', {
                            chart: {
                                        type: 'column'
                                    },
                            xAxis: {
                                     categories: status
                                },
                            title: {
                                text: "Plan d'affaire "+ status_projet + " par sexe et par région"
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
      var url = "{{ route('projet.par_region') }}"
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
                        
                        Highcharts.chart('projet_par_region', {
                            chart: {
                                        type: 'pie'
                                    },
                            xAxis: {
                                     categories: regions
                                },
                            title: {
                                text: "Proportion des plan d'affaire "+ status_projet + " par région"
    
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
    var url = "{{ route('projet.par_secteur_dactivite') }}"
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
                        
                        Highcharts.chart('projet_par_secteur_dactivite', {
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
                                text: "Effectif des plan d'affaires "+ status_projet + " par secteur d'activité"
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
//Nombre de plan d'affaire reparti par guichet 
var url = "{{ route('projet.reparti_par_guichet') }}"
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
                        var guichet1= [];
                        var guichet2= [];
                        var guichet3= [];
                        var donnch= new Array();
                        var status = new Array();
                    for(var i=0; i<donnee.length; i++)
                    {
                        guichet1.push(parseInt(donnee[i].montant_petit_sous_projet));
                        guichet2.push(parseInt(donnee[i].montant_projet_standards));
                        guichet3.push(parseInt(donnee[i].montant_projet_de_transformation_vert));
                    }
                    donnch.push({
                                name: 'Guichet 1',
                                data:guichet1,
                                color:'blue',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                    donnch.push({
                                name: 'Guichet 2',
                                data:guichet2,
                                color:'orange',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                        donnch.push({
                            name: 'Guichet 3',
                            data:guichet3,
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
                    
                    Highcharts.chart('projet_reparti_par_guichet_nombre', {
                        chart: {
                                    type: 'column'
                                },
                        xAxis: {
                                 categories: status
                            },
                        title: {
                            text: "Plan d'affaires "+ status_projet + " par guichet et par région"
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
var url = "{{ route('projet.reparti_par_guichet') }}"
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
                        var guichet1= [];
                        var guichet2= [];
                        var guichet3= [];
                        var donnch= new Array();
                        var status = new Array();
                    for(var i=0; i<donnee.length; i++)
                    {
                        guichet1.push(parseInt(donnee[i].guichet1));
                        guichet2.push(parseInt(donnee[i].guichet2));
                        guichet3.push(parseInt(donnee[i].guichet3));
                    }
                    donnch.push({
                                name: 'Guichet 1',
                                data:guichet1,
                                color:'blue',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                    donnch.push({
                                name: 'Guichet 2',
                                data:guichet2,
                                color:'orange',
                                dataLabels: {
                                enabled: true,
                                }
                            })
                        donnch.push({
                            name: 'Guichet 3',
                            data:guichet3,
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
                    
                    Highcharts.chart('projet_reparti_par_guichet_montant', {
                        chart: {
                                    type: 'column'
                                },
                        xAxis: {
                                 categories: status
                            },
                        title: {
                            text: "Plan d'affaires "+ status_projet + " par guichet et par région"
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
}  
            
</script>


<script>
    $(function() {
        graphiquedynamique(1);
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
