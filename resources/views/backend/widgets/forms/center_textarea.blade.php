<div class="form-group">
    <label style="padding-left:39%">{{ $title }}</label>
    @if($disabled ?? null)
        <textarea class="form-control" name="{{ $name }}" rows="{{ $rows ?? 3 }}" placeholder="{{ $placeholder ?? "Enter ..."}}" disabled>{{ $value ?? '' }}</textarea>
    @else
        <textarea class="form-control" name="{{ $name }}" rows="{{ $rows ?? 3 }}" placeholder="{{ $placeholder ?? "Enter ..."}}">{{ $value ?? ''}}</textarea>
    @endif
</div>
