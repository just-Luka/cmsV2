@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('event_create') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('backend.events.store', ['locale'=>App::getLocale()]) }}">
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.attachment_selector',
                                [
                                    'name'   => 'attachment',
                                    'values' => $attachments
                                ])
                                @include('backend.widgets.forms.default_selector',
                                [
                                    'title' => lang('shape'),
                                    'name'  => 'shape',
                                    'values'=> $shapes,
                                ])
                                @include('backend.widgets.forms.check_input',
                                  [
                                    'title'          => lang('slug'),
                                    'name'           => 'visible',
                                    'label'          => lang('visible'),
                                    'checked'        => false,
                                    'id'             => 'page-visible',
                                    'value'          => true,
                                  ])
                                @include('backend.widgets.forms.image_upload',
                                [
                                   'title' => lang('border'),
                                   'value' => '',
                                ])
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ lang('create') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

