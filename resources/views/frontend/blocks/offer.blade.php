@foreach($data['offers'] as $offer)
    <div class="section section-fluid section-padding">
        <div class="container">
            <div class="row align-items-center learts-mb-n30">

                <div class="col-lg-6 col-12 learts-mb-30">
                    <div class="product-deal-image text-center">
                        <img src="{{ asset('storage/'.$offer->image) }}" alt="">
                    </div>
                </div>

                <div class="col-lg-6 col-12 learts-mb-30">
                    <div class="product-deal-content">
                        <h2 class="title">{{ $offer->translation->title ?? '#####' }}</h2>
                        <div class="desc">
                            <p>{!! $offer->translation->content ?? '###' !!}</p>
                        </div>
                        <div class="countdown1" data-countdown="{{ $offer->offer_end }}"></div>
                        <a href="" class="btn btn-dark btn-hover-primary">{{ lang('full') }}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endforeach
