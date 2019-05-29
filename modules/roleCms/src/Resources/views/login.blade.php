@extends('cms::index') 
@section('content')
<div class="login-wrapper">
    <div class="bg-pic">
        <img src="/assets/admin/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src="/assets/admin/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="/assets/admin/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">
        <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
        </div>
    </div>
    <div class="login-container bg-white">
        <div class="">
            <img src="/images/logo-black.png" alt="logo" data-src="/assets/admin/img/redicon.svg" class="img-fluid m-auto">
            <p class="p-t-35">Zaloguj się do swojego konta</p>
            <?= Form::open([]); ?>
            <div class="form-group form-group-default">
                <label>Email</label>
                <div class="controls">
                    <?= Form::text('email', old('email'), ['class' => 'form-control', 'required' => 'required']); ?>
                </div>
            </div>
            <div class="form-group form-group-default">
                <label>Hasło</label>
                <div class="controls">
                    <?= Form::password('password', ['class' => 'form-control', 'id' => 'form-login', 'required' => 'required']); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-end">
                    <a href="mailto:krspawlicki@gmail.com" class="text-info small">Pomoc? Napisz do nas</a>
                </div>
            </div>
            <button class="btn btn-primary mt-1" type="submit">Zaloguj</button>
            <?= Form::close(); ?>
            <div class="pull-bottom sm-pull-bottom">
                <div class=" pt-5">
                    <p>
                        <small>
                            © Pawlicki <?= date('Y'); ?> <a href="https://"class="text-info">Strony internetowe, Sklepy interentowe Olsztyn, Gdańsk</a>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection