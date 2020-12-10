@include('backend.widgets.forms.default_selector',
                                 [
                                     'title' => lang('attachment'),
                                     'name'  => $name,
                                     'values'=> $values,
                                 ])
<div class="form-group" id="concrete_attachment_div" hidden>
    <label>{{ lang('concrete_attachment') }}</label>
    <select class="form-control" name="concrete_attachment" id="concrete_attachment">

    </select>
</div>
@error('concrete_attachment')
<p style="padding-left:15px; color:red">* {{ $message }}</p>
@enderror


@push('scripts')
    <script>
        let currentAttachment = $('#default_select');
        let url = `{{ route('backend.requests.attachment', ['locale' => App::getLocale(), 'modelName' => 'ModelName']) }}`;
        let fetchAttachments = (choseURL) => {
            return new Promise((resolve) => {
                $.ajax({
                    url: choseURL,
                    type: "GET",
                    success: (response) => {
                        let concreteAttachmentDiv = $('#concrete_attachment_div');
                        if(!response.length){
                            concreteAttachmentDiv.prop('hidden', true)
                        }else {
                            concreteAttachmentDiv.prop('hidden', false)
                        }
                        resolve(response)
                    }
                })
            })
        }
        currentAttachment.on('click', () => {
            $('#concrete_attachment').children().remove();
            let choseURL = url.replace('ModelName', currentAttachment.val())
            fetchAttachments(choseURL)
                .then((attachment) => {
                    Object.keys(attachment).map((key) => {
                        $('#concrete_attachment').append(`<option value="${attachment[key].id}" selected>${attachment[key].translation ? attachment[key].translation.title : '####'}</option>`)
                    })
                })
        });
    </script>
@endpush
