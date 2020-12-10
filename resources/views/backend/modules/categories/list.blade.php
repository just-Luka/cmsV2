@foreach($list as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td><a href="{{ route('frontend.categories.index', ['locale' => App::getLocale(), 'slug' => $item->slug]) }}">/{{ $item->slug }}</a></td>
        <td>{{ $item->translation->title ?? '??????' }}</td>
        <td>{{ $item->category_of }}</td>
        <td>
            <div class="btn-group">
                @if($item->visible)
                    <a href="{{ route('backend.categories.visible',  ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat" hideable="1" vis="0"><i class="fas fa-eye"></i></a>
                @else
                    <a href="{{ route('backend.categories.visible',  ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat" hideable="1" vis="1"><i class="fas fa-eye-slash"></i></a>
                @endif
                <a href="{{ route('backend.categories.trans',        ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat"><i class="fas fa-pencil-alt"></i></a>
                <a href="{{ route('backend.categories.edit',            ['locale' => App::getLocale(), 'id' => $item->id ]) }}" class="btn btn-default btn-flat"><i class="fas fa-edit"></i></a>
                <form action="{{ route('backend.categories.destroy',    ['locale' => App::getLocale(), 'id' => $item->id ]) }}" method="POST">
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
