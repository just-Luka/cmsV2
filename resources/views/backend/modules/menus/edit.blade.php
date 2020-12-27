@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>$moduleName])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('edit') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('backend.menus.update', ['locale'=>App::getLocale(), 'id'=> $item->id]) }}">
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.default_selector',
                                [
                                    'title' => lang('position'),
                                    'name'  => 'position',
                                    'values'=> $positions,
                                    'match' => $item->position
                                ])
                                @include('backend.widgets.forms.check_input',
                                [
                                  'title'          => lang('slug'),
                                  'name'           => 'visible',
                                  'label'          => lang('visible'),
                                  'checked'        => $item->visible,
                                  'id'             => 'page-visible',
                                  'value'          => true,

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

