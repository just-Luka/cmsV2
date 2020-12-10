@extends('frontend.layouts.auth')
@section('content')
    <main class="login-body">

        <!-- Login Admin -->
        <form class="form-default" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="login-form">
                <!-- logo-login -->
                <div class="logo-login">
                    <a href="{{ route('frontend.main.index', ['locale' => App::getLocale() ]) }}"><img src="{{ asset('courses/assets/img/logo/loder.png') }}" alt=""></a>
                </div>
                <h2>{{ lang('login_here')}}</h2>
                <div class="form-input">
                    <label for="name">{{ lang('email') }}</label>
                    <input  type="email" name="email" placeholder="{{ lang('email') }}">
                </div>
                @error('email')
                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                @enderror

                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="{{ lang('send') }}">
                </div>

                <!-- Forget Password -->
                <a href="{{ route('login') }}" class="forget">{{ lang('login') }}</a>
                <!-- Forget Password -->
                <a href="{{ route('register') }}" class="registration">{{ lang('registration') }}</a>
            </div>
        </form>
        <!-- /end login form -->
    </main>
    <video style="   position: fixed; right: 0; bottom: 0;
    min-width: 100%; min-height: 100%;
    width: auto; height: auto; z-index: -100;
    background-size: cover;" title="login" src="{{ asset('courses/assets/img/login-bg.mp4') }}" autoplay="true" muted="muted">
    </video>
@endsection
