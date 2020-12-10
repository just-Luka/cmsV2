@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle'=>ucfirst($moduleName)])
<div id="user-list"></div>
@include('backend.widgets.alerts.white_alert')
@endsection
