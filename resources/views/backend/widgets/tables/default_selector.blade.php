<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="dataTables_length">
                    <form method="GET" action="{{ route('backend.'.$module.'.index', ['locale' => App::getLocale()]) }}">
                        <label>
                            <select class="custom-select" style="width: auto;" name="type" id="default-selector">
                                <option value="">{{ ucfirst(lang('all')) }}</option>

                                @foreach($values as $value)
                                    @if($value === $match)
                                        <option value="{{ $value }}" selected>{{ ucfirst($value) }}</option>
                                    @else
                                        <option value="{{ $value }}">{{ ucfirst($value) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                        <button type="submit" id="submit-selected" hidden></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $('#default-selector').on('change',function (e) {
            $('#submit-selected').click();
        })
    </script>
@endpush
