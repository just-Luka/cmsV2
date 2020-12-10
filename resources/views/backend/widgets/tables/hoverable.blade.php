<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $tableName }}</h3>

                        <div class="card-tools">
                            @if($searchInput ?? null)
                                @include('backend.widgets.forms.search')
                            @endif
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                @foreach($tableTitles as $key => $tableTitle)
                                    <th>{{ $tableTitle }}</th>
                                @endforeach
                                <th style="width: 40px" >{{ lang('action') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @include($tableListPath)

                            </tbody>
                        </table>
                    </div>
                    @if($pagination ?? null)
                        @include('backend.widgets.paginations.small_nums')
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
