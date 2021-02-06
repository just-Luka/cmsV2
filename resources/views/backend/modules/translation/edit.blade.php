@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header',['moduleTitle'=>ucfirst($moduleName)])

<div class="col-md-6" style="margin: auto">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">{{ lang('edit') }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('backend.translation.update',['locale'=>App::getLocale(),'id'=>$item->id]) }}">
                @csrf
                <div class="row">
                    @include('backend.widgets.forms.center_input',
                    [
                      'title' => lang('key_word'),
                      'name'   => 'key',
                      'type'  => 'text',
                      'value' => $item->key,
                      'placeholder' => 'Enter key',
                      'disabled' => false
                    ])

                    @foreach ($languages as $locale)
                        <?php
                            $meaning = '';
                            foreach ($list as $item) {
                                if ($item->lang_slug === $locale) {
                                    $meaning .= $item->means or '';
                                    break;
                                }
                            }
                        ?>
                        <div class="col-sm-6" style="margin: auto">
                            @include('backend.widgets.forms.center_textarea',
                            [
                              'title'       => lang('meaning').' '.strtoupper($locale),
                              'name'        => $locale,
                              'rows'        => 3,
                              'value'       => $meaning,
                              'placeholder' => 'Enter ...',
                              'disabled'    => false,
                            ])
                        </div>
                    @endforeach
                </div>
                    @include('backend.widgets.forms.check_input',
                    [
                        'name'           => 'is_backend',
                        'label'          => lang('is_backend'),
                        'checked'        => $item->is_backend == 1,
                        'id'             => 'translation-side',
                        'value'          => 1,
                    ])
                <button type="submit" class="btn btn-block btn-primary" style="width: 30%; margin: auto;"> {{ lang('save') }}</button>
            </form>
        </div>
    </div>
</div>

@if(\Session::has('updated'))
    @include('backend.widgets.alerts.success_alert')
@endif
@endsection
