@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header',['moduleTitle'=>ucfirst($moduleName)])
    <div class="col-md-6" style="margin: auto">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ lang('create') }}</h3>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('backend.translation.store',['locale'=>App::getLocale()]) }}">
                @csrf
                <div class="row">
                    @include('backend.widgets.forms.center_input',
                    [
                      'title' => lang('key_word'),
                      'name'   => 'key',
                      'type'  => 'text',
                      'value' => '',
                      'placeholder' => 'Enter key',
                      'disabled' => false
                    ])
                </div>
                <div class="row">
                  @foreach ($languages as $index=>$locale)
                  <div class="col-sm-6" style="margin: auto">
                    @include('backend.widgets.forms.center_textarea',
                    [
                      'title' => lang('meaning ').' '.strtoupper($locale),
                      'name'  => $locale,
                      'rows'  => 3,
                      'value' => '',
                      'placeholder' => 'Enter ...',
                      'disabled' => false,
                    ])
                  </div>
                  @endforeach
                </div>
                @include('backend.widgets.forms.check_input',
                [
                 'name'           => 'is_backend',
                 'label'          => lang('is_backend'),
                 'checked'        => true,
                 'id'             => 'translation-side',
                 'value'          => 1,
                ])
                <button type="submit" class="btn btn-block btn-primary" style="width: 30%; margin: auto;"> {{ lang('create') }}</button>
              </form>
            </div>
          </div>
    </div>
@if(\Session::has('created'))
    <div id="toast-container" class="toast-top-right">
        <div class="toast toast-success" aria-live="polite" style="">
            <div class="toast-message">Translation is created successfully!</div>
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
