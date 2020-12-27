@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('edit') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('backend.banners.update', ['locale'=>App::getLocale(), 'id' => $item->id]) }}">
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.left_input',
                                [
                                  'title'          => lang('url'),
                                  'name'           => 'url',
                                  'type'           => 'text',
                                  'value'          => $item->url,
                                  'placeholder'    => 'http://',
                                  'required'       => false
                                ])
                                @include('backend.widgets.forms.check_input',
                                [
                                    'name'           => 'visible',
                                    'label'          => lang('visible'),
                                    'checked'        => $item->visible,
                                    'id'             => 'banner-visible',
                                    'value'          => true
                                ])
                                @include('backend.widgets.forms.image_upload',
                                [
                                    'title' => lang('image'),
                                    'value' => $item->src ? asset('storage/'.$item->src) : '',
                                ])
                                @include('backend.widgets.forms.default_selector',
                                [
                                    'title' => lang('position'),
                                    'name'  => 'position',
                                    'match' => $item->type,
                                    'values'=> $types,
                                ])
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ lang('update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(\Session::has('updated'))
        @include('backend.widgets.alerts.success_alert')
    @endif

@endsection
