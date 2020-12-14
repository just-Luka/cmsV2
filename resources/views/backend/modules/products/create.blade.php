@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle' => $moduleName])
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6" style="margin: auto">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ lang('create_products') }}</h3>
                            </div>
                            <form method="POST" action="{{ route('backend.products.store', ['locale'=>App::getLocale()]) }}">
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
                                    <div class="form-group">
                                        <label>{{ lang('price') }}</label>
                                        <input type="number" name="price" class="form-control" placeholder="{{ lang('enter_price') }}" step="0.01" required>
                                    </div>
                                    @error('price')
                                    <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                    @enderror
                                    <div class="form-group">
                                        <label>{{ lang('new_price') }}</label>
                                        <input type="number" name="new_price" class="form-control" placeholder="{{ lang('enter_discounted_price') }}" step="0.01">
                                    </div>
                                    @error('new_price')
                                    <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                    @enderror
                                    <div class="form-group">
                                        <label>{{ lang('brands') }}</label>
                                        <select class="form-control" name="brand" id="default_select">
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->translation->title ?? '####' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- TODO category, tag, selector rename as multiple selector! --}}
                                    @include('backend.widgets.forms.category_selector',
                                    [
                                        'matches' => ''
                                    ])
                                    @include('backend.widgets.forms.tag_selector',
                                    [
                                        'matches' => ''
                                    ])
                                    @include('backend.widgets.forms.image_upload',
                                    [
                                       'title' => lang('file_upload'),
                                       'value' => '',
                                    ])
{{--                                    @include('backend.widgets.forms.check_input',--}}
{{--                                    [--}}
{{--                                     'name'           => 'on_main',--}}
{{--                                     'label'          => lang('show_on_main'),--}}
{{--                                     'checked'        => false,--}}
{{--                                     'id'             => '',--}}
{{--                                     'value'          => true,--}}
{{--                                    ])--}}
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
