@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('backend.sliders.transAction', ['locale'=>App::getLocale(), 'id'=> $item->id]) }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('meta_title'),
                                   'name'           => 'meta_title',
                                   'type'           => 'text',
                                   'value'          => $itemContent->meta_title ?? '',
                                   'placeholder'    => lang('enter_meta_title'),
                                   'required'       => false
                                ])
                    </div>
                    @include('backend.widgets.forms.texteditor',
                    [
                        'title' => lang('content'),
                        'value' => $itemContent->content ?? ''
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
