@extends('layout.wrapper')
@section('title','store')
@section('content')

  <!-- jplist Core for PHP / ASP.NET -->
  <link href="{{asset('jplist/dist/css/jplist.core.min.css')}}" rel="stylesheet" type="text/css" />
  <script src="{{asset('jplist/dist/js/jplist.core.min.js')}}"></script>

  <!-- jplist Sort Bundle -->
  <script src="{{asset('jplist/dist/js/jplist.sort-bundle.min.js')}}"></script>

  <!-- jplist Pagination Bundle -->
  <link href="{{asset('jplist/dist/css/jplist.pagination-bundle.min.css')}}" rel="stylesheet" type="text/css" />
  <script src="{{asset('jplist/dist/js/jplist.pagination-bundle.min.js')}}"></script>

  <!-- Textbox Filter Control -->
  <script src="{{asset('jplist/dist/js/jplist.textbox-filter.min.js')}}"></script>
  <link href="{{asset('jplist/dist/css/jplist.textbox-filter.min.css')}}" rel="stylesheet" type="text/css" />

  <!-- Toggle Filter Control -->
  <script src="{{asset('jplist/dist/js/jplist.filter-toggle-bundle.min.js')}}"></script>
  <link href="{{asset('jplist/dist/css/jplist.filter-toggle-bundle.min.css')}}" rel="stylesheet" type="text/css" />
  <style media="screen">
    .swal2-overflow {
    overflow-x: visible;
    overflow-y: visible;
    }
    .swal-wide{
      width:50% !important;
  }
    .swal2-icon.swal2-info , .swal2-icon.swal2-warning
    {
      font-size: 12pt!important;
    }
    .daterangepicker{
      overflow-x: scroll;
    }
    .drp-calendar,
    .table-condensed {
        width: 275px;
        height: 275px;
        font-size: 7pt;
    }
    .vertical-alignment-helper {
      display:table;
      height: 100%;
      width: 100%;
      pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
    }
    .vertical-align-center {
      /* To center vertically */
      display: table-cell;
      vertical-align: middle;
      pointer-events:none;
    }
  </style>
  <script>
    $('document').ready(function(){
      //check all jPList javascript options here
      $('#store').jplist({
        itemsBox: '.products',
        itemPath: '.product-item',
        panelPath: '.store-filter'
      });
      $('.checkbox-trigger').on('change',function()
      {
          var id = $(this).data('id');
          var checked = $(this).prop('checked');
          var kind = $(this).data('kind');
          if (checked == true)
          {
            $('#checkbox-'+kind+'-main-'+id).prop('checked', true);
            $('#checkbox-'+kind+'-main-'+id).trigger('change');
          }
          else if (checked == false)
          {
            $('#checkbox-'+kind+'-main-'+id).prop('checked', false);
            $('#checkbox-'+kind+'-main-'+id).trigger('change');
          }
      })
    });
  </script>
  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- ASIDE -->
        <div id="aside" class="col-md-3">
          <!-- aside Widget -->
          <div class="aside">
            <h3 class="aside-title">Categories</h3>
            <div class="checkbox-filter">
              @php
                $index = 1
              @endphp
              @foreach ($cats as $c)
                <div class="input-checkbox">
                  <input type="checkbox" id="category-{{$index}}" data-id="{{$c->id}}" class="checkbox-trigger" data-kind="category">
                  <label for="category-{{$index}}">
                    <span></span>
                    {{$c->cat_name}}
                    <small>({{\DB::table('items')->where('category', $c->id)->count()}})</small>
                  </label>
                </div>
                @php
                  $index++;
                @endphp
              @endforeach
            </div>
          </div>
          <!-- /aside Widget -->

          {{-- <!-- aside Widget -->
          <div class="aside">
            <h3 class="aside-title">Price</h3>
            <div class="price-filter">
              <div id="price-slider"></div>
              <div class="input-number price-min">
                <input id="price-min" type="number">
                <span class="qty-up">+</span>
                <span class="qty-down">-</span>
              </div>
              <span>-</span>
              <div class="input-number price-max">
                <input id="price-max" type="number">
                <span class="qty-up">+</span>
                <span class="qty-down">-</span>
              </div>
            </div>
          </div>
          <!-- /aside Widget --> --}}

          <!-- aside Widget -->
          <div class="aside">
            <h3 class="aside-title">Brand</h3>
            <div class="checkbox-filter">
              @php
              $index = 1;
              @endphp
              @foreach ($brands as $br)
                <div class="input-checkbox">
                  <input type="checkbox" id="brand-{{$index}}" data-id="{{$br->id}}" value="brand-{{$br->id}}" class="checkbox-trigger" data-kind="brand">
                  <label for="brand-{{$index}}">
                    <span></span>
                    {{$br->brand_name}}
                    <small>({{\DB::table('items')->where('brand', $br->id)->count()}})</small>
                  </label>
                </div>
                @php
                  $index = $index + 1;
                @endphp
              @endforeach
            </div>
          </div>
          <!-- /aside Widget -->

          <!-- aside Widget -->
          <div class="aside">
            <h3 class="aside-title">Top selling</h3>
            @foreach ($top_selling as $ts)
              <div class="product-widget">
                <div class="product-img">
                  <img src="{{asset('/images/items/'.$ts->id.'-1.jpg')}}" alt="">
                </div>
                <div class="product-body">
                  <p class="product-category">{{\DB::table('categories')->where('id', $ts->category)->pluck('cat_name')[0]}}</p>
                  <h3 class="product-name"><a href="product/{{$ts->id}}">{{$ts->name}}</a></h3>
                  <h4 class="product-price">{{\App\Common::rupiah($ts->rent_price)}}<small>/day</small></h4>
                </div>
              </div>
            @endforeach
          </div>
          <!-- /aside Widget -->
        </div>
        <!-- /ASIDE -->

        <!-- STORE -->
        <div id="store" class="col-md-9">
          <!-- store top filter -->
          <div class="store-filter clearfix jplist-panel panel-top">
               <div
               class="jplist-drop-down"
               data-control-type="items-per-page-drop-down"
               data-control-name="paging"
               data-control-action="paging">

               <ul>
                 <li><span data-number="3"> 3 per page </span></li>
                 <li><span data-number="5"> 5 per page </span></li>
                 <li><span data-number="10" data-default="true"> 10 per page </span></li>
                 <li><span data-number="all"> view all </span></li>
               </ul>
            </div>
            <!-- pagination results -->
            <div
                    class="jplist-label"
                    data-type="Page {current} of {pages}"
                    data-control-type="pagination-info"
                    data-control-name="paging"
                    data-control-action="paging">
            </div>

            <!-- pagination control -->
            <div
            class="jplist-pagination"
                data-control-type="pagination"
                data-control-name="paging"
                data-control-action="paging"
                data-items-per-page="5"
                >
            </div>
            <div
               class="jplist-group"
               data-control-type="checkbox-group-filter"
               data-control-action="filter"
               data-control-name="category"
               style="visibility:hidden"
            >
               @foreach ($cats as $cat)
                 <input
                   data-path=".category-{{$cat->id}}"
                   data-type="category"
                   id="checkbox-category-main-{{$cat->id}}"
                   type="checkbox" class="checkbox-main"
                 />

                 <label for="checkbox-main-{{$cat->cat_name}}">{{$cat->cat_name}}</label>
               @endforeach
             </div>
             <div
                class="jplist-group"
                data-control-type="checkbox-group-filter"
                data-control-action="filter"
                data-control-name="brand"
                style="visibility:hidden"
                >
                @foreach ($brands as $b)
                  <input
                    data-path=".brand-{{$b->id}}"
                    data-type="brand"
                    id="checkbox-brand-main-{{$b->id}}"
                    type="checkbox" class="checkbox-main"
                  />

                  <label for="checkbox-brand-main-{{$b->brand_name}}">{{$b->brand_name}}</label>
                @endforeach
              </div>
          </div>
          <!-- /store top filter -->

          <!-- store products -->
          <div class="products row">
            @foreach ($items as $it)
              <!-- product -->
              <div class="product-item col-md-4 col-xs-6 child-item">
                <div class="product">
                  <div class="product-img">
                    <img src="{{asset('images/items/'.$it->id.'-1.jpg')}}" alt="">
                    <div class="product-label">
                      <span class="new">NEW ({{$it->created_at->diffForHumans()}})</span>
                    </div>
                  </div>
                  <div class="product-body">
                    <p class="product-category brand-{{$it->brand}}">{{\DB::table('categories')->where('id', $it->category)->pluck('cat_name')[0]}}</p>
                    <h3 class="product-name category-{{$it->category}}"><a href="product/{{$it->id}}">{{$it->name}}</a></h3>
                    <h4 class="product-price">{{\App\Common::rupiah($it->rent_price)}}<small>/day</small></h4>
                    <div class="product-rating">
                      @if ($it->rating > 0)
                        <i class="fa fa-star"></i>
                      @else
                        <i class="fa fa-star-o"></i>
                      @endif
                      @if ($it->rating > 1)
                        <i class="fa fa-star"></i>
                      @else
                        <i class="fa fa-star-o"></i>
                      @endif
                      @if ($it->rating > 2)
                        <i class="fa fa-star"></i>
                      @else
                        <i class="fa fa-star-o"></i>
                      @endif
                      @if ($it->rating > 3)
                        <i class="fa fa-star"></i>
                      @else
                        <i class="fa fa-star-o"></i>
                      @endif
                      @if ($it->rating > 4)
                        <i class="fa fa-star"></i>
                      @else
                        <i class="fa fa-star-o"></i>
                      @endif
                    </div>
                    <div class="product-btns">
                      <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                      <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                      <button class="quick-view" class="btn btn-sm btn-info" data-url="{{ route('quickView',['id'=>$it->id])}}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                    </div>
                  </div>
                  <div class="add-to-cart">
                    <button class="add-to-cart-btn"
                      data-id = {{$it->id}}
                      data-name = {{$it->name}}
                      data-price = {{$it->rent_price}}
                      ><i class="fa fa-shopping-cart"></i> add to cart</button>
                  </div>
                </div>
              </div>
              <!-- /product -->
            @endforeach
          </div>
          <!-- /store products -->

          <!-- store bottom filter -->
          {{-- <div class="store-filter clearfix">
            <span class="store-qty">Showing 20-100 products</span>
            <ul class="store-pagination" id="pagin">
            </ul>
          </div> --}}
          <!-- /store bottom filter -->
        </div>
        <!-- /STORE -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <script type="text/javascript">
    $(document).ready(function()
    {
      var startDate;
      var endDate;
      var approxDate;
      var approxPrice;
      var rentPlan;
      $(".add-to-cart-btn").on('click',function() {
        var price = $(this).data('price');
        var name = $(this).data('name');
        var itemID = $(this).data('id');
        Swal.fire({
          title: 'Rental Plan',
          html: '<input id="datepicker" readonly class="swal2-input">'+
                '<span id="reservation-text"></span>'+
                '<span class="float-right" id="reservation-approx"></span`>',
          customClass: 'swal2-overflow',
          showCancelButton: true,
          // showConfirmButton: false,
          cancelButtonColor: "#DD6B55",
          confirmButtonColor: "#8CD4F5",
           onOpen:function(){
            // Swal.disableConfirmButton();
            $(".swal2-confirm").attr('disabled', 'disabled');
            $('#datepicker').daterangepicker(
               {
                  startDate:moment(),
                  minDate:moment(),
                  dateLimit: { days: 14 },
                  showWeekNumbers: true,
                  applyClass: 'btn-small btn-primary',
                  cancelClass: 'btn-small',
                  locale: {
          		          format: 'YYYY-MM-DD',
          		    },
          		    // format: 'DD/MM/YYYY',
                  separator: ' to ',
               },
               function(start, end) {
                console.log("Callback has been called!");
                approxDate = (start.diff(end,'days')*-1) + ' days (' + start.format('D MMMM YYYY') + ' to ' + end.format('D MMMM YYYY') + ')';

                var duit = price*(start.diff(end,'days')*-1);
                var	number_string = duit.toString(),
                 sisa 	= number_string.length % 3,
                 rupiah 	= number_string.substr(0, sisa),
                 ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
                if (ribuan) {
                 separator = sisa ? '.' : '';
                 rupiah += separator + ribuan.join('.');
                }
                approxPrice = '<span>approx.</span> Rp. ' + rupiah + ',00';
                startDate = start;
                endDate = end;
                rentPlan = (start.diff(end,'days')*-1);
               }
            ).on('show.daterangepicker',function(e) {
              var calendar = $(".daterangepicker.ltr.show-calendar").first();
              var offset = (calendar[0]).getBoundingClientRect();
              var width = calendar.width();
              var height = calendar.height();

              var window_height = $(window).height();
              var window_width = $(window).width();

              var centerX = offset.left - width / 4;    // [UPDATE] subtract to center
              var centerY = offset.top - height / 20;   // [UPDATE] subtract to center

              calendar.css('top',centerY);
              calendar.css('left',centerX);

            }).on('showCalendar.daterangepicker',function(e) {
              var calendar = $(".daterangepicker.ltr.show-calendar").first();
              var offset = (calendar[0]).getBoundingClientRect();
              var width = calendar.width();
              var height = calendar.height();

              var window_height = $(window).height();
              var window_width = $(window).width();

              var centerX = offset.left - width / 4;    // [UPDATE] subtract to center
              var centerY = offset.top - height / 20;   // [UPDATE] subtract to center

              calendar.css('top',centerY);
              calendar.css('left',centerX);

            }).on('apply.daterangepicker',function(e) {
              // Swal.update({ showConfirmButton:true})
              // Swal.enableConfirmButton()
              $(".swal2-confirm").removeAttr('disabled');
            });
          }
        }).then(function(result) {
        	if(result.value){
        		Swal.fire({
              title:'are  you sure?',
              html :'<br>'+
                    '<h2>'+name+'</h2>'+
                    '<br>'+
                    '<h4>Rent Plan</h4>'+
                    '<span>'+approxDate+'</span>'+
                    '<br>'+
                    '<br>'+
                    '<h4>Approximated price</h4>'+
                    '<span>'+approxPrice+'</span>',
              icon: 'info',
              customClass:'swal-wide',
              showCancelButton: true,
              confirmButtonColor: "#1FAB45",
              buttonsStyling: true,
              showLoaderOnConfirm: true,
              preConfirm: function () {
                return new Promise(function (resolve) {
                  $.ajax({
                    type: "PUT",
                    headers: {
                       'Accept': 'application/json',
                       'Content-Type': 'application/json',
                       'X-CSRF-TOKEN': "{{csrf_token()}}"
                     },
                    data: JSON.stringify(
                      {
                        'id': itemID,
                        'plan':rentPlan,
                        'start_date':startDate,
                        'end_date':endDate
                      }),
                    url: "/add-to-cart",
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
              },
            }).then(function () {

              });
        	}
        });
      });
    })
  </script>
  <!-- /SECTION -->
@endsection
