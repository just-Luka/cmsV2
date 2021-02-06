@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle' => $moduleName])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('create') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('backend.offers.store', ['locale'=>App::getLocale()]) }}">
                            @csrf
                            <div class="card-body">
                                @include('backend.widgets.forms.slug_input',
                                [
                                    'edit' => false,
                                ])
                                @include('backend.widgets.forms.check_input',
                                [
                                   'name'           => 'visible',
                                   'label'          => lang('visible'),
                                   'checked'        => false,
                                   'id'             => 'product-visible',
                                   'value'          => true,
                                ])
                                @include('backend.widgets.forms.product_selector',
                                 [
                                     'matches' => ''
                                 ])
                                <div class="form-group">
                                    <label>{{ lang('price') }}</label>
                                    <input type="number" name="price" class="form-control" placeholder="{{ lang('enter_price') }}" step="0.01" required>
                                </div>
                                @error('price')
                                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                @enderror

                                @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('offer_end'),
                                   'name'           => 'offer_end',
                                   'type'           => 'datetime-local',
                                   'value'          => '',
                                   'placeholder'    => 'time',
                                   'required'       => false
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
@endsection
