@extends('errors::minimal')

@section('title', lang('forbidden'))
@section('code', '403')
@section('message', lang($exception->getMessage() ?: 'forbidden'))
