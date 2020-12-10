<div id="string-to-slug">
</div>
@error('slug')
<p style="padding-left:15px; color:red">* {{ $message }}</p>
@enderror

@if($edit)
    @push('scripts')
        <script>
            $('#string-to-slug').ready(function(){
                $('#string-to-slug').find('input').val(() => {
                    let slug = {!! json_encode($edit) !!}

                        return slug
                })
            })
        </script>
    @endpush
@endif
