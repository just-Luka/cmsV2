<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('courses/assets/img/favicon.ico') }}">
    <!-- Ionicons -->
    <!-- Flag icons -->
    <link rel="stylesheet" href="{{ asset('adminLTE/plugins/flag-icon-css/css/flag-icon.css')}}">
    <link rel="stylesheet" href="{{ asset('adminLTE/css/adminlte.min.css') }}">
    @stack('styles')
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
