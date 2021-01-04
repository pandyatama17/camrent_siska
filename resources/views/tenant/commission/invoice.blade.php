@extends('layout.admin')
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          @if (!$data->accepted)
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This commission has not been accepted by us, please wait for our admin to process your request.
            </div>
          @endif


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <img src="{{asset('images/logo-alt.png')}}" >
                  <small class="float-right">Date: {{$data->accept_date ?? "-"}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>Camrent.</strong><br>
                  Jl. Flamboyan RT005/RW012<br>
                  Srengseng Sawah, Jakarta Selatan<br>
                  Phone: +62 857-7135-5774<br>
                  Email: info@camrent.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>{{\App\User::find($data->tenant_id)->first_name}} {{\App\User::find($data->tenant_id)->last_name}}</strong><br>
                  Phone: {{\App\User::find($data->tenant_id)->phone}}<br>
                  Email: {{\App\User::find($data->tenant_id)->email}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice #{{sprintf("%04s", $data->id)}}</b><br>
                <br>
                <b>Request Date:</b> {{$data->request_date}}<br>
                <b>Confirm Date:</b> {{$data->accept_date ?? "-"}}<br>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
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
                    @foreach ($details as $d)
                      @php
                        $base_price = $d->day_count * $d->rent_price;
                        $tax = (10/100) * ($base_price + $d->overcharge);
                        $subtotal = $base_price - $tax;

                        $total += $subtotal;

                        if ($d->overcharge == 0) {
                          $overcharge = "-";
                        }
                        else
                        {
                          $overcharge = \App\Common::rupiah($d->overcharge);
                        }
                      @endphp
                      <tr>
                        <td>{{$d->name}}</td>
                        <td><small>{{$d->start_date}}</small> to <small>{{$d->end_date}}</small> </td>
                        <td>{{$d->day_count}} day(s)</td>
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
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
