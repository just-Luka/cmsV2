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
        @include('backend.widgets.alerts.success_alert')
    @endif
@endsection
