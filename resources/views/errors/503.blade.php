@extends('errors::minimal')

@section('title', lang('service_unavailable'))
@section('code', '503')
@section('message', lang($exception->getMessage() ?: 'service_unavailable'))
