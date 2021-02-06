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
                        <form method="POST" action="{{ route('backend.roles.update', ['locale'=>App::getLocale(), 'id' => $item->id]) }}">
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('status'),
                                   'name'           => 'status',
                                   'type'           => 'text',
                                   'value'          => $item->status,
                                   'placeholder'    => lang('enter_status'),
                                   'required'       => true
                                ])
                                <div class="form-group">
                                    <label>{{ lang('permissions') }}</label>
                                    <ul>
                                        @include('backend.modules.roles.perm_list')
                                    </ul>
                                </div>
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
@endsection
