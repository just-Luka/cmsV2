@if(!$sliderData->isEmpty())
<div class="section section-fluid bg-white">
    <div class="container-fluid">
        <div class="home3-slider swiper-container">
            <div class="swiper-wrapper">
                @foreach($sliderData as $slider)
                    <div class="home3-slide-item swiper-slide" data-swiper-autoplay="5000" data-bg-image="{{ asset('storage/'.$slider->image) }}">
                        <div class="container">
                            <div class="home3-slide-content">
                                <h5 class="sub-title">{{ $slider->translation->meta_title ?? '####' }}</h5>
                                <h2 class="title">{!! $slider->translation->content ?? '####' !!}</h2>
                                <div class="link"><a href="{{ route('frontend.'.$slider->attachment.'.index', ['locale' => App::getLocale(),'slug' =>\Illuminate\Support\Facades\DB::table($slider->attachment)->find($slider->attachment_id)->slug])}}" class="btn btn-black btn-hover-primary">{{ lang('full') }}</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            <div class="home3-slider-prev swiper-button-prev"><i class="ti-angle-left"></i></div>
            <div class="home3-slider-next swiper-button-next"><i class="ti-angle-right"></i></div>
        </div>
    </div>
</div>
@endif
