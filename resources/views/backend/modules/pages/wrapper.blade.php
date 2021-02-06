@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
@include('backend.widgets.tables.hoverable', [
    'tableTitles'   =>[
           '#',
           lang('title'),
           lang('slug'),
           lang('template'),
           lang('image'),
       ],

       'tableListPath' => 'backend.modules.pages.list',
       'tableName'     => lang('list'),
       'pagination'    => true,
       'searchInput'   => false,
       'list'          => $items
])
@include('backend.widgets.alerts.white_alert')
@endsection
