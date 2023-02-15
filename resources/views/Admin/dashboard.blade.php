
@extends('layouts.admin')

@section('content-header')


@section('content')
  <div class="container p-4">
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div><span style="font-size: 2.2rem; font-weight: 500" class="">Hello {{ auth()->user()->first_name }}!</span></div>
                <div style="width: 75%;"><span style="font-size: 18px; font-weight: 400">Voici un aperçu de vos comptes clients aujourd'hui</span></div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="card bg-gradient-danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-12">
                                <div>
                                    <div><span id="nb-relances" class="text-lg">12</span></div>
                                    <div><span>relances à effectuer</span></div>
                                </div>
                            </div>
                            <div style="" class="col-md-7 col-sm-12">
                                <div class="mt-3">
                                    <a href="/admin/actions" class="btn btn-sm text-danger" style="background:white;">Relancer <i class="fa fa-arrow-right"></i></a>
                                    <a href="/admin/parametres/scenarios" class="btn btn-sm btn-danger ml-1" style=" color: white;">Créer un scénario</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div id="creances-section" class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between;" class="">
                            <div>
                                <div><span>Vos créances clients</span></div>
                                <div><span style="font-size: 24px; font-weight: 500;"><span id="total-creances"></span> FCFA</span></div>
                            </div>
                            <div>
                                <span class="badge text-success"><i class="fa fa-long-arrow-alt-down"></i> -2,8%</span>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div style="display: flex; flex-direction: column; justify-content: end;" class="col-3">
                                <div style="width: 10px; height:10px; background:#E70000; color:transparent"><span style="">.</span></div>
                                <div><span style="font-size: 9px; font-weight: 700"><span id="sommes-impayees"></span> XAF</span></div>
                                <div><span style="font-size: 8px;">Sommes impayées </span></div>
                            </div>
                            <div class="col-6">
                                <canvas id="myChart" height="220"></canvas>
                            </div>
                            <div style="display: flex; flex-direction: column; justify-content: end;" class="col-3">
                                <div style="width: 10px; height:10px; background:#0099FF; color:transparent"><span style="">.</span></div>
                                <div><span style="font-size: 9px; font-weight: 700"><span id="sommes-comming"></span> XAF</span></div>
                                <div><span style="font-size: 8px;">Sommes du à venir </span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ba-section" class="col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div style="">
                            <span>Balance âgée</span>
                            <canvas id="baChart" width="300" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div id="debiteur-section" class="col-md-5 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div><span>Vos principaux débiteurs</span></div>
                        <div id="debiteur-section-content">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div style="height: 220px;" class="display-column space-between">
                                    <div>
                                        <div>
                                            <span style="color: #a0a0a0; font-size:12px;">Délais moyen de paiement</span>
                                        </div>
                                        <div>
                                            <span style="font-weight: 700; font-size: 24px;"><span id="text-dso"></span> jours</span>
                                        </div>
                                    </div>
                                    <div id="dso-progress" class="">
                                        <span class="badge text-success bg-light-success"><i class="fa fa-long-arrow-alt-down"></i> -2j</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div style="">
                                    <canvas id="delaipaiementChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div style="height: 220px;" class="display-column space-between">
                                    <div>
                                        <div>
                                            <span style="color: #a0a0a0; font-size:12px;">Taux de risque</span>
                                        </div>
                                        <div>
                                            <span  style="font-weight: 700; font-size: 24px;"><span id="text-risk"></span> %</span>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div>
                                            <p style="font-size: 12px; color:#b0b0b0">
                                                montant des créances à plus de 90 jours sur le total des créances
                                            </p>
                                        </div>
                                        <div id="risk-progress">
                                            <span class="badge text-danger bg-light-danger"><i class="fa fa-long-arrow-alt-up"></i> 3%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div style="">
                                    <canvas id="riskChart" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <span>Facturations vs encaissements</span>
                        </div>
                        <div>
                            <canvas id="feChart" width="900" height="240"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div id="litiges-section" class="col-md-5 col-sm-12">
                <div style="min-height: 220px;" class="card bg-gradient-danger">
                    <div class="card-body">
                        <div>
                            <p style="font-size: 24px; font-weight: 600" class="text-black text-center text-lg">Litiges</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div style="font-size: 20px;"><span>En nombre</span></div>
                                <div>
                                    <span id="litige-nombre" style="font-size: 28px; font-weight: 700;">0</span>
                                    <span>Client(s)</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div style="font-size: 20px;"><span>En montant</span></div>
                                <div class="pt-4">
                                    <span style="font-size: 16px; font-weight: 700;"><span id="litige-montant"></span><span>FCFA</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="profil-section" class="col-md-7 col-sm-12">
                <div style="" class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <span class="text-bold">Répartition des créances par profil</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div style="">
                                    <canvas  id="repartChart" height="220"></canvas>
                                </div>
                            </div>
                            <div style="padding: 30px 0 10px 10px;" class="col-md-6 col-sm-12">
                                <ul style="font-size: 12px; font-weight: 600" id="profils-list" class="list-inline">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
  <style>
    span.badge-black{
        background: #000000;
        color: #fff;
    }
    div.debiteur-list{
        padding:2px 5px;
        display: flex;
        border-radius:20px;
        justify-content: space-between;
        background:#EDF5FC;
        font-size: 14px;
        font-weight: 400px;
        margin:5px 0;
        cursor: pointer;
    }
    #debiteur-section div.card-body{
        height: 540px;
        overflow:scroll;
    }
    div.display-column{
        display: flex;
        flex-direction: column;
    }
    div.space-between{
        justify-content: space-between;
    }
    .bg-light-success{
        background-color: #99CC66;
    }

    .bg-light-danger{
        background-color: #f57d7d;
    }
  </style>
  <script src="{{ asset('js/chart.min.js') }}"></script>
  <script>

    $(document).ready(function(){
        $.ajax({
            url:'/api/v1/kpi/debiteurs',
            type:'get',
            dataType:'json',
            success:function(data){
                console.log(data);
                $('#debiteur-section-content').html('');
                data.forEach(element => {
                    var debiteur = `<div data-link='${element.client.link}' class="debiteur-list">
                                <div>
                                    <div>
                                        <span>${ element.client.name }</span>
                                        <span class="badge badge-black">${ element.nb } j</span>
                                    </div>
                                </div>
                                <div>
                                    <span>${ element.client.montant }</span>
                                </div>
                            </div>`;
                    $('#debiteur-section-content').append(debiteur);
                });

                $('.debiteur-list').click(function(){
                    var link = $(this).data('link');
                    window.location.href=link;
                });

            },
            error:function(err){
                alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
        });

        $.ajax({
            url:'/api/v1/kpi/unpaid_coming',
            type:'get',
            dataType:'json',
            success:function(rps){
                console.log(rps);
                $('#total-creances').text(rps.total);
                $('#sommes-impayees').text(rps.unpaid.qty);
                $('#sommes-comming').text(rps.coming.qty);
                const ctx = document.getElementById('myChart');
                const data = {
                            datasets: [
                                {
                                label: 'Dataset 1',
                                data: [rps.unpaid.per,rps.coming.per],
                                backgroundColor:['#E70000','#0099FF'],
                                }
                            ]
                        };
                const myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: ''
                        }
                        }
                    },
                });

            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
        });


        $.ajax({
            url:'/api/v1/kpi/ba',
            type:'get',
            dataType:'json',
            success:function(rps){
                console.log(rps);
                //console.log
                const bactx = document.getElementById('baChart');
                const balabels = ['0-30j','30-60j','60-90j','>90j'];
                const badata = {
                labels: balabels,
                datasets: [
                    {
                    data: [rps.t1,rps.t2,rps.t3,rps.t4],
                // borderColor: Utils.CHART_COLORS.red,
                    backgroundColor:['#FFEE66','#FFAA22','#FF7744','#EE4444'],
                    borderWidth: 1,
                    borderRadius: 0,
                    borderSkipped:true,
                    },
                ]
                };
                const baChart = new Chart(bactx, {
                    type: 'bar',
                    data: badata,
                    options: {
                        responsive: false,
                        plugins: {
                        legend: {
                            position: 'top',
                            display:false,
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                        }
                    },
                });
            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
        });

        //$('#ba-section .card').height($('#creances-section .card').height());

        $.ajax({
            url:'/api/v1/kpi/fvp',
            type:'get',
            dataType:'json',
            success:function(rps){
                //console.log(rps);
                const fectx = document.getElementById('feChart');
                var felabels = [];
                var data1 = [];
                var data2 = [];
                console.log(Object.entries(rps));
                Object.entries(rps).forEach(function(element){
                    var elt = element[1];
                    felabels.push(elt.name);
                    data1.push(elt.f);
                    data1.push(elt.p);
                });
                const fedata = {
                labels: felabels,
                datasets: [
                    {
                    label: 'Facturation',
                    data: data1,
                // borderColor: Utils.CHART_COLORS.red,
                    backgroundColor: '#1199EE',
                    },
                    {
                    label: 'Encaissement',
                    data: data2,
                    //borderColor: Utils.CHART_COLORS.blue,
                    backgroundColor: '#22CCDD',
                    }
                ]
            };
            const feChart = new Chart(fectx, {
                type: 'bar',
                data: fedata,
                //barThickness:50,
                options: {
                    responsive: false,
                    plugins: {
                    legend: {
                        position: 'top',
                        display:false,
                    },
                    title: {
                        display: false,
                        text: ''
                    }
                    }
                },
            });

            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
        });

        $.ajax({
            url:'/api/v1/kpi/nb-relances',
            type:'get',
            dataType:'json',
            success:function(rps){
               // console.log(rps);
                $('#nb-relances').text(rps);
            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
        });

        $.ajax({
            url:'/api/v1/kpi/creances-profils',
            type:'get',
            dataType:'json',
            success:function(rps){
                //console.log(Object.entries(rps));
                const repartctx = document.getElementById('repartChart');
                var creances = Object.entries(rps);
                var labels = [];
                var datas = [];
                colors = [];
                $('#profils-list').html('');
                creances.forEach(function(elt){
                    //console.log(elt[1]);
                    var creance = elt[1];
                    labels.push(creance.name);
                    datas.push(creance.montant);
                    colors.push(creance.color);
                    var li = `<li class="list-inline-item">
                            <div style="display:flex; justify-content:start">
                                <div style="width:10px; height:10px; background:${creance.color}"></div>
                                <div><span>${creance.name}</span></div>
                            </div>
                        </li>`;
                    $('#profils-list').append(li);
                });


               // const repartlabels = ['Particulier','PME','Grands comptes'];
                const repartdata = {
                    labels: labels,
                    datasets: [
                        {
                        label: '',
                        data: datas,
                        //borderColor: Utils.CHART_COLORS.red,
                        backgroundColor: colors,
                        }
                    ]
                };

                const repartconfig = {
                    type: 'pie',
                    data: repartdata,
                   options: {
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                            display:false
                        },
                        title: {
                            display: false,
                            text: 'Repartion des creances par profil'
                        }
                        }
                    },
                };

                const repartChart = new Chart(
                    repartctx,
                    repartconfig,
                );
               // $('#nb-relances').text(rps);
               var height = $('#profil-section .card').height();
               $('#litiges-section .card').height(height);
            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
        });

        $.ajax({
            url:'/api/v1/kpi/litiges',
            type:'get',
            dataType:'json',
            success:function(rps){
                console.log(rps);
                $('#litige-montant').text(rps.montant);
                $('#litige-nombre').text(rps.nb);
            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
        });
    });


    // Construction du DSO
    $.ajax({
            url:'/api/v1/kpi/dso',
            type:'get',
            dataType:'json',
            success:function(rps){
                var delais = Object.entries(rps);
                console.log(delais);
                const delaipaiementctx = document.getElementById('delaipaiementChart');
                var labels = [];
                var colors = [];
                var datas = [];
                $('#text-dso').text(delais[0][1].dso);
                var diff = delais[0][1].dso - delais[1][1].dso;
                if(diff>0){
                    var html = `<span class="badge text-danger bg-light-danger"><i class="fa fa-long-arrow-alt-up"></i> ${diff}j</span>`;
                }else{
                    var html = `<span class="badge text-success bg-light-success"><i class="fa fa-long-arrow-alt-down"></i> -${diff}j</span>`;
                }
                $('#dso-progress').html(html);
                for(var i=5;i>=0;i--){
                    var delai = delais[i][1];
                    labels.push(delai.name);
                    datas.push(delai.dso);
                    colors.push(delai.color);
                }

                const delaidata = {
                labels: labels,
                datasets: [
                    {
                    data: datas,
                    backgroundColor:colors,
                    borderWidth: 1,
                    borderRadius: 0,
                    borderSkipped:true,
                    },
                ]
                };
                const delaiChart = new Chart(delaipaiementctx, {
                    type: 'bar',
                    data: delaidata,
                    //barThickness:50,
                    options: {
                        responsive: false,
                        plugins: {
                        legend: {
                            position: 'top',
                            display:false,
                        },
                        title: {
                            display: false,
                            text: ''
                        }
                        }
                    },
                });
            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
    });


    // Evaluation du risque
    $.ajax({
            url:'/api/v1/kpi/risk',
            type:'get',
            dataType:'json',
            success:function(rps){
                var risks = Object.entries(rps);
                console.log(risks);
                const riskctx = document.getElementById('riskChart');


                var labels = [];
                var colors = [];
                var datas = [];
                $('#text-risk').text(risks[0][1].per);
                var diff =  Math.round(risks[0][1].per - risks[1][1].per,2);
                if(diff>0){
                    var html = `<span class="badge text-danger bg-light-danger"><i class="fa fa-long-arrow-alt-up"></i> ${diff}%</span>`;
                }else{
                    var html = `<span class="badge text-success bg-light-success"><i class="fa fa-long-arrow-alt-down"></i> -${diff}%</span>`;
                }
                $('#risk-progress').html(html);
                for(var i=3;i>=0;i--){
                    var risk = risks[i][1];
                    labels.push(risk.name);
                    datas.push(risk.per);
                    colors.push(risk.color);
                }

                const riskdata = {
                labels: labels,
                datasets: [
                    {
                    data: datas,
                    backgroundColor:colors,
                    borderWidth: 1,
                    borderRadius: 0,
                    borderSkipped:true,
                    },
                ]
                };
                const riskChart = new Chart(riskctx, {
                    type: 'bar',
                    data: riskdata,
                    //barThickness:50,
                    options: {
                        responsive: false,
                        plugins: {
                        legend: {
                            position: 'top',
                            display:false,
                        },
                        title: {
                            display: false,
                            text: ''
                        }
                        }
                    },
                });
            },
            error:function(err){
               // alert('Erreur de Connexion au Serveur. Impossible de charger les debiteurs!');
            }
    });



  </script>
@endsection
