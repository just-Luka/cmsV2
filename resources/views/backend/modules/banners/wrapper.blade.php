@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
@include('backend.widgets.tables.default_selector',
[
    'module' => 'banners',
    'values' => $types,
    'match'  => $current,
])

@include('backend.widgets.tables.without_bordered',
[
'tableTitles'   =>[
    '#',
    lang('title'),
    lang('url'),
    lang('type'),
    lang('src'),
],

'tableListPath' => 'backend.modules.banners.list',
'tableName'     => lang('list'),
'pagination'    => true,
'searchInput'   => false,
'list'          => $items
])

@include('backend.widgets.alerts.white_alert')
@endsection
