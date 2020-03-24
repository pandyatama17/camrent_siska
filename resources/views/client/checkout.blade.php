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
              <div><h4>ASSURANCE</h4></div>
              <div>
                <strong>{{\App\Common::rupiah($assurance)}}</strong>
                @php
                $index = 1;
                @endphp
                @foreach (Session::get('cart') as $cart)
                  <br>
                  (<small>item {{$index}}@ {{\App\Common::rupiah(\App\Item::find($cart['id'])->pluck('bail_price')[0])}}</small>)
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
          <!-- Order notes -->
          <div class="order-notes">
            <textarea class="input" placeholder="Order Notes"></textarea>
          </div>
          <!-- /Order notes -->
          <div class="payment-method">
            <p>*Please pick up and return each item according to the date of return, or you'll charged for additional fee</p>
          </div>
          <div class="input-checkbox">
            <input type="checkbox" id="terms">
            <label for="terms">
              <span></span>
              I've read and accept the <a href="#">terms & conditions</a>
            </label>
          </div>
          <a href="#" class="primary-btn order-submit">Place order</a>
        </div>
        <!-- /Order Details -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->
@endsection
