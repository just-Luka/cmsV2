<div class="col-sm-10" style="margin: auto">
    <div class="form-group">
        <label style="padding-left:44.5%">{{ $title }}</label>
        @if($disabled ?? null)
           <input type="{{ $type }}" value="{{ $value ?? '' }}" name="{{ $name }}" class="form-control" style="text-align: center" placeholder="{{ $placeholder ?? 'Enter ...' }}" disabled>
        @else
           <input type="{{ $type }}" value="{{ $value ?? '' }}" name="{{ $name }}" class="form-control" style="text-align: center" placeholder="{{ $placeholder ?? 'Enter ...'}}">
        @endif
    </div>
</div>
@error($name)
<p style="padding-left:85px; color:red">* {{ $message }}</p>
@enderror
