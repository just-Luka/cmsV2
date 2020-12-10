<div class="category-banner3">

    <a href="{{ route('frontend.categories.index', ['locale' => App::getLocale(), 'slug' => \Illuminate\Support\Facades\DB::table($event->attachment)->find($event->attachment_id)->slug]) }}" class="inner">
        <div class="image"><img src="{{ asset('storage/'.$image) }}" alt=""></div>
        <div class="content">
            <h3 class="title">{{ $event->translation->title }}<span class="number">6 პროდუქცია</span></h3>
        </div>
    </a>

</div>
