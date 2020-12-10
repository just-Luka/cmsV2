@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $moduleName }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard', App::getLocale()) }}">{{ lang('go_back') }}</a></li>
                            <li class="breadcrumb-item active">{{ $moduleName }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="col-md-6" style="margin: auto">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ lang('add_new_translation') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <form method="POST" action="{{ route('backend.languages.destroy',['locale'=>App::getLocale()]) }}">
                        @csrf
                        <p style="font-weight: bold; font-size: 24px">{{ lang('choose_language') }}</p>
                        @foreach($languages as $lang)
                            <div class="form-check" style="margin-bottom: 8px">
                                <input class="form-check-input" type="checkbox" name="{{ $lang }}" value="{{ $lang }}" id="{{ $lang }}_checkbox">
                                <label class="form-check-label">{{ $lang }}</label>
                            </div>
                        @endforeach
                        @error('language')
                        <p style="padding-left:15px; color:red">* {{ $message }}</p>
                        @enderror
                        @error('lastElement')
                        <p style="padding-left:15px; color:red">* {{ $message }}</p>
                        @enderror
                        <div class="col-sm-2" style="margin: auto">
                            <button type="submit" class="btn btn-block btn-danger"> {{ lang('remove') }}</button>
                        </div>
                    </form>
                </div>

                <!-- /.card-body -->
            </div>
        </div>
        @include('backend.widgets.alerts.white_alert')
        @if(\Session::has('deleted'))
            <div class="col-md-4" style="margin-left:auto; margin-top: 22%">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
                    {{ $moduleName.' - '.lang('deleted_successfully') }}
                </div>
            </div>
        @endif
@endsection
