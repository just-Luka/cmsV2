<ul id="navigation" class="{{ $ulClassName }}">
    @foreach($menuList as $menu)
        @if(!$menu->menuParent->isEmpty())
            <li><a href="{{ route('frontend.pages.index', ['locale' => App::getLocale(), 'slug' => \App\Models\Page::find($menu->page_id)->slug ]) }}">{{ $menu->title }}</a>
                @include('frontend.modules.menus.list',
                [
                    'ulClassName' => 'submenu',
                    'menuList'    => $menu->menuParent,
                ])
            </li>
        @else
            @if($menu->parent_id && !$ulClassName)
                @continue
            @endif
            <li><a href="{{ route('frontend.pages.index', ['locale' => App::getLocale(), 'slug' => \App\Models\Page::find($menu->page_id)->slug ]) }}">{{ $menu->title }}</a></li>
        @endif
    @endforeach
    @if(!$ulClassName)
        @if(Auth::User())
            <li class="button-header"><a href="#logout" class="btn btn3" onclick="$('#logout-sub').click()">{{ lang('logout') }}</a></li>
            <form action="{{ route('logout') }}" method="POST" hidden>
                @csrf
                <button type="submit" id="logout-sub"></button>
            </form>
        @else
            <li class="button-header margin-left "><a href="{{ route('register') }}" class="btn">{{ lang('register') }}</a></li>
            <li class="button-header"><a href="{{ route('login') }}" class="btn btn3">{{ lang('log_in') }}</a></li>
        @endif
    @endif
</ul>
