@extends('layout.admin')
@section('content')
  <div class="row">
    <div class="col-12 ">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">My Items</h3>
        </div>
        <div class="card-body">
          <table class="table table-striped dataTable">
            <thead>
              <tr>
                <th>Item Name</th>
                <th>Rent Status</th>
                <th>Rent Price</th>
                <th>Tax (10%)</th>
                <th>Times Rented</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $index => $item)
                @php
                  $rented = count(\App\RentDetail::where('item_id',$item->id)->get());
                  $commision = count(\App\RentDetail::where('item_id',$item->id)->where('commision_status',0)->get())
                @endphp
                <tr>
                  <td>{{$item->name}}</td>
                  <td>
                    @switch($item->accepted)
                      @case(0)
                        <span class="badge badge-warning">requested</span>
                      @break
                      @case(1)
                        @switch($item->rented_status)
                          @case(0)
                            <span class="badge badge-primary">in stock</span>
                          @break
                          @case(1)
                            <span class="badge badge-danger">currently rented</span>
                          @break
                        @endswitch
                      @break
                    @endswitch
                  </td>
                  <td>{{\App\Common::rupiah($item->rent_price)}}</td>
                  <td>{{\App\Common::rupiah(10/100*($item->rent_price))}}</td>
                  <td>
                    {{$rented}}
                    @if ($commision > 0)
                      <small class="badge badge-info">({{$commision}} commission available)</small>
                    @endif
                  </td>
                  <td>
                    @if ($commision > 0)
                      <a href="#" class="text-info">
                        <i class="fa fa-hand-holding-usd"></i> |
                        Request Commission
                      </a>
                    @endif
                    <br>
                    <a href="#" class="text-orange">
                      <i class="fa fa-edit"></i> |
                      Edit Item
                    </a>
                    <br>
                    <a href="#" class="text-danger">
                      <i class="fa fa-dolly"></i> |
                      Retract Item
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(".dataTable").DataTable({
      "paging": true,
      "ordering": true,
      "info": true,
      "responsive": true
    });
  </script>
@endsection
