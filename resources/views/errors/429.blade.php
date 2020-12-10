@extends('errors::minimal')

@section('title', lang('too_many_requests'))
@section('code', '429')
@section('message', lang('too_many_requests'))
