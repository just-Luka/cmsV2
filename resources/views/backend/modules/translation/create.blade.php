@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header',['moduleTitle'=>ucfirst($moduleName)])
    <div class="col-md-6" style="margin: auto">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ lang('add_new_translation') }}</h3>
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
                 'checked'        => false,
                 'id'             => 'translation-side',
                 'value'          => 1,
                ])
                <button type="submit" class="btn btn-block btn-primary" style="width: 30%; margin: auto;"> {{ lang('create') }}</button>
              </form>
            </div>
          </div>
    </div>
@if(\Session::has('created'))
    <div class="col-md-4" style="margin-left:auto; margin-top: 15%">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
            {{ $moduleName.' - '.lang('created_successfully') }}
        </div>
    </div>
@endif
@endsection
