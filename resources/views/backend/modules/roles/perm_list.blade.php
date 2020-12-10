<?php
if (isset($item)){
    $userPerms = json_decode($item->permissions, true);
}
?>
@foreach($modules as $module)
    @if($module['status'])
        <li>
            {{ lang($module['trans']) }}
        </li>
        @foreach($module['fields'] as $key => $value)
            <ul>
                @if($value)
                    @if(isset($userPerms[$module['trans']][$key]))
                        <input type="checkbox" value="1" name="{{ $module['trans'].'_'.$key }}" checked>
                    @else
                        <input type="checkbox" value="1" name="{{ $module['trans'].'_'.$key }}">
                    @endif
                    <label>
                        {{ $key }}
                    </label>
                @endif
            </ul>
        @endforeach
    @endif
@endforeach
