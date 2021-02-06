@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle' => ucfirst($moduleName)])
@include('backend.widgets.tables.without_bordered',
[
'tableTitles'   =>[
    '#',
    lang('slug'),
    lang('title'),
    lang('price'),
    lang('offer_end'),
    lang('image'),
],

'tableListPath' => 'backend.modules.offers.list',
'tableName'     => lang('list'),
'pagination'    => true,
'searchInput'   => false,
'list'          => $items,
])
@include('backend.widgets.alerts.white_alert')

@endsection
