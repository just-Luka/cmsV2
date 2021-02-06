@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle' => ucfirst($moduleName)])

<div id="hide-page"></div>
@include('backend.widgets.tables.without_bordered',
[
'tableTitles'   =>[
    '#',
    lang('title'),
    lang('url'),
],

'tableListPath' => 'backend.modules.brands.list',
'tableName'     => lang('list'),
'pagination'    => true,
'searchInput'   => false,
'list'          => $items,
])

@include('backend.widgets.alerts.white_alert')

@endsection
