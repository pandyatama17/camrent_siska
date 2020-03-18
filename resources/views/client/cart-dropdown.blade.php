<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
  <i class="fa fa-shopping-cart"></i>
  <span>Your Cart</span>
  @if (session('cart'))
    <div class="qty" id="cart-count">{{count(session('cart'))}}</div>
  @endif
</a>
@if (session('cart'))
<div class="cart-dropdown">
  <div class="cart-list" id="cart-content">
    @php $total = 0; @endphp
    @foreach (session('cart') as $cart)
      <div class="product-widget cart-item" id="item-{{$cart['id']}}">
        <div class="product-img">
          <img src="{{asset('images/items/'.$cart['id'].'-1.jpg')}}" alt="">
        </div>
        <div class="product-body">
          <h3 class="product-name"><a href="#">{{$cart['name']}}</a></h3>
          <h4 class="product-price"><span class="qty">{{$cart['plan']}}x</span>{{\App\Common::rupiah(DB::table('items')->where('id',$cart['id'])->pluck('rent_price')[0])}}</h4>
        </div>
        <button class="delete remove-from-cart" data-id="{{$cart['id']}}" data-name="{{$cart['name']}}"><i class="fa fa-close"></i></button>
      </div>
      @php
        $count = $cart['plan'] * DB::table('items')->where('id',$cart['id'])->pluck('rent_price')[0];
        $total += $count;
      @endphp
    @endforeach
  </div>
  <div class="cart-summary">
    <small>3 Item(s) selected</small>
    <h5>SUBTOTAL: {{\App\Common::rupiah($total)}}</h5>
  </div>
  <div class="cart-btns">
    <a href="#">View Cart</a>
    <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
@endif
<script type="text/javascript">
  // $(document).ready(function()
  // {
  //
  // });
  $('.remove-from-cart').on('click',function()
  {
      var id = $(this).data('id');
      var name = $(this).data('name');
      Swal.fire({
        title: 'Are you sure?',
        html: "remove <b>"+name+"</b> from your cart?",
        icon: 'warning',
        customClass: 'swal-wide',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: function () {
          return new Promise(function (resolve) {
            $.ajax({
              type: "DELETE",
              headers: {
                 'Accept': 'application/json',
                 'Content-Type': 'application/json',
                 'X-CSRF-TOKEN': "{{csrf_token()}}"
               },
              data: JSON.stringify(
                {
                  'id': id,
                }),
              url: "/remove-from-cart/"+id,
              dataType: 'json',
            })
            // in case of successfully understood ajax response
              .done(function (data){
                // var obj = $.parseJSON(data);
                console.log(data);
                if (data.err == false) {
                  //throw message
                  Swal.fire("Added!",data.msg,"success");
                  //reload cart start
                  $.ajax({
                      url: "{{url('reloadcart')}}",
                      type: 'GET',
                      dataType: 'html'
                  })
                  .success(function(data)
                  {
                      $('#cart').html(data);
                  })
                  .fail(function() {
                    alert('error');
                  });
                  // reload cart end
                } else {
                  Swal.fire("Oops!",data.msg,"error");
                }
              })
              .fail(function (error,e) {
                console.log(error);
                Swal.fire('Oops!', e, 'error');
              })

          })
        }
      });
  })
</script>
