<div class="form-group">
    <label>{{ $title }}</label>
    <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                <i class="fa fa-picture-o"></i> {{ lang('choose_file') }}
            </a>
        </span>
        <input id="thumbnail" value="{{ $value }}" class="form-control" type="text" name="filepath" readonly>
    </div>
</div>
<div id="holder" style="margin-top:15px;max-height:100px;">
    @if($files)
        @foreach($files as $item)
            <img src="{{ $item->url }}" style="height: 5rem;">
        @endforeach
    @endif
</div>
<div class="form-check" style="margin-bottom: 8px">
    <input class="form-check-input" type="checkbox" name="have_image" value="true" id="have_image">
    <label class="form-check-label">{{ lang("image_on") }}</label>
</div>

@push('scripts')
    <script>
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
    </script>

    <script>
        $('#lfm').filemanager('file', {prefix: '/filemanager'});
    </script>
@endpush
