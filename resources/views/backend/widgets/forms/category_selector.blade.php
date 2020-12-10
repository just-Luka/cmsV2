<div class="form-group">
    <label>{{ lang('category') }}</label>
    <select id="category" name="category" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;">
        @if(!$matches)
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->translation->title }}</option>
            @endforeach
        @else
            @foreach($categories as $category)
                @foreach($matches as $myCategory)
                    @if($myCategory->id == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->translation->title }}</option>
                        @continue(2);
                    @endif
                @endforeach
                <option value="{{ $category->id }}">{{ $category->translation->title }}</option>
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
            $('#category').select2()

            let categoryInput = (value) => { return `<input type="hidden" name="category_${value}" value="${value}">` }

            $('#category').on('change', () => {
                $('.select2-selection__choice').css({'background-color': '#007bff'})
            })
            $('button').on('click', (e) => {
                $('#category').val().forEach((val) => {
                    $('form').append(categoryInput(val))
                })
            })
        })
    </script>
@endpush
