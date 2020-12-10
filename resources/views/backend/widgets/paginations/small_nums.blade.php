<div class="card-footer clearfix">
    <ul class="pagination pagination-sm m-0 float-right">
      @if ($list->onFirstPage())
           <li class="page-item disabled"><a class="page-link" href="#">«</a></li>
      @else
           <li class="page-item"><a class="page-link" href="{{ $list->previousPageUrl() }}">«</a></li>
      @endif
        <?php $i = $list->currentPage()-5 <= 0 ? 0 : $list->currentPage()-5 ?>
      @for($i; $i<($list->total()/$list->perPage()); $i++)
          @if($list->currentPage()+5 < $i)
              @break;
          @endif
          @if ($i+1 == $list->currentPage())
              <li class="page-item active"><a class="page-link" href="{{$list->url($i+1)}}">{{ $i+1 }}</a></li>
          @else
              <li class="page-item"><a class="page-link" href="{{$list->url($i+1)}}">{{ $i+1 }}</a></li>
          @endif
      @endfor

      @if ($list->nextPageUrl())
           <li class="page-item"><a class="page-link" href="{{ $list->nextPageUrl() }}">»</a></li>
      @else
           <li class="page-item disabled"><a class="page-link" href="#">»</a></li>
      @endif

    </ul>
</div>
