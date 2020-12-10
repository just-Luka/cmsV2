@foreach($list as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->translation->title ?? '####'}}</td>
        @if($item->redirect)
            <td>####</td>
            <td>####</td>
            <td>{{ $item->redirect }}</td>
        @else
            <td>{{ $item->attachment }}</td>
            <td><a href="{{ route('frontend.'.$item->attachment.'.index', ['locale' => App::getLocale(), 'slug' => \Illuminate\Support\Facades\DB::table($item->attachment)->find($item->attachment_id)->slug]) }}">/{{ \Illuminate\Support\Facades\DB::table($item->attachment)->find($item->attachment_id)->slug }}</a></td>
            <td>####</td>
        @endif
        <td>{{ $item->position }}</td>
        <td>
            <div class="btn-group">
                <a href="{{ route('backend.menus.inside', ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat"><i class="fas  fa-arrow-right"></i></a>
                @if($item->visible)
                    <a href="{{ route('backend.menus.visible', ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat" hideable="1" vis="0"><i class="fas fa-eye"></i></a>
                @else
                    <a href="{{ route('backend.menus.visible', ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat" hideable="1" vis="1"><i class="fas fa-eye-slash"></i></a>
                @endif
                <a href="{{ route('backend.menus.trans',         ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat"><i class="fas fa-pencil-alt"></i></a>
                <a href="{{ route('backend.menus.edit',         ['locale' => App::getLocale(), 'id' => $item->id ]) }}" class="btn btn-default btn-flat"><i class="fas fa-edit"></i></a>
                <form action="{{ route('backend.menus.destroy', ['locale' => App::getLocale(), 'id' => $item->id ]) }}" method="POST">
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
