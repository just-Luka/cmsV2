<div class="form-check" style="margin-bottom: 8px">
    <input class="form-check-input" type="checkbox" name="{{ $name }}" value="{{ $value }}" id="{{ $id }}"
        <?php
            if ($checked) {
                echo "checked";
            }else {
                echo "";
            }
        ?>
    >
    <label class="form-check-label">{{ $label }}</label>
</div>

@error($name)
<p style="padding-left:15px; color:red">* {{ $message }}</p>
@enderror
