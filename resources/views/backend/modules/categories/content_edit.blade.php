@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle' => ucfirst($moduleName)])
    <div class="col-md-6" style="margin: auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ lang('translation') }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('backend.categories.transAction',['locale'=>App::getLocale(), 'id' => $item->id]) }}">
                    @csrf
                    <div class="row">
                        @include('backend.widgets.forms.center_input',
                        [
                          'title' => lang('category_name'),
                          'name'   => 'title',
                          'type'  => 'text',
                          'value' => $itemContent->title ?? '',
                          'placeholder' => lang('name'),
                          'disabled' => false
                        ])
                    </div>
                    <button type="submit" class="btn btn-block btn-primary" style="width: 30%; margin: auto;"> {{ lang('save') }}</button>
                </form>
            </div>
        </div>
    </div>
    @if(\Session::has('saved'))
        @include('backend.widgets.alerts.success_alert')
    @endif
@endsection
