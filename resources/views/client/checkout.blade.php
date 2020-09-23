@extends('layout.wrapper')
@section('content')
@section('title','Checkout')
  @php
    $total = 0;
    $assurance = 0;
  @endphp
  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- Order Details -->
        @if (Session::has('cart'))
          <div class="col-md-7 order-details">
            <div class="section-title text-center">
              <h3 class="title">Your Order</h3>
            </div>
            <div class="order-summary">
              <div class="order-col">
                <div><h4>PRODUCT</h4></div>
                <div><h4>SUBTOTAL</h4></div>
              </div>
              <div class="order-products">
              @foreach (Session::get('cart') as $cart)
                <div class="order-col">
                  <div>
                    <b>{{$cart['name']}}</b>
                    <br>
                    {{$cart['plan']}} days,
                    <small>({{date("l, F d, Y", strtotime($cart['start_date']))}} - {{date("l, F d, Y", strtotime($cart['end_date']))}})</small>
                  </div>
                  <div>
                    <b>{{\App\Common::rupiah($cart['plan']*$cart['price'])}}</b>
                    <br>
                    <small>{{$cart['plan']}}x {{\App\Common::rupiah($cart['price'])}}</small>
                  </div>
                </div>
                @php
                  $assurance += \App\Item::find($cart['id'])->pluck('bail_price')[0];
                  $total += $cart['plan']*$cart['price'];
                @endphp
              @endforeach
              <hr>
              <div class="order-col">
                <div><h4>SUBTOTAL</h4></div>
                <div><strong>{{\App\Common::rupiah($total)}}</strong></div>
              </div>
              <div class="order-col">
                <div style="width:30%"><h4>ASSURANCE</h4></div>
                <div style="width: 70%">
                  <strong>{{\App\Common::rupiah($assurance)}}</strong>
                  @php
                  $index = 1;
                  @endphp
                  @foreach (Session::get('cart') as $cart)
                    <br>
                    (<small>{{$cart['name']}}@ {{\App\Common::rupiah(\App\Item::find($cart['id'])->pluck('bail_price')[0])}}</small>)
                    {{-- (<small>item {{$index}}@ {{\App\Common::rupiah(\App\Item::find($cart['id'])->pluck('bail_price')[0])}}</small>) --}}
                    @php
                    $index++;
                    @endphp
                  @endforeach
                </div>
              </div>
              </div>
            </div>
          </div>
          <!-- billing -->
          <div class="col-md-4 col-md-offset-1 order-details">
            <div class="order-summary">
              <div class="order-col">
                <div style="width:20%"><strong>SUBTOTAL</strong></div>
                <div style="width:80%"><strong>{{\App\Common::rupiah($total)}}</strong></div>
              </div>
              <div class="order-col">
                <div style="width:20%"><strong>ASSURANCE</strong></div>
                <div style="width:80%"><strong>{{\App\Common::rupiah($assurance)}}</strong></div>
              </div>
              <div class="order-col">
                <div style="width:20%"><h4>TOTAL</h4></div>
                <div style="width:80%"><strong class="order-total">{{\App\Common::rupiah($total + $assurance)}}</strong></div>
              </div>
            </div>
            <hr>
            @if (Auth::user())
              <form id="checkoutForm" action="{{action('ClientController@rent')}}" method="post">
                @csrf
                <!-- Order notes -->
                <div class="order-notes">
                  <textarea class="input" placeholder="Order Notes" name="order_notes"></textarea>
                </div>
                <!-- /Order notes -->
                <div class="payment-method">
                  <p>*Please pick up and return each item according to the date of return, or you will be charged for additional fee</p>
                </div>
                <div class="input-checkbox">
                  <input type="checkbox" id="terms">
                  <label for="terms">
                    <span></span>
                    I've read and accept the <a href="#">terms & conditions</a>
                  </label>
                </div>
                <button id="checkoutForm-submit" type="submit" class="primary-btn order-submit">Place order</button>
              </form>
            @else
              <div class="order-summary">
                <div class="order-col">
                  <div style="width:100%">
                    <strong class="order-total">Please login before proceeding checkout</strong>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
                  <div>
                    <span><a href="/login"><i class="fa fa-sign-in"></i> go to login >></a></span>
                  </div>
            @endif
          </div>
        @else
          <div class="col-md-12 order-details">
            <div class="order-col">
              <div class="">
                <strong class="order-total">You have no items in your cart. check our store for available items!</strong>
              </div>
              <div class="">
                <span><a href="/store"><i class="fa fa-shopping-cart"></i> go to store</a></span>
              </div>
            </div>
          </div>
        @endif
        <!-- /Order Details -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->
  <script type="text/javascript">
  $(document).ready(function ()
  {
    // $('#checkoutForm-submit').click(function(e, params)
    // {
    //   var localParams = params || {};
    //
    //   if (!localParams.send) {
    //     e.preventDefault();
    //   }
    //
    //   Swal.fire({
    //       title: "Are you sure?",
    //       text: "Your order will be shipped with filled data.",
    //       icon: "info",
    //     }).then((v) => {
    //       switch (v) {
    //         case "cancel":
    //           swal("canceled");
    //           break;
    //         case "proceed":
    //           $(e.currentTarget).trigger(e.type, {'send': true});
    //           break;
    //       }
    //   });
    // });
    // $("#checkoutForm").ajaxForm({
    //   url:$(this).attr('action'),
    //   type: 'POST',
    //   data: $(this).serialize(),
    //   success: function(data)
    //   {
    //     var obj = jQuery.parseJSON(data);
    //     if(obj.err == false)
    //     {
    //       console.log('bisa cuyyy');
    //       Swal.fire({
    //         title: "Well Done!",
    //         text: obj.msg,
    //         icon: "success"
    //       }).then((e)=>
    //       {
    //         // location.replace('/purchasement/'+obj.redirect);
    //       });
    //     }
    //     else{
    //         Swal.fire("Opps!", obj.msg, "error");
    //     }
    //   },
    //   error: function(XMLHttpRequest, textStatus, errorThrown)
    //   {
    //     Swal.fire(
    //     {
    //       title: "Failed to Create order!",
    //       text: obj.msg,
    //       icon: "error",
    //     });
    //   }
    // });
  });
  </script>
@endsection
