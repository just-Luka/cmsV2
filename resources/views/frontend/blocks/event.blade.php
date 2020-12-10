<div class="section section-fluid learts-pt-30 bg-white">
    <div class="container">
        <div class="row learts-mb-n30">
            @foreach($eventData as $event)
                @include('frontend.modules.events.templates.index',
                [
                    'shape' => $event->shape,
                    'image' => $event->image,
                    'attachment' => $event->attachment
                ])
            @endforeach
        </div>
    </div>
</div>
