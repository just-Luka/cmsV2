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
                        <form method="POST" action="{{ route('backend.users.update', ['locale'=>App::getLocale(), 'id' => $item->id,]) }}">
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('username'),
                                   'name'           => 'name',
                                   'type'           => 'text',
                                   'value'          => $item->name,
                                   'placeholder'    => 'Enter username',
                                   'required'       => true
                                ])
                                <div class="form-group">
                                    <label>{{ lang('status') }}</label>
                                    <select class="form-control" name="selectedRole" id="role-selector">
                                        <option value="">User</option>
                                        @foreach($roles as $role)
                                            @if($role->status === ($userRole ? $userRole->status : null))
                                                <option value="{{ $role->id }}" selected>{{ $role->status }}</option>
                                            @else
                                                <option value="{{ $role->id }}">{{ $role->status }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>{{ lang('email') }}</label>
                                    <input type="email" value="{{ $item->email }}" name="email" class="form-control" disabled>
                                </div>
                                @error('email')
                                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                @enderror

                                <div class="form-group">
                                    <label>{{ lang('password') }}</label>
                                    <input type="password" value="noPasswordChanged" name="password" class="form-control" id="user-password-access" disabled>
                                </div>
                                @error('password')
                                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                @enderror

                                @include('backend.widgets.forms.check_input',
                                [
                                    'label'         => lang('i_wanna_change_user_password'),
                                    'checked'       => false,
                                    'name'          => 'allow_pass_change',
                                    'value'         => true,
                                    'id'            => 'allow_pass_change'
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
        @include('backend.widgets.alerts.success_alert')
    @endif
@endsection
