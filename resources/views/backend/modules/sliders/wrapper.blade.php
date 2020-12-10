@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle' => ucfirst($moduleName)])
@include('backend.widgets.tables.default_selector',
[
    'module' => 'sliders',
    'values' => $attachments,
    'match'  => $current,
])

@include('backend.widgets.tables.hoverable', [
'tableTitles' => [
                '#',
                lang('title'),
                lang('meta_title'),
                lang('attachment'),
                lang('attachment_id'),
                lang('position'),
                lang('image'),
             ],

'tableName'     => lang('slider_list'),
'tableListPath' => 'backend.modules.sliders.list',
'pagination'    => true,
'searchInput'   => false,
'list'          => $items,
])

@include('backend.widgets.alerts.white_alert')
@endsection
