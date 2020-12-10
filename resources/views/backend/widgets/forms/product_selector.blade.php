<div class="form-group">
    <label>{{ lang('products') }}</label>
    <select name="product" id="product" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;">
        @if(!$matches)
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->translation->title ?? '####' }}</option>
            @endforeach
        @else
            @foreach($products as $product)
                @foreach($matches as $myProduct)
                    @if($myProduct->id == $product->id)
                        <option value="{{ $product->id }}" selected>{{ $product->translation->title ?? '####' }}</option>
                        @continue(2);
                    @endif
                @endforeach
                <option value="{{ $product->id }}">{{ $product->translation->title ?? '####' }}</option>
            @endforeach
        @endif
    </select>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/select2/css/select2.min.css')}}">
@endpush
@push('scripts')
    <script src="{{ asset('adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('#product').select2()

            let tagInput = (value) => { return `<input type="hidden" name="product_${value}" value="${value}">` }

            $('#product').on('change', () => {
                $('.select2-selection__choice').css({'background-color': '#007bff'})
            })
            $('button').on('click', (e) => {
                $('#product').val().forEach((val) => {
                    $('form').append(tagInput(val))
                })
            })
        })
    </script>
@endpush
