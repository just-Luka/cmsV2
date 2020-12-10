@foreach($list as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td><a href="{{ route('frontend.posts.index', ['locale' => App::getLocale(), 'slug' => $item->slug]) }}">/{{ $item->slug }}</a></td>
        <td>{{ $item->translation->title ?? '??????' }}</td>
        <td>{{ $item->template }}</td>
        <td class="filtr-item col-sm-1" data-category="1" data-sort="white sample" style="opacity: 1; transform: scale(1) translate3d(0px, 0px, 0px); backface-visibility: hidden; perspective: 1000px; transform-style: preserve-3d; width: 148.5px; transition: all 0.5s ease-out 0ms, width 1ms ease 0s;">
            <a href="{{ asset('storage/'.$item->image) }}" data-toggle="lightbox" data-title="sample 1 - white">
                <img src="{{ asset('storage/'.$item->image) }}" class="img-fluid mb-2" alt="{{ $item->image }}">
            </a>
        </td>
        <td>
            <div class="btn-group">
                @if($item->visible)
                    <a href="{{ route('backend.posts.visible',  ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat" hideable="1" vis="0"><i class="fas fa-eye"></i></a>
                @else
                    <a href="{{ route('backend.posts.visible',  ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat" hideable="1" vis="1"><i class="fas fa-eye-slash"></i></a>
                @endif
                <a href="{{ route('backend.posts.trans',        ['locale' => App::getLocale(), 'id' => $item->id]) }}" class="btn btn-default btn-flat"><i class="fas fa-pencil-alt"></i></a>
                <a href="{{ route('backend.posts.edit',            ['locale' => App::getLocale(), 'id' => $item->id ]) }}" class="btn btn-default btn-flat"><i class="fas fa-edit"></i></a>
                <form action="{{ route('backend.posts.destroy',    ['locale' => App::getLocale(), 'id' => $item->id ]) }}" method="POST">
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
