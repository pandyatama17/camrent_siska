@extends('layout.admin')
@section('title','Request Commission')
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Commission Request Form</h3>
        </div>
        @if (!$commissions->isEmpty())
          <div class="card-body">
            <h2>Available Commissions</h2>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Rent Date</th>
                  <th>Day(s) Count</th>
                  <th>Rent Price</th>
                  <th>Additional Charge</th>
                  <th>Tax (10%)</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $total = 0;
                @endphp
                @foreach ($commissions as $c)
                  @php
                    $base_price = $c->day_count * $c->rent_price;
                    $tax = (10/100) * ($base_price + $c->overcharge);
                    $subtotal = $base_price - $tax;

                    $total += $subtotal;

                    if ($c->overcharge == 0) {
                      $overcharge = "-";
                    }
                    else
                    {
                      $overcharge = \App\Common::rupiah($c->overcharge);
                    }
                  @endphp
                  <tr>
                    <td>{{$c->name}}</td>
                    <td><small>{{$c->start_date}}</small> to <small>{{$c->end_date}}</small> </td>
                    <td>{{$c->day_count}} day(s)</td>
                    <td>{{\App\Common::rupiah($base_price)}}</td>
                    <td>{{$overcharge}}</td>
                    <td>{{\App\Common::rupiah($tax)}}</td>
                    <td class="text-right">{{\App\Common::rupiah($subtotal)}}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="5"></td>
                  <td><b>Total</b></td>
                  <td class="text-right"><b>{{\App\Common::rupiah($total)}}</b></td>
                </tr>
              </tfoot>
            </table>
            <div class="col-12">
              <br>
            </div>
            <div class="col-6">
              <div class="form-inline">
                <label class="my-1 mr-2">Request Date </label>
                <p class="my-1 mr-sm-2 form-control-static"> <b>:</b> {{\Carbon\Carbon::now()}}</p>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <a id="submitCommissionRequest" class="pull-right btn btn-primary" href="{{route('tenant_submit_commission_request')}}">
              <i class="fa fa-hand-holding-usd"></i> Request Commission
            </a>
            {{-- <a href="{{route('tenant_submit_commission_request')}}">test</a> --}}
          </div>
        @else
          <div class="card-body">
            <h1 class="text-center">No Available commissions</h1>
          </div>
        @endif
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $("#submitCommissionRequest").on('click',function(event)
    {
      $.get({
        url = "{{route('tenant_submit_commission_request')}}",
        dataType: 'json',
        success: function(response)
        {
          var obj= $.parseJSON(response);

          if (obj.err == false)
          {
              Swal.fire('success',obj.msg,'success').then(function (prompt)
              {
                if (prompt.value) {
                  window.location = obj.redirect;
                }
              });
          }
          else
          {
            Swal.fire('error',obj.msg,'error');
          }
        }
      });
    });
  </script>
@endsection
