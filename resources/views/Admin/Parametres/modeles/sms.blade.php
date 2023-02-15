
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><span class="fa fa-2x fa-sms text-gray"></span> SMS</h3>
    <hr>
    <div id="" class="container pl-5 pr-5 ml-3">
        <div class="">
            <ul style="margin:0;" class="nav nav-tabs content-submenu" id="custom-tabs" role="tablist">
               @php
                   $i=1;
               @endphp
               @foreach ($sms as $k=>$v)
                   @if($i==1)
                   <li class="nav-item">
                        <a class="nav-link active" id="profil-{{ $i }}" data-toggle="pill" href="#tab-profil-{{ $i }}" role="tab" aria-controls="custom-tabs-tous" aria-selected="true">PROFIL {{ $i }}</a>
                    </li>
                   @else
                    <li class="nav-item">
                        <a class="nav-link" id="profil-{{ $i }}" data-toggle="pill" href="#tab-profil-{{ $i }}" role="tab" aria-controls="custom-tabs-tous" aria-selected="true">PROFIL {{ $i }}</a>
                    </li>
                   @endif
                   @php
                       $i++
                   @endphp
               @endforeach
            </ul>
            <div class="tab-content" id="custom-tabs-two-tabContent">
                @php
                    $k=1;
                @endphp
                @foreach ($sms as $p=>$v)
                    @if($k==1)
                    <div class="tab-pane fade show active" id="tab-profil-{{ $k }}" role="tabpanel" aria-labelledby="custom-tabs-tous">
                        <div class="p-3 mb-2"><h6 class="text-gray">{{ $p }}</h6></div>
                        <div>
                            @foreach ($v as $modele)
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-black">{{ $modele->name }}</h6>
                                        <div>
                                            <?= $modele->body ?>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="tab-pane fade" id="tab-profil-{{ $k }}" role="tabpanel" aria-labelledby="custom-tabs-tous">
                        <div class="p-3 mb-2"><h6 class="text-gray">{{ $p }}</h6></div>
                        <div>
                            @foreach ($v as $modele)
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="text-black">{{ $modele->name }}</h6>
                                        <div>
                                            <?= $modele->body ?>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @php
                        $k++
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
  </div>

  <style>

    .content-submenu a.nav-link {
        background: #f4f6f9;
        border: none;
        color: #222222;
        border-radius: 0;
        padding: 0.25rem 1.5rem;
    }

    .content-submenu a.nav-link.active {
        background: #222222;
        border: 1px solid #555555;
        color: #ffffff;
        border-radius: 0;
        padding: 0.25rem 1.5rem;
        box-shadow: #555 1px 11px 11px;
    }
     ul#custom-tabs>li a.active{
        border-radius: 5px;
        box-shadow: none;
    }
    section.content ul#custom-tabs.content-submenu{
        background: none;
    }

  </style>

@endsection
