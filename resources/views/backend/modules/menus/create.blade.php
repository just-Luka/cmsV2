@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>$moduleName])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('create') }}</h3>
                        </div>
                        @if($parentID)
                            <form method="POST" action="{{ route('backend.menus.store', ['locale'=>App::getLocale(), 'parentID' => $parentID]) }}">
                        @else
                            <form method="POST" action="{{ route('backend.menus.store', ['locale'=>App::getLocale()]) }}">
                        @endif
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.attachment_selector',
                                [
                                    'name'   => 'attachment',
                                    'values' => $attachments
                                ])

                                @include('backend.widgets.forms.left_input',
                                 [
                                  'title'          => lang('url'),
                                  'name'           => 'redirect',
                                  'type'           => 'text',
                                  'value'          => '',
                                  'placeholder'    => 'http(s)://',
                                  'required'       => false
                                ])
                                @include('backend.widgets.forms.check_input',
                                [
                                  'name'           => 'hyper_link',
                                  'label'          => lang('hyper_link'),
                                  'checked'        => false,
                                  'id'             => 'hyper_link',
                                  'value'          => true,
                                ])
                                @include('backend.widgets.forms.default_selector',
                                [
                                    'title' => lang('position'),
                                    'name'  => 'position',
                                    'values' => $positions
                                ])
                                @include('backend.widgets.forms.check_input',
                               [
                                 'name'           => 'visible',
                                 'label'          => lang('visible'),
                                 'checked'        => false,
                                 'id'             => 'page-visible',
                                 'value'          => true,

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

@push('scripts')
    <script>
        const hyperLink = $('#hyper_link')
        const attachment = $('#default_select')
        const concreteAttachment = $('#concrete_attachment')
        const redirect = $('input[name = "redirect"]')
        redirect.prop('disabled', true)
        hyperLink.on('click', () => {
            if (hyperLink.is(':checked')){
                attachment.prop('disabled', true)
                concreteAttachment.prop('disabled', true)
                redirect.prop('disabled', false)
            }else {
                attachment.prop('disabled', false)
                concreteAttachment.prop('disabled', false)
                redirect.prop('disabled', true)
            }
        })
    </script>
@endpush
