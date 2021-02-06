@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
    @include('backend.widgets.tables.without_bordered', [
    'tableTitles' => [
                        '#',
                        lang('status'),
                        lang('created_at')
                     ],

    'tableName'     => lang('list'),
    'tableListPath' => 'backend.modules.roles.list',
    'pagination'    => false,
    'searchInput'   => false,
    'list'          => $items
])
@endsection
