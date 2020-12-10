<?php


namespace App\Console\Commands\Modules\Views;


class FrontendView extends BaseView
{
    /**
     * @return string
     * @Override
     */
    public function template(): string
    {
        return ("@extends('frontend.layouts.app')
@section('content')
<!-- Your code! -->
@endsection");
    }
}
