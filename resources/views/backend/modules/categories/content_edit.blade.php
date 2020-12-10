@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle' => ucfirst($moduleName)])
    <div class="col-md-6" style="margin: auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ lang('category_trans') }}</h3>
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
                          'placeholder' => 'Enter name',
                          'disabled' => false
                        ])
                    </div>
                    <button type="submit" class="btn btn-block btn-primary" style="width: 30%; margin: auto;"> {{ lang('save') }}</button>
                </form>
            </div>
        </div>
    </div>
    @if(\Session::has('saved'))
        <div class="col-md-4" style="margin-left:auto; margin-top: 26%">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
                {{ $moduleName.' - '.lang('created_successfully') }}
            </div>
        </div>
    @endif
@endsection
