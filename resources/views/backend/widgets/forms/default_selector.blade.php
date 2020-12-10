<div class="form-group">
    <label>{{ $title }}</label>
    <select class="form-control" name="{{ $name }}" id="default_select">
        @foreach($values as $value)
            @if(isset($match) && ($match === $value))
                <option value="{{ $value }}" selected>{{ $value }}</option>
            @else
                <option value="{{ $value }}">{{ $value }}</option>
            @endif
        @endforeach
    </select>
</div>
