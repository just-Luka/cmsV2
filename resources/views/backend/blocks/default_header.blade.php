<?php
$availableLanguages = \App\Models\Language::getList();
$currentLang = \Illuminate\Support\Facades\App::getLocale();
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="flag-icon flag-icon-{{ $currentLang }}"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">

              @foreach ($availableLanguages as $locale)
                 @if ($locale == $currentLang)
                    <a href="#" class="dropdown-item active">
                      <i class="flag-icon flag-icon-{{ $currentLang }} mr-2"></i> {{ strtoupper($locale) }}
                    </a>
                 @continue
              @endif
                 <a href="{{ route('backend.languages.switch', ['locale'=>$locale]) }}" class="dropdown-item">
                   <i class="flag-icon flag-icon-{{ $locale }} mr-2"></i> {{ strtoupper($locale) }}
                 </a>
              @endforeach
              <a href="{{ route('backend.languages.create', ['locale'=>$currentLang]) }}" class="dropdown-item">
                <i class="flag-icon flag-icon- mr-2"></i> {{ lang('add_more') }}
              </a>
            </div>
        </li>
        {{--
        <li class="nav-item">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cog"></i>
            </a>
        </li>
        --}}
        <li class="nav-item dropdown">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            <button type="submit" class="nav-link" hidden id="sign-out-user">
            </button>
            </form>
            <a class="nav-link" data-toggle="dropdown" href="#" onclick="$('#sign-out-user').click()">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
<div class="wrapper">
