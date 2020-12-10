@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
@include('backend.widgets.tables.hoverable', [
'tableTitles' => [
                '#',
                lang('slug'),
                lang('title'),
                lang('price'),
                lang('image'),
             ],

'tableName'     => lang('product_list'),
'tableListPath' => 'backend.modules.products.list',
'pagination'    => true,
'searchInput'   => false,
'list'          => $items,
])
@include('backend.widgets.alerts.white_alert')
@endsection
