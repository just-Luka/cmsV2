@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle' => $moduleName])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6" style="margin: auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ lang('edit_product') }}</h3>
                        </div>
                        <form method="POST" action="{{ route('backend.products.update', ['locale'=>App::getLocale(), 'id' => $item->id]) }}">
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
                                <div class="form-group">
                                    <label>{{ lang('price') }}</label>
                                    <input type="number" name="price" value="{{ $item->price }}" class="form-control" placeholder="{{ lang('enter_price') }}" step="0.01" required>
                                </div>
                                @error('price')
                                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>{{ lang('new_price') }}</label>
                                    <input type="number" name="new_price" value="{{ $item->new_price }}"  class="form-control" placeholder="{{ lang('enter_discounted_price') }}" step="0.01">
                                </div>
                                @error('new_price')
                                <p style="padding-left:15px; color:red">* {{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label>{{ lang('brands') }}</label>
                                    <select class="form-control" name="brand" id="default_select">
                                        @foreach($brands as $brand)
                                            @if($brand->id === $productData->brand_id)
                                                <option value="{{ $brand->id }}" selected>{{ $brand->translation->title }}</option>
                                            @else
                                                <option value="{{ $brand->id }}">{{ $brand->translation->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @include('backend.widgets.forms.category_selector',
                                [
                                    'matches' => $myCategories,
                                ])
                                @include('backend.widgets.forms.tag_selector',
                                [
                                    'matches' => $myTags,
                                ])
                                @include('backend.widgets.forms.image_upload',
                                  [
                                      'title' => lang('file_upload'),
                                      'value' => $item->image ? asset('storage/'.$item->image): '',
                                  ])
{{--                                @include('backend.widgets.forms.check_input',--}}
{{--                                [--}}
{{--                                 'name'           => 'on_main',--}}
{{--                                 'label'          => lang('show_on_main'),--}}
{{--                                 'checked'        => $productData->on_main,--}}
{{--                                 'id'             => '',--}}
{{--                                 'value'          => true,--}}
{{--                                ])--}}
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
        <div class="col-md-4" style="margin-left:auto; margin-top: 1%">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> {{ lang('alert') }}!</h5>
                {{ $moduleName.' - '.lang('updated_successfully') }}
            </div>
        </div>
    @endif
@endsection
