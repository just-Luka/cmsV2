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
        <div id="toast-container" class="toast-top-right">
            <div class="toast toast-success" aria-live="polite" style="">
                <div class="toast-message">{{ lang("saved_successfully") }}</div>
            </div>
        </div>

        @push('scripts')
            <script>
                $('#toast-container').on('click', () => {
                    $('#toast-container').prop('hidden', true);
                })
            </script>
        @endpush

        @push('styles')
            <link rel="stylesheet" href="{{ asset('adminLTE/plugins/toastr/toastr.min.css') }}">
        @endpush

        @include('backend.widgets.alerts.success_alert')
    @endif
@endsection
