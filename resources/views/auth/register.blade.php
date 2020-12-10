@extends('frontend.layouts.auth')
@section('content')
    <main class="login-body">
        <!-- Login Admin -->
        <form class="form-default" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="login-form">
                <div class="logo-login">
                    <a href="{{ route('frontend.main.index', ['locale'=> App::getLocale()]) }}"><img src="{{ asset('courses/assets/img/logo/loder.png') }}" alt=""></a>
                </div>
                <h2>{{ lang('registration') }}</h2>

                <div class="form-input">
                    <label for="name">{{ lang('full_name') }}</label>
                    <input  type="text" name="name" placeholder="{{ lang('full_name') }}">
                </div>
                @error('name')
                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                @enderror
                <div class="form-input">
                    <label for="name">{{ lang('email_address') }}</label>
                    <input type="email" name="email" placeholder="{{ lang('email_address') }}">
                </div>
                @error('email')
                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                @enderror
                <div class="form-input">
                    <label for="name">{{ lang('password') }}</label>
                    <input type="password" name="password" placeholder="{{ lang('password') }}">
                </div>
                @error('password')
                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                @enderror
                <div class="form-input">
                    <label for="name">{{ lang('password_confirmation') }}</label>
                    <input type="password" name="password_confirmation" placeholder="{{ lang('confirm_password') }}">
                </div>
                <div class="form-input pt-30">
                    <input type="submit" name="submit" value="{{ lang('registration') }}">
                </div>
                <!-- Forget Password -->
                <a href="{{ route('login') }}" class="registration">{{ lang('login') }}</a>
            </div>
        </form>

        <video style="   position: fixed; right: 0; bottom: 0;
    min-width: 100%; min-height: 100%;
    width: auto; height: auto; z-index: -100;
    background-size: cover;" title="login" src="{{ asset('courses/assets/img/login-bg.mp4') }}" autoplay="true" muted="muted">
        </video>
    </main>
@endsection
