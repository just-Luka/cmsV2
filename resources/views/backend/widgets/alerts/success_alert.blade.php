<div id="toast-container" class="toast-top-right">
    <div class="toast toast-success" aria-live="polite" style="">
        <div class="toast-message">{{ lang("updated_successfully") }}</div>
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
