@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $moduleName }} : {{ $itemContent->title ?? '####' }} </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('backend.menus.create', ['locale' => App::getLocale(), 'parentID' => $item->id ]) }}">{{ lang('add_new') }}</a></li>
                            <li class="breadcrumb-item active">{{ $moduleName }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
    @include('backend.widgets.tables.hoverable', [
        'tableTitles'   =>[
               '#',
               lang('title'),
               lang('page_url'),
               lang('position'),
           ],

           'tableListPath' => 'backend.modules.menus.list',
           'tableName'     => lang('menu_list'),
           'pagination'    => true,
           'searchInput'   => false,
           'list'          => $items
    ])
    @include('backend.widgets.alerts.white_alert')
@endsection
