<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <!-- Fixed Header (same for all) -->
                    <div class="card-header">
                      <h3 class="card-title">{{ $tableName }}</h3>
                      <div class="card-tools">

                        @if($searchInput ?? null)
                            @include('backend.widgets.forms.search')
                        @endif

                      </div>
                    </div>
                    <!-- /.Fixed card-header -->

                    <div class="card-body p-0">
                      <table class="table">
                        <thead>
                          <tr>
                            @foreach($tableTitles as $key => $tableTitle)
                               <th>{{ $tableTitle }}</th>
                            @endforeach
                            <th style="width: 40px" >{{ lang('action') }}</th>
                          </tr>
                        </thead>
                        <tbody id="tbodyList">

                          @include($tableListPath)

                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    @if($pagination ?? null)
                       @include('backend.widgets.paginations.small_nums')
                    @endif

                  </div>

            </div>
        </div>
    </div>
</section>
