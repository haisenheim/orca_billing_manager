
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3>PARAMETRES</h3>
    <hr>
    <div id="dashboard" class="container pl-5 pr-5 ml-3">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <a href="/admin/parametres/profils">
                    <div style="height: 220px" class="card text-dark">
                        <div class="card-body">
                            <div class="">
                                <i class="fa fa-2x text-primary fa-bars"></i>
                            </div>
                            <h5>Profils Client</h5>
                            <div>
                                <span class="fa fa-question-circle text-gray"></span>
                            </div>
                            <p>Segmentez vos clients en profils définis afin d'adresser des actionsde relances appropriées</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-12">
                <a href="/admin/parametres/scenarios">
                    <div style="height: 220px" class="card text-dark">
                        <div class="card-body">
                            <div class="">
                                <i class="fa fa-2x text-warning fa-film"></i>
                            </div>
                            <h5>SCENARIOS</h5>
                            <div>
                                <span class="fa fa-question-circle text-gray"></span>
                            </div>
                            <p>Créez des scénarios de relancesen fonction de vos profilsclients</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-12">
                <a href="/admin/parametres/modeles">
                    <div style="height: 220px" class="card text-dark">
                        <div class="card-body">
                            <div class="">
                                <i class="fa fa-2x text-danger fa-pen"></i>
                            </div>
                            <h5>Modèles</h5>
                            <div><span class="fa fa-question-circle text-gray"></span></div>
                            <p>Créez des modèles de relance parcanaux de communication</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-12">
                <a href="/admin/parametres/comptes">
                    <div style="height: 220px" class="card text-dark">
                        <div class="card-body">
                            <div class="">
                                <i class="fa fa-2x text-indigo fa-user-cog"></i>
                            </div>
                            <h5>Comptes & Utilisateurs</h5>
                            <div> <span class="fa fa-question-circle text-gray"></span></div>
                            <p>Maintenez à jour les informationslégales de votre entreprise, créez paramétrez des utilisateurs</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
  </div>

  <style>
    .card-body>h5{
        color: #333333;
        font-weight: 800;
    }

    #dashboard.card{
        height: 400px;
    }
    .card{
        border-radius: 1.25rem;
        margin: 20px;
    }
  </style>
@endsection
