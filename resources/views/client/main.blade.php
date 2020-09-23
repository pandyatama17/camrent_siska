@extends('layout.wrapper')
@section('title','Main')
@section('content')
@include('client.quickview')
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="{{asset('images/gallery-dslr.jpg')}}" alt="">
            </div>
            <div class="shop-body">
              <h3>DSLR<br>Collection</h3>
              <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="{{asset('images/gallery-mirrorless.jpg')}}" alt="">
            </div>
            <div class="shop-body">
              <h3>Mirrorless<br>Collection</h3>
              <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->

        <!-- shop -->
        <div class="col-md-4 col-xs-6">
          <div class="shop">
            <div class="shop-img">
              <img src="{{asset('images/gallery-lens.jpg')}}" alt="">
            </div>
            <div class="shop-body">
              <h3>Lenses<br>Collection</h3>
              <a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /shop -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">

        <!-- section title -->
        <div class="col-md-12">
          <div class="section-title">
            <h3 class="title">New Arrivals</h3>
            <div class="section-nav">
              <ul class="section-tab-nav tab-nav">
                <li class="active"><a data-toggle="tab" href="#tab1">Cameras</a></li>
                <li><a data-toggle="tab" href="#tab2">DSLR</a></li>
                <li><a data-toggle="tab" href="#tab3">Mirrorless</a></li>
                <li><a data-toggle="tab" href="#tab4">Lenses</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /section title -->

        <!-- Products tab & slick -->
        <div class="col-md-12">
          <div class="row">
            <div class="products-tabs">
              <!-- tab -->
              <div id="tab1" class="tab-pane active">
                <div class="products-slick" data-nav="#slick-nav-1">
                  <!-- product -->
                  @foreach ($new as $n)
                    <div class="product">
                      <div class="product-img">
                        <img src="{{asset('images/items/'.$n->id.'-1.jpg')}}" alt="">
                        <div class="product-label">
                          <span class="new">NEW ({{$n->created_at->diffForHumans()}})</span>
                        </div>
                      </div>
                      <div class="product-body">
                        <p class="product-category">{{\DB::table('categories')->where('id', $n->category)->pluck('cat_name')[0]}}</p>
                        <h3 class="product-name"><a href="product/{{$n->id}}">{{$n->name}}</a></h3>
                        <h4 class="product-price">{{\App\Common::rupiah($n->rent_price)}}<small>/day</small></h4>
                        <div class="product-rating">
                          @if ($n->rating > 0)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($n->rating > 1)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($n->rating > 2)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($n->rating > 3)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($n->rating > 4)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                        </div>
                        <div class="product-btns">
                          <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                          <button class="add-to-compare" data-url="/product/{{$n->id}}"><i class="fa fa-search"></i><span class="tooltipp">view details</span></button>
                          <button class="quick-view" class="btn btn-sm btn-info" data-url="{{ route('quickView',['id'=>$n->id])}}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                      </div>
                      <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div id="slick-nav-1" class="products-slick-nav"></div>
              </div>
              <!-- /tab -->
              <!-- tab -->
              <div id="tab2" class="tab-pane">
                <div class="products-slick" data-nav="#slick-nav-2">
                  <!-- product -->
                  @foreach ($new_dslr as $nd)
                    <div class="product">
                      <div class="product-img">
                        <img src="{{asset('images/items/'.$nd->id.'-1.jpg')}}" alt="">
                        <div class="product-label">
                          <span class="new">NEW ({{$n->created_at->diffForHumans()}})</span>
                        </div>
                      </div>
                      <div class="product-body">
                        <p class="product-category">{{\DB::table('categories')->where('id', $nd->category)->pluck('cat_name')[0]}}</p>
                        <h3 class="product-name"><a href="product/{{$nd->id}}">{{$nd->name}}</a></h3>
                        <h4 class="product-price">{{\App\Common::rupiah($nd->rent_price)}}<small>/day</small></h4>
                        <div class="product-rating">
                          @if ($nd->rating > 0)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nd->rating > 1)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nd->rating > 2)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nd->rating > 3)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nd->rating > 4)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                        </div>
                        <div class="product-btns">
                          <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                          <button class="add-to-compare" data-url="/product/{{$nd->id}}"><i class="fa fa-search"></i><span class="tooltipp">view details</span></a>
                          <button class="quick-view" class="btn btn-sm btn-info" data-url="{{ route('quickView',['id'=>$nd->id])}}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                      </div>
                      <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div id="slick-nav-2" class="products-slick-nav"></div>
              </div>
              <!-- /tab -->
              <!-- tab -->
              <div id="tab3" class="tab-pane">
                <div class="products-slick" data-nav="#slick-nav-3">
                  <!-- product -->
                  @foreach ($new_mirr as $nm)
                    <div class="product">
                      <div class="product-img">
                        <img src="{{asset('images/items/'.$nm->id.'-1.jpg')}}" alt="">
                        <div class="product-label">
                          <span class="new">NEW ({{$n->created_at->diffForHumans()}})</span>
                        </div>
                      </div>
                      <div class="product-body">
                        <p class="product-category">{{\DB::table('categories')->where('id', $nm->category)->pluck('cat_name')[0]}}</p>
                        <h3 class="product-name"><a href="product/{{$nm->id}}">{{$nm->name}}</a></h3>
                        <h4 class="product-price">{{\App\Common::rupiah($nm->rent_price)}}<small>/day</small></h4>
                        <div class="product-rating">
                          @if ($nm->rating > 0)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nm->rating > 1)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nm->rating > 2)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nm->rating > 3)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nm->rating > 4)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                        </div>
                        <div class="product-btns">
                          <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                          <button class="add-to-compare" data-url="/product/{{$nm->id}}"><i class="fa fa-search"></i><span class="tooltipp">view details</span></button>
                          <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                      </div>
                      <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div id="slick-nav-3" class="products-slick-nav"></div>
              </div>
              <!-- /tab -->
              <!-- tab -->
              <div id="tab4" class="tab-pane">
                <div class="products-slick" data-nav="#slick-nav-4">
                  <!-- product -->
                  @foreach ($new_lens as $nl)
                    <div class="product">
                      <div class="product-img">
                        <img src="{{asset('images/items/'.$nl->id.'-1.jpg')}}" alt="">
                        <div class="product-label">
                          <span class="new">NEW ({{$n->created_at->diffForHumans()}})</span>
                        </div>
                      </div>
                      <div class="product-body">
                        <p class="product-category">{{\DB::table('categories')->where('id', $nl->category)->pluck('cat_name')[0]}}</p>
                        <h3 class="product-name"><a href="product/{{$nl->id}}">{{$nl->name}}</a></h3>
                        <h4 class="product-price">{{\App\Common::rupiah($nl->rent_price)}}<small>/day</small></h4>
                        <div class="product-rating">
                          @if ($nl->rating > 0)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nl->rating > 1)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nl->rating > 2)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nl->rating > 3)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                          @if ($nl->rating > 4)
                            <i class="fa fa-star"></i>
                          @else
                            <i class="fa fa-star-o"></i>
                          @endif
                        </div>
                        <div class="product-btns">
                          <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                          <button class="add-to-compare" data-url="/product/{{$nl->id}}"><i class="fa fa-search"></i><span class="tooltipp">view details</span></button>
                          <button class="quick-view" class="btn btn-sm btn-info" data-url="{{ route('quickView',['id'=>$nl->id])}}"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                        </div>
                      </div>
                      <div class="add-to-cart">
                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div id="slick-nav-4" class="products-slick-nav"></div>
              </div>
              <!-- /tab -->
            </div>
          </div>
        </div>
        <!-- Products tab & slick -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->

  <!-- HOT DEAL SECTION -->
  <div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-12">
          <div class="hot-deal">
            <ul class="hot-deal-countdown">
              <li>
                <div>
                  <h3>02</h3>
                  <span>Days</span>
                </div>
              </li>
              <li>
                <div>
                  <h3>10</h3>
                  <span>Hours</span>
                </div>
              </li>
              <li>
                <div>
                  <h3>34</h3>
                  <span>Mins</span>
                </div>
              </li>
              <li>
                <div>
                  <h3>60</h3>
                  <span>Secs</span>
                </div>
              </li>
            </ul>
            <h2 class="text-uppercase">hot deal this week</h2>
            <p>New Collection Up to 50% OFF</p>
            <a class="primary-btn cta-btn" href="#">Shop now</a>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /HOT DEAL SECTION -->

  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div class="col-md-4 col-xs-6">
          <div class="section-title">
            <h4 class="title">Top DSLR</h4>
            <div class="section-nav">
              <div id="slick-nav-5" class="products-slick-nav"></div>
            </div>
          </div>

          <div class="products-widget-slick" data-nav="#slick-nav-5">
            <div>
            @foreach ($top as $t)
                <div class="product-widget">
                  <div class="product-img">
                    <img src="{{asset('images/items/'.$t->id.'-1.jpg')}}" alt="">
                  </div>
                  <div class="product-body">
                    <p class="product-category">{{\DB::table('categories')->where('id', $t->category)->pluck('cat_name')[0]}}</p>
                    <h3 class="product-name"><a href="product/{{$t->id}}">{{$t->name}}</a></h3>
                    <h4 class="product-price">{{\App\Common::rupiah($t->rent_price)}}<small>/day</small></h4>
                  </div>
                </div>
            @endforeach
            </div>
          </div>
        </div>

        <div class="col-md-4 col-xs-6">
          <div class="section-title">
            <h4 class="title">Top DSLR</h4>
            <div class="section-nav">
              <div id="slick-nav-6" class="products-slick-nav"></div>
            </div>
          </div>

          <div class="products-widget-slick" data-nav="#slick-nav-6">
            <div>
            @foreach ($top_dslr as $td)
                <div class="product-widget">
                  <div class="product-img">
                    <img src="{{asset('images/items/'.$td->id.'-1.jpg')}}" alt="">
                  </div>
                  <div class="product-body">
                    <p class="product-category">{{\DB::table('categories')->where('id', $td->category)->pluck('cat_name')[0]}}</p>
                    <h3 class="product-name"><a href="product/{{$td->id}}">{{$td->name}}</a></h3>
                    <h4 class="product-price">{{\App\Common::rupiah($td->rent_price)}}<small>/day</small></h4>
                  </div>
                </div>
            @endforeach
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm visible-xs"></div>

        <div class="col-md-4 col-xs-6">
          <div class="section-title">
            <h4 class="title">Top Mirrorless</h4>
            <div class="section-nav">
              <div id="slick-nav-7" class="products-slick-nav"></div>
            </div>
          </div>

          <div class="products-widget-slick" data-nav="#slick-nav-7">
            <div>
            @foreach ($top_mirr as $tm)
                <div class="product-widget">
                  <div class="product-img">
                    <img src="{{asset('images/items/'.$tm->id.'-1.jpg')}}" alt="">
                  </div>
                  <div class="product-body">
                    <p class="product-category">{{\DB::table('categories')->where('id', $tm->category)->pluck('cat_name')[0]}}</p>
                    <h3 class="product-name"><a href="product/{{$tm->id}}">{{$tm->name}}</a></h3>
                    <h4 class="product-price">{{\App\Common::rupiah($tm->rent_price)}}<small>/day</small></h4>
                  </div>
                </div>
            @endforeach
            </div>
          </div>
        </div>

      </div>
      <!-- /row -->
    <!-- /container -->
  </div>
  <script>
$(document).ready(function(){

    $(document).on('click', '.quick-view', function(e){

        e.preventDefault();

        var url = $(this).data('url');

        $('#dynamic-content').html(''); // leave it blank before ajax call

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .success(function(data)
        {
            $("#view-modal").modal('show');
             // $(".modal-backdrop.in").hide();
            $('#dynamic-content').html('');
            $('#dynamic-content').html(data); // load response
            // $('#modal-loader').hide();        // hide ajax loader
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="fa fa-error"></i> Something went wrong, Please try again...');
            // $('#modal-loader').hide();
        });

    });
    $('.modal').on('show.bs.modal', function (e)
    {
      $('.modal .modal-dialog').attr('class', 'modal-dialog  flipInX  animated');
      setTimeout(function()
      {
        $('.product-content-animate').attr('style', 'visibility: visible !important;').attr('class','fadeInLeft animated');
      },500)
    });
    $('.modal').on('hide.bs.modal', function (e)
    {
      $('.modal .modal-dialog').attr('class', 'modal-dialog  flipOutX  animated');
    });

      $('.add-to-compare').on('click', function() {
        var url = $(this).closest('button').data('url');
        window.location.href = url;
      })
});

</script>
@endsection
