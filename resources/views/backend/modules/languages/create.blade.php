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
              <h3 class="card-title">{{ lang('create') }}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form method="POST" action="{{ route('backend.languages.store',['locale'=>App::getLocale()]) }}">
                @csrf
                <div class="row">
                    @include('backend.widgets.forms.center_input',
                    [
                      'title' => lang('country'),
                      'name'   => 'country',
                      'type'  => 'text',
                      'value' => '',
                      'placeholder' => lang('enter country'),
                      'disabled' => false
                    ])
                </div>
                <div class="row">
                      @include('backend.widgets.forms.center_input',
                      [
                        'title' => lang('iso_code'),
                        'name'   => 'lang',
                        'type'  => 'text',
                        'value' => '',
                        'placeholder' => lang('enter_code'),
                        'disabled' => false
                      ])
                  </div>
                <div class="col-sm-2" style="margin: auto">
                  <button type="submit" class="btn btn-block btn-primary"> {{ lang('create') }}</button>
                </div>
              </form>
              <a href="https://www.w3schools.com/tags/ref_language_codes.asp">{{ lang('find_iso_code') }}</a>
            </div>

            <!-- /.card-body -->
          </div>
    </div>
    @if(\Session::has('created'))
            <div id="toast-container" class="toast-top-right">
                <div class="toast toast-success" aria-live="polite" style="">
                    <div class="toast-message">Language is added successfully!</div>
                </div>
            </div>

            @push('scripts')
                <script>
                    $('#toast-container').on('click', () => {
                        $('#toast-container').prop('hidden', true);
                    })
                </script>
            @endpush

            @push('styles')
                <link rel="stylesheet" href="{{ asset('adminLTE/plugins/toastr/toastr.min.css') }}">
            @endpush
    @endif
@endsection
