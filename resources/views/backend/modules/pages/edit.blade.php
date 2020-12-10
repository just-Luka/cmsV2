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
                            <form method="POST" action="{{ route('backend.pages.update', ['locale'=>App::getLocale(), 'id' => $item->id]) }}">
                                @csrf
                                <div class="card-body">
                                    @include('backend.widgets.forms.slug_input',
                                    [
                                        'edit' => $item->slug,
                                    ])
                                    @include('backend.widgets.forms.check_input',
                                    [
                                       'name'           => 'visible',
                                       'label'          => lang('visible'),
                                       'checked'        => $item->visible,
                                       'id'             => 'page-visible',
                                       'value'          => true,
                                    ])
                                    @include('backend.widgets.forms.default_selector',
                                    [
                                       'title' => lang('page_template'),
                                       'name'  => "template",
                                       'values'=> $templates,
                                       'match' => $item->template,
                                    ])
                                    @include('backend.widgets.forms.image_upload',
                                    [
                                       'title' => lang('file_upload'),
                                       'value' => $item->image ? asset('storage/'.$item->image) : '',
                                    ])
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ lang('save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        @if(\Session::has('updated'))
            <div class="col-md-4" style="margin-left:auto; margin-top: 6%">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
                    {{ $moduleName.' - '.lang('created_successfully') }}
                </div>
            </div>
        @endif
@endsection
