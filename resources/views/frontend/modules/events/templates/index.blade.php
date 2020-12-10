@if($shape === 'square')
    @include('frontend.modules.events.templates.factoryShape.square',
    [
        'image' => $image,
        'shape' => $shape,
        'attachment' => $attachment,
    ])
@elseif($shape === 'rectangle')
    @include('frontend.modules.events.templates.factoryShape.rectangle',
    [
        'image' => $image,
        'shape' => $shape,
        'attachment' => $attachment,
    ])
    )
@endif
