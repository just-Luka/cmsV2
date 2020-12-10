@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('backend.events.transAction', ['locale'=>App::getLocale(), 'id'=> $eventData->id]) }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('title'),
                                   'name'           => 'title',
                                   'type'           => 'text',
                                   'value'          => $eventTransData->title ?? '',
                                   'placeholder'    => lang('enter_meta_title'),
                                   'required'       => false
                                ])
                        @if($eventData->attachment !== 'posts' || $eventData->shape === 'square')
                            @include('backend.widgets.forms.left_input',
                            [
                               'title'          => lang('meta_title'),
                               'name'           => 'meta_title',
                               'type'           => 'text',
                               'value'          => $eventTransData->meta_title ?? '',
                               'placeholder'    => lang('enter_meta_title'),
                               'required'       => false
                            ])
                        @endif
                    </div>
                    @if($eventData->attachment === 'posts' && $eventData->shape !== 'square')
                        @include('backend.widgets.forms.texteditor',
                        [
                            'title' => lang('content'),
                            'value' => $eventTransData->content ?? ''
                        ])
                    @endif
                    <div class="col-md-12">
                        <p class="mt-4"></p>
                        <button type="submit" class="btn btn-primary">{{ lang('save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @if(\Session::has('updated'))
        @if($eventData->attachment !== 'posts' || $eventData->shape === 'square')
            <div class="col-md-4" style="margin-left:auto; margin-top: 24%">
        @else
            <div class="col-md-4" style="margin-left:auto; margin-top: 11%">
        @endif
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
                {{ $moduleName.' - '.lang('updated_successfully') }}
            </div>
        </div>
    @endif
@endsection
