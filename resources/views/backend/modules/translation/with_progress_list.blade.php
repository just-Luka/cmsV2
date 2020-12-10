@foreach ($list as $item)
<?php
$item->left = 0;
if(isset($wordsWithLocale[$item->id]))
{
  $item->left = (int) (100 * ($wordsWithLocale[$item->id] / $languageCount));

}
$meaning = \App\Models\Translations\Translation::getItemS(App::getLocale(), $item->id);

$item->means = $meaning ? $meaning->means : null;
?>
<tr>
    <td>{{ $item->id }}</td>
    <td>{{ $item->key }}</td>
    <td>{{ $item->means ?? "??????" }}</td>
    <td>{{ $item->is_backend == 1 ? 'Yes' : 'No' }}</td>
    <td>
      @if($item->left < 50)
      <div class="progress progress-xs">
        <div class="progress-bar bg-danger" style="width: {{ $item->left }}%"></div>
      </div>
      @elseif($item->left < 99)
      <div class="progress progress-xs">
        <div class="progress-bar bg-warning" style="width: {{ $item->left }}%"></div>
      </div>
      @else
      <div class="progress progress-xs progress-striped active">
        <div class="progress-bar bg-success" style="width: {{ $item->left }}%"></div>
      </div>
      @endif
    </td>
    <td>
      <div class="btn-group">
        <a href="{{ route('backend.translation.edit',[ 'locale'=>App::getLocale(), 'id' => $item->id ]) }}" class="btn btn-default btn-flat"><i class="fas fa-edit"></i></a>
          <form action="{{ route('backend.translation.destroy',[ 'locale'=>App::getLocale(), 'id' => $item->id ]) }}" method="POST">
          @csrf
            <div class="delete-alert-onclick">
               <button type="submit" class="btn btn-default btn-flat" id="destroy-{{ $item->id }}">
                   <i class="fas fa-times"></i>
               </button>
            </div>
        </form>
      </div>
    </td>
</tr>
@endforeach
