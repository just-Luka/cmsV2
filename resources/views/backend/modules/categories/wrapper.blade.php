@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle' => ucfirst($moduleName)])
@include('backend.widgets.tables.default_selector',
[
    'module' => 'categories',
    'values' => $types,
    'match'  => $current
])
@include('backend.widgets.tables.hoverable', [
'tableTitles' => [
                '#',
                lang('slug'),
                lang('name'),
                lang('category_of'),
             ],

'tableName'     => lang('category_list'),
'tableListPath' => 'backend.modules.categories.list',
'pagination'    => true,
'searchInput'   => false,
'list'          => $items
])

@include('backend.widgets.alerts.white_alert')
@endsection
