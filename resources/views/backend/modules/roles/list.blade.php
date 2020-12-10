@foreach($list as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->status }}</td>
        <td>{{ $item->created_at }}</td>
        <td>
            <div class="btn-group">
                <a href="{{ route('backend.roles.edit',[ 'locale'=>App::getLocale(), 'id' => $item->id ]) }}" class="btn btn-default btn-flat"><i class="fas fa-edit"></i></a>
                <form action="{{ route('backend.roles.destroy',[ 'locale'=>App::getLocale(), 'id' => $item->id ]) }}" method="POST">
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
