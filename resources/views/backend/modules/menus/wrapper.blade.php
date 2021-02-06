@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
@include('backend.widgets.tables.hoverable', [
'tableTitles' => [
                '#',
                lang('title'),
                lang('attachment'),
                lang('slug'),
                lang('hyper_link'),
                lang('position')
             ],

'tableName'     => lang('list'),
'tableListPath' => 'backend.modules.menus.list',
'pagination'    => true,
'searchInput'   => false,
'list'          => $items
])
@include('backend.widgets.alerts.white_alert')
@endsection
