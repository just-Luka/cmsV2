<div class="form-group">
    <label>{{ $title }}</label>
        <input type="{{ $type }}" value="{{ $value }}" name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}"
            <?php
                if ($required) {
                    echo "required ";
                }else {
                    echo '';
                }
            ?>
        >
</div>

@error($name)
    <p style="padding-left:15px; color:red">* {{ $message }}</p>
@enderror
