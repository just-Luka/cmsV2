<div class="col-md-12">
    <h2 class="mt-4">{{ $title }}</h2>
    <textarea name="tm" class="form-control">{{ $value }}</textarea>
</div>

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/cymm0a3mn1gqpheywxky9ivzs52esv0g3dd6d4225lrwygfn/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        var editor_config = {
            path_absolute : "",
            selector: "textarea[name=tm]",
            theme: "silver",
            plugins: [
                "link image",
            ],
            relative_urls: false,
            height: 300,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
                if (type === 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endpush
