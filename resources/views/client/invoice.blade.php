@extends('layout.wrapper')
@section('content')
  @section('title','Invoice')
  @php
    $name = ucwords($user->first_name." ".$user->last_name);
  @endphp
<link rel="stylesheet" href="{{asset('/css/invoice.css')}}">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="{{asset('images/logo-alt.png')}}" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://lobianijs.com">
                            Camrent
                            </a>
                        </h2>
                        <div>ALAMAT</div>
                        <div>TELEPON</div>
                        <div>email@camrent.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{ucwords($user->first_name." ".$user->last_name)}}</h2>
                        <div class="address">{{chunk_split($user->phone, 4, ' ')}}</div>
                        <div class="email"><a href="mailto:{{$user->email}}">{{$user->email}}</a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE {{$rent->code}}</h1>
                        <div class="date">Order Date: {{date('d/m/Y', strtotime($rent->created_at))}}</div>
                        {{-- <div class="date">Due Date: 30/10/2018</div> --}}
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr class="head">
                            <th>#</th>
                            <th class="text-left">DESCRIPTION</th>
                            <th class="text-center">PRICE</th>
                            <th colspan="3" class="plan text-center">RENT PLAN</th>
                            <th rowspan="2" class=" text-center">TOTAL</th>
                        </tr>
                        <tr class="plan-child">
                          <th></th>
                          <th></th>
                          <th></th>
                          <th class="text-center">from</th>
                          <th class="text-center">to</th>
                          <th class="text-center">total days</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($details as $d)
                        @php
                          $item = App\Item::where('id',$d->item_id)->get()[0];
                        @endphp
                        <tr>
                            <td class="no">01</td>
                            <td class="text-left"><h3>{{$item->name}}</h3></td>
                            <td class="text-right">{{\App\Common::rupiah($item->rent_price)}}</td>
                            <td class="qty text-center">{{date('d/m/Y', strtotime($d->start_date))}}</td>
                            <td class="qty text-center">{{date('d/m/Y', strtotime($d->end_date))}}</td>
                            <td class="text-center">{{$d->day_count}} {{ Str::plural('day', $d->day_count) }}</td>
                            <td class="total">{{\App\Common::rupiah($item->rent_price*$d->day_count)}}</td>
                        </tr>

                      @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>{{\App\Common::rupiah($rent->subtotal)}}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2">TAX</td>
                            <td>{{\App\Common::rupiah($rent->assurance)}}</td>
                        </tr>
                        @if ($rent->overcharge != 0)
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="2">OVERCHARGE</td>
                              <td>{{\App\Common::rupiah($rent->overcharge)}}</td>
                          </tr>
                        @endif
                        @if ($rent->damage_fee != 0)
                          <tr>
                              <td colspan="4"></td>
                              <td colspan="2">DAMAGE CHARGE</td>
                              <td>{{\App\Common::rupiah($rent->damage_fee+$rent->overcharge+$rent->damage_fee)}}</td>
                          </tr>
                        @endif
                        <tr>
                            <td colspan="4"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>{{\App\Common::rupiah($rent->total)}}</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge will be made on unpaid balances after due date.</div>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
<script src="{{asset('print/printThis.js')}}" charset="utf-8"></script>
<script type="text/javascript">
$('#printInvoice').click(function(){
    $('.invoice').printThis({
      importCSS:false,
      loadCSS:["{{asset('/css/invoice.css')}}"]
    })
});
</script>
@endsection
