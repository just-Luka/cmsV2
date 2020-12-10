<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>{{ $moduleTitle }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

              @if(Request::segment(4))
                 <li class="breadcrumb-item"><a href="{{ route('backend.'.Request::segment(3).'.index', App::getLocale()) }}">{{ lang('go_back') }}</a></li>
              @else
                 <li class="breadcrumb-item"><a href="{{ route('backend.'.Request::segment(3).'.create', App::getLocale()) }}">{{ lang('add_new') }}</a></li>
              @endif
              <li class="breadcrumb-item active">{{ $moduleTitle }}</li>

            </ol>
          </div>
        </div>
      </div>
    </section>
