@extends('backend.layouts.app')
@section('content')
   @include('backend.blocks.header',['moduleTitle'=>ucfirst($moduleName)])
   <section class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <div class="dataTables_length">
                       <form method="GET" action="{{ route('backend.translation.index', ['locale' => App::getLocale()]) }}">
                           <label>
                               <select class="custom-select" style="width: auto;" name="side" id="side">
                                   @if(!$current['side'])
                                       <option value="0" selected>{{ ucfirst(lang('all')) }}</option>
                                   @else
                                       <option value="0">{{ ucfirst(lang('all')) }}</option>
                                   @endif
                                   @if($current['side'] == 1)
                                       <option value="1" selected>{{ lang('backend') }}</option>
                                   @else
                                       <option value="1">{{ lang('backend') }}</option>
                                   @endif
                                   @if($current['side'] == 2)
                                       <option value="2" selected>{{ lang('frontend') }}</option>
                                   @else
                                       <option value="2">{{ lang('frontend') }}</option>
                                   @endif
                               </select>
                           </label>
                           <label>
                               <select class="custom-select" style="width: auto;" name="sort" id="filter">
                                   @if($current['sort'] === 'a_to_z')
                                       <option value="a_to_z" selected>{{ lang('key_word') }} A-Z</option>
                                   @else
                                       <option value="a_to_z">{{ lang('key_word') }} A-Z</option>
                                   @endif
                                   @if($current['sort'] === 'z_to_a')
                                       <option value="z_to_a" selected>{{ lang('key_word') }} Z-A</option>
                                   @else
                                       <option value="z_to_a">{{ lang('key_word') }} Z-A</option>
                                   @endif
                                   @if($current['sort'] === 'id_asc')
                                       <option value="id_asc" selected>{{ lang('sort_by_id') }} +</option>
                                   @else
                                       <option value="id_asc">{{ lang('sort_by_id') }} +</option>
                                   @endif
                                   @if($current['sort'] === 'id_desc')
                                       <option value="id_desc" selected>{{ lang('sort_by_id') }} -</option>
                                   @else
                                       <option value="id_desc">{{ lang('sort_by_id') }} -</option>
                                   @endif
                               </select>
                           </label>
                           <button type="submit" id="submit-selected" hidden></button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section>
   @include('backend.widgets.tables.without_bordered',
   [
       'tableTitles'   =>[
           '#',
           lang('key_word'),
           lang('meaning'),
           lang('backend'),
           lang('progress'),

       ],

       'tableListPath' => 'backend.modules.translation.with_progress_list',
       'tableName'     => lang('translation_list'),
       'pagination'    => true,
       'searchInput'   => false,
       'list'          => $items,
   ])

   @include('backend.widgets.alerts.white_alert')
    @push('scripts')
        <script>
            $('#filter, #side').change( function() {
                $("#submit-selected").click()
            })
        </script>
    @endpush
@endsection
