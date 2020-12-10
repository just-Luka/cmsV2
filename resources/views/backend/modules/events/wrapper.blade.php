@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle' => ucfirst($moduleName)])
@include('backend.widgets.tables.hoverable', [
'tableTitles' => [
                '#',
                lang('title'),
                lang('shape'),
                lang('attachment'),
                lang('attachment_id'),
                lang('border'),
             ],

'tableName'     => lang('event_list'),
'tableListPath' => 'backend.modules.events.list',
'pagination'    => true,
'searchInput'   => false,
])
@include('backend.widgets.alerts.white_alert')
@endsection
