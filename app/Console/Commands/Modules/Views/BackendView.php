<?php


namespace App\Console\Commands\Modules\Views;


class BackendView extends BaseView
{
    /**
     * @return string
     * @Override
     */
    public function template(): string
    {
        return ("@extends('backend.layouts.app')
@section('content')
@include('backend.blocks.header', ['moduleTitle' => ucfirst(dollar|moduleName)])

@endsection
        ");

    }
}
