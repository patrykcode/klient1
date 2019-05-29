<!DOCTYPE html>
<html>
    <head>
        @include('cms::includes.head')
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body class=""> 
        @if(Auth::guard()->check())

        @include('cms::includes.menu')

        <div class="header p-3" style="box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.4);">
            <div class="row">
                <div class="col-lg-3 col-md">
                    <div class="brand inline text-lg-left text-center">
                        <img src="/images/logo-black.png" alt="logo" width="160" class="img-fluid">
                    </div>
                </div>
                <div class="text-right col-lg-9 d-none">
                    <div class="btn-group sm-m-t-10">
                        <a href="/" class="btn btn-default" target="_blank">
                            przejdz do strony
                        </a>
                        <div class="btn btn-default">
                            <span class="semi-bold"><?= Auth::user()->name; ?></span>
                        </div>
                        <a href="/logout" class="btn btn-default"><i class="fs-20 pg-power"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container-fluid">
                <h3 class="page-title text-uppercase"><?= isset($title) ? $title : '&nbsp;' ?></h3>
                
                @yield('content')
            </div>
        </div>
        
        @else
        @yield('content')
        @endif
        
        @include('cms::includes.alerts')
        @include('cms::includes.javascripts')
        
    </body>
</html>