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
                <th>Request Date</th>
                <th>Status</th>
                <th>Accept Date</th>
                <th>Subtotal</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($commissions as $c)
                @php
                  $total = 0;
                  $details = \App\CommissionDetail::where('parent_id',$c->id)->get();
                  foreach ($details as $cd) {
                    $total += $cd->subtotal;
                  }
                @endphp
                <tr>
                  <td>{{$c->request_date}}</td>
                  @if ($c->accepted)
                    <td>
                      <span class="badge badge-success">Accepted</span>
                    </td>
                    <td>
                      {{$c->accept_date}}
                    </td>
                  @else
                    <td>
                      <span class="badge badge-info">Requested</span>
                    </td>
                    <td>-</td>
                  @endif
                  <td>{{\App\Common::rupiah($total)}}</td>
                  <td>
                    <a href="{{route('tenant_commission_details',$c->id)}}" class="text-info">
                      <i class="fa fa-file-invoice"></i> | Invoice
                    </a>
                    @if (Auth::user()->isadmin && !$c->accepted)
                      <br>
                      <a href="{{route('accept_commission',$c->id)}}" class="text-primary">
                        <i class="fa fa-hand-holding-usd"></i> | Accept Commission
                      </a>
                    @endif
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
    @if (Session::has('message'))
      Swal.fire('{{Session::get('message')}}','','{{Session::get('message-type')}}');
    @endif
    $(".dataTable").DataTable({
      "paging": true,
      "ordering": true,
      "info": true,
      "responsive": true
    });
  </script>
@endsection
