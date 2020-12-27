<div class="form-group">
    <label>{{ lang('tag') }}</label>
    <select name="tag" id="tag" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;">
        @if(!$matches)
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->translation->title ?? '####' }}</option>
            @endforeach
        @else
            @foreach($tags as $tag)
                @foreach($matches as $myTag)
                    @if($myTag->id == $tag->id)
                        <option value="{{ $tag->id }}" selected>{{ $tag->translation->title ?? '####'}}</option>
                        @continue(2);
                    @endif
                @endforeach
                <option value="{{ $tag->id }}">{{ $tag->translation->title ?? '####' }}</option>
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
            $('#tag').select2()

            let tagInput = (value) => { return `<input type="hidden" name="tag_${value}" value="${value}">` }

            $('#tag').on('change', () => {
                $('.select2-selection__choice').css({'background-color': '#007bff'})
            })
            $('button').on('click', (e) => {
                $('#tag').val().forEach((val) => {
                    $('form').append(tagInput(val))
                })
            })
        })
    </script>
@endpush
