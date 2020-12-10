@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle' => $moduleName])
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('backend.products.transAction', ['locale'=>App::getLocale(), 'id'=> $item->id]) }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('title'),
                                   'name'           => 'title',
                                   'type'           => 'text',
                                   'value'          => $itemContent->title ?? '',
                                   'placeholder'    => lang('enter_title'),
                                   'required'       => true
                                ])
                    </div>
                    <div class="col-md-6">
                        @include('backend.widgets.forms.file_upload',
                         [
                              'title'         => lang('file_upload'),
                              'value'         => $fileString,
                              'files'         => $mediaFileData
                         ])
                    </div>
                    @include('backend.widgets.forms.texteditor',
                    [
                        'title' => lang('content'),
                        'value' => $itemContent->desc ?? '',
                    ])
                    <div class="col-md-12">
                        <p class="mt-4"></p>
                        <button type="submit" class="btn btn-primary">{{ lang('save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @if(\Session::has('updated'))
        <div class="col-md-4" style="margin-left:auto; margin-top: 12%">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
                {{ $moduleName.' - '.lang('updated_successfully') }}
            </div>
        </div>
    @endif
@endsection
