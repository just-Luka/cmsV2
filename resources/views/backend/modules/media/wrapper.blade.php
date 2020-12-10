@extends('backend.layouts.app')
@section('content')
    @include('backend.blocks.header',['moduleTitle'=>ucfirst($moduleName)])
    <section class="content">
        <div class="container-fluid">
            @if($type === 'files')
                <iframe src="{{ url('filemanager') }}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
            @else
                <iframe src="{{ url('filemanager?type=image') }}" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
            @endif
        </div>
    </section>
@endsection
