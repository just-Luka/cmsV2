@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>$moduleName])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('create_user') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('backend.users.store', ['locale'=>App::getLocale()]) }}">
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('username'),
                                   'name'           => 'name',
                                   'type'           => 'text',
                                   'value'          => '',
                                   'placeholder'    => 'Enter username',
                                   'required'       => true
                                ])
                                <div class="form-group">
                                    <label>{{ lang('status') }}</label>
                                    <select class="form-control" name="selectedRole" id="role-selector">
                                        <option value="">User</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('email'),
                                   'name'           => 'email',
                                   'type'           => 'email',
                                   'value'          => '',
                                   'placeholder'    => 'Enter email',
                                   'required'       => true
                                ])
                                @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('password'),
                                   'name'           => 'password',
                                   'type'           => 'password',
                                   'value'          => '',
                                   'placeholder'    => 'Enter password',
                                   'required'       => true
                                ])
                                @include('backend.widgets.forms.image_upload',
                                [
                                   'title' => lang('file_upload'),
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
    @if(\Session::has('created'))
        <div class="col-md-4" style="margin-left:auto; margin-top: 2%">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
            {{ $moduleName.' - '.lang('created_successfully') }}
        </div>
    </div>
    @endif
@endsection
