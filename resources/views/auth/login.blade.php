<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>ALT RECOVERY Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="ALT RECOVERY Manager By Alliages Technologies" name="description" />
        <meta content="ALT RECOVERY Manager" name="Clement ESSOMBA" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">

        <link rel="stylesheet" href="{{asset('css/adminlte.css')}}">
        <style>
            body{
                background: #f9faf9;
                background: linear-gradient(to right, #555555,#FFFFFF,#555555);
            }

        </style>

    </head>

    <body class="">

        <div class="account-pages my-5 pt-1">
            <div class="container">

                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="" style="background: transparent; border: none">
                            <div class="card-body p-4">
                                 <div class="text-center mb-5">
                                    <a href="/" class="logo"><img src="{{ asset('img/logo.png') }}" style="" height="120" alt="logo"></a>
                                    <h5 class="font-size-24 font-bold mb-4 text-ping" style="margin-top:20px; font-weight: 900"><span class="text-dark">ALT</span> <span style="background: #FFFFFF; padding:5px 10px; color:#333333" class="">RECOVERY</span> <span style="background: #333333; padding:5px 10px; color:#FFFFFF" class="text-light">MANAGER</span></h5>
                                </div>

                                <div class="p-2">

                                    <form class="form-horizontal" action="{{ route('login') }}" method="post">
                                         {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-4">
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Saisir votre adresse email">
                                                </div>
                                                <div class="form-group mb-4">
                                                    <input name="password" type="password" class="form-control" id="password" placeholder="Saisir votre mot de passe">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                            <label class="custom-control-label" for="customControlInline">Se souvenir de moi</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn btn-dark btn-block waves-effect waves-light" type="submit">Se connecter</button>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <style>
            .text-dark{
                color: #333333;
            }

            .btn-dark {
            color: #fff;
            background-color: #333333;
            border-color: #333333;
            box-shadow: none;
            }
        </style>
        <!-- end Account pages -->
        <div style="position: fixed; bottom: 20px; height: 90px; width: 100%; text-align: center;">
           <span style="color: #cc6600; font-style:italic">By</span>
           <img src="<?= asset('img/logo-alt.png') ?>" height="90" alt=""/>
        </div>

    </body>
</html>
