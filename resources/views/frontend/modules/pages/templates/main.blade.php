@extends('frontend.layouts.app')
@section('content')

    <main>
        <section class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 col-md-12">
                                <div class="hero__caption">
                                    <h1 data-animation="fadeInLeft" data-delay="0.2s">{{ $pageTransData->title ?? '' }}</h1>
                                    <p data-animation="fadeInLeft" data-delay="0.4s">{!! $pageTransData->content ?? '' !!}</p>
                                    <a href="#" class="btn hero-btn" data-animation="fadeInLeft" data-delay="0.7s">{{ lang('join_for_free') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- ? services-area -->
    @include('frontend.blocks.about_banners')
    <!-- Courses area start -->
        @if(!$courseData->isEmpty())
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>{{ lang('out_featured_courses') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="courses-actives">
                    @foreach($courseData as $item)
                        <div class="properties pb-20">
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href="#"><img src="{{ asset('storage/'.$item->image) }}" alt=""></a>
                            </div>
                            <div class="properties__caption">
                                <p>{{ $item->meta_title }}</p>
                                <h3><a href="#">{{ $item->title }}</a></h3>
                                <p>{!! $item->content !!}</p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            @for($i=0; $i < $item->star-1; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                            @if((int)$item->star == $item->star)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="fas fa-star-half"></i>
                                            @endif
                                        </div>
                                        <p><span>({{ $item->star }})</span> {{ lang('based_on')}} {{ $item->sold }}</p>
                                    </div>
                                    <div class="price">
                                        <span>${{ $item->price }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('frontend.pages.index', ['locale' => App::getLocale(), 'slug' => $item->parent_slug, 'secondSlug' => $item->slug ]) }}" class="border-btn border-btn2">{{ lang('find_out_more') }}</a>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <!-- Courses area End -->
        <!--? About Area-1 Start -->
    @include('frontend.blocks.about_video')
    <!-- About Area End -->
        <!--? top subjects Area Start -->
    @include('frontend.blocks.top_subjects', ['class' => 'section-padding40'])
    <!-- top subjects End -->
        <!--? About Area-3 Start -->
    @include('frontend.blocks.about_outcomes')
    <!-- About Area End -->
        <!--? Team -->
    @include('frontend.blocks.community_experts')
    <!-- Services End -->

    </main>
@endsection
