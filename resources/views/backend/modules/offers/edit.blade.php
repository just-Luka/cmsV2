@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle' => $moduleName])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('edit') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('backend.offers.update', ['locale'=>App::getLocale(), 'id' => $item->id]) }}">
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
                                   'id'             => 'product-visible',
                                   'value'          => true,
                                ])
                                @include('backend.widgets.forms.product_selector',
                                 [
                                     'matches' => $myProducts
                                 ])
                                <div class="form-group">
                                    <label>{{ lang('price') }}</label>
                                    <input type="number" name="price" value="{{ $item->price }}" class="form-control" placeholder="{{ lang('enter_price') }}" step="0.01" required>
                                </div>
                                @error('price')
                                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                @enderror

                                @include('backend.widgets.forms.left_input',
                                [
                                   'title'          => lang('offer_end'),
                                   'name'           => 'offer_end',
                                   'type'           => 'datetime-local',
                                   'value'          => $item->offer_end,
                                   'placeholder'    => 'time',
                                   'required'       => false
                                ])
                                <div class="form-group">
                                    <input type="text" name="old_time" value="{{ $item->offer_end }}" class="form-control" readonly>
                                </div>

                                @include('backend.widgets.forms.image_upload',
                                [
                                   'title' => lang('file_upload'),
                                   'value' => $item->image ? asset('storage/'.$item->image) : '',
                                ])
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ lang('updated') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(\Session::has('updated'))
        <div class="col-md-4" style="margin-left:auto; margin-top: 1%">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
                {{ $moduleName.' - '.lang('updated_successfully') }}
            </div>
        </div>
    @endif
@endsection
