<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <?php
        $active = \Illuminate\Support\Facades\Session::get('active');
                use Carbon\Carbon;
                use App\Helper\NumberFr;
                $locale = app()->getLocale();
                $uxxx = App\User::find(auth()->user()->id);
                Carbon::setlocale($locale);
                $date = Carbon::now();
                $translatedDate = $date->translatedFormat('D, j M Y, H:i:s');
    ?>
<div class="wrapper">
  <!-- Preloader -->
  <div style="background: linear-gradient(to right, #303030,#FFFFFF,#303030);" class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="ORCA RECOVERY MANAGER" height="160" width="160">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" role="button">{{ $uxxx->name }} / <b>{{ $uxxx->role?$uxxx->role->name:''}}</b></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <p>
            <?php echo($translatedDate);?>
        </p>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-1">
    <!-- Brand Logo -->
    <img style="max-width: 100%; margin:0 50px; margin-top: 17px; max-height: 100px;" src="{{ asset('img/logo.png') }}" class="brand-image elevation-0" alt="">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(auth()->user()->apercu)
                <li class="nav-item {{ $active==1?'active':'' }}">
                    <a href="/admin/dashboard" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        APERCU
                    </p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->suivi)
                <li class="nav-item {{ $active==2?'active':'' }}">
                    <a href="/admin/suivi" class="nav-link">
                    <i class="nav-icon material-icons">verified_user</i>
                    <p>
                        SUIVI
                    </p>
                    </a>
                </li>
            @endif
            @if(auth()->user()->actions)
            <li class="nav-item {{ $active==3?'active':'' }}">
                <a href="/admin/actions" class="nav-link">
                <i class="nav-icon material-icons">spellcheck</i>
                <p>
                    ACTIONS
                </p>
                </a>
            </li>
          @endif
          @if(auth()->user()->parametres)
            <li class="nav-item {{ $active==4?'active':'' }}">
                <a href="/admin/parametres" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    PARAMETRES
                </p>
                </a>
            </li>
          @endif
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-arrow-left"></i>
              <p>
                DECONNEXION
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div style="background: rgba(255, 255, 255, 0.726)" class="content-wrapper">


    <!-- Main content -->
    <section class="content" style="">
        <div class="container">
            @include('includes.flash-message')
       </div>
        @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('includes.foot')
<style>
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #303030;
        border-color: #303030;
    }
    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #303030;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .btn-pink {
            color: #fff;
            background-color: #303030;
            border-color: #303030;
            box-shadow: none;
    }
</style>

</body>
</html>
