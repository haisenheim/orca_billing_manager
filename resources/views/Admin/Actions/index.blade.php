
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3>ACTIONS</h3>
    <hr>
    <div id="actions" class="container pl-5 pr-5 ml-3">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <a href="/admin/actions/sms">
                    <div style="height: 220px; margin-bottom:60px;" class="card text-dark">
                        <div class="card-body" style="line-height: 2rem;">
                            <div class="" >
                                <i class="large material-icons text-primary" style="font-size: 3rem;">message</i>
                            </div>
                            <h5>SMS A Envoyer</h5>
                            <div>
                                <h1 class="text-bold text-center">{{ $data[1] }}</h1>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-12">
                <a href="/admin/actions/emails">
                    <div style="height: 220px; margin-bottom:60px;" class="card text-dark">
                        <div class="card-body" style="line-height: 2rem;">
                            <div class="" >
                                <i class="large material-icons text-warning" style="font-size: 3rem;">send</i>
                            </div>
                            <h5>Email a Envoyer</h5>
                            <div>
                                <h1 class="text-bold text-center">{{ $data[2] }}</h1>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-12">
                <a href="/admin/actions/appels">
                    <div style="height: 220px; margin-bottom:60px;" class="card text-dark">
                        <div class="card-body" style="line-height: 2rem;">
                            <div class="" >
                                <i class="large material-icons text-danger" style="font-size: 3rem;">phone</i>
                            </div>
                            <h5>Appel a passer</h5>
                            <div>
                                <h1 class="text-bold text-center">{{ $data[3] }}</h1>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-sm-12">
                <a href="/admin/actions/courrier">
                    <div style="height: 220px; margin-bottom:60px;" class="card text-dark">
                        <div class="card-body" style="line-height: 2rem;">
                            <div class="" >
                                <i class="large material-icons text-indigo" style="font-size: 3rem;">email</i>
                            </div>
                            <h5>Courrier Envoyer</h5>
                            <div>
                                <h1 class="text-bold text-center">{{ $data[4] }}</h1>
                            </div>

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

    #actions.card{
        height: 420px;
    }
    .card{
        border-radius: 1.25rem;
        margin: 20px 70px;
    }
  </style>
@endsection
