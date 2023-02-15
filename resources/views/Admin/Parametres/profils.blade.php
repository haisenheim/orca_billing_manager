
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3 class="pl-4">PROFILS CLIENTS</h3>
    <hr>
    <div id=""  class="container pl-3 pr-5 ml-3">
        <div style="display: flex; justify-content: space-between; flex-direction: column; min-height:70vh;">
            <div>
                <ul class="list-group">
                    @php
                        $i=0;
                    @endphp
                    @foreach ($profils as $profil)
                    @php
                        $k= $i++;
                    @endphp
                    <li class="list-group-item">
                        <div data-toggle="collapse" href="#collapseProfil{{ $k }}" role="button" aria-expanded="false" aria-controls="collapseExample" class="pl-4 pr-4 profil" style="display: flex; justify-content:space-between; flex-direction:row">
                            <div>
                                <span class="collapse-header">{{ $profil->name }}</span>
                            </div>
                            <span class="fa fa-chevron-left"></span>

                        </div>
                        <div class="collapse" id="collapseProfil{{ $k }}">
                            <div class="collapse-body">
                              {{ $profil->description }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div>
                <div class="pull-right">
                    <a href="/admin/parametres/profil/add" class="btn btn-black">AJOUTER UN PROFIL</a>
                </div>
            </div>
        </div>
    </div>
  </div>
  <style>
    .collapse-header{
        font-size: 1.25rem;
        font-weight: 700;
    }
    .collapse-body{
        padding: 30px;
    }
  </style>
  <script>
        $('.profil').on('click',function(){
            console.log('something....');
            $fa = $(this).find('.fa');
            if($fa.hasClass('fa-chevron-left')){
                console.log($(this).find('.fa').removeClass('fa-chevron-left').addClass('fa-chevron-down'));
            }else{
                console.log($(this).find('.fa').removeClass('fa-chevron-down').addClass('fa-chevron-left'));
            }

        });
  </script>
@endsection
