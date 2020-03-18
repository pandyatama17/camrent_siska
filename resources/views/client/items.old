@extends('layout.wrapper')
@section('title','store')
@section('content')
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
              @foreach ($cats as $c)
                <div class="input-checkbox">
                  <input type="checkbox" id="category-1">
                  <label for="category-1">
                    <span></span>
                    {{$c->cat_name}}
                    <small>({{\DB::table('items')->where('category', $c->id)->count()}})</small>
                  </label>
                </div>
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
                  <input type="checkbox" id="brand-{{$index}}" value="brand-{{$br->id}}">
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
          <div class="store-filter clearfix">
            <div class="store-sort">
              <label>
                Sort By:
                <select class="input-select">
                  <option value="0">Popular</option>
                  <option value="1">Position</option>
                </select>
              </label>

              <label>
                Show:
                <select class="input-select" id="viewProduct">
                  <option value="6">6</option>
                  <option value="12">12</option>
                </select>
              </label>
            </div>
            <ul class="store-grid">
              <li class="active"><i class="fa fa-th"></i></li>
              <li><a href="#"><i class="fa fa-th-list"></i></a></li>
            </ul>
          </div>
          <!-- /store top filter -->

          <!-- store products -->
          <div class="row">
            @foreach ($items as $it)
              <!-- product -->
              <div class="col-md-4 col-xs-6 child-item brand-{{$it->brand}}">
                <div class="product">
                  <div class="product-img">
                    <img src="{{asset('images/items/'.$it->id.'-1.jpg')}}" alt="">
                    <div class="product-label">
                      <span class="new">NEW ({{$it->created_at->diffForHumans()}})</span>
                    </div>
                  </div>
                  <div class="product-body">
                    <p class="product-category">{{\DB::table('categories')->where('id', $it->category)->pluck('cat_name')[0]}}</p>
                    <h3 class="product-name"><a href="product/{{$it->id}}">{{$it->name}}</a></h3>
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
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                  </div>
                </div>
              </div>
              <!-- /product -->
            @endforeach
          </div>
          <!-- /store products -->

          <!-- store bottom filter -->
          <div class="store-filter clearfix">
            <span class="store-qty">Showing 20-100 products</span>
            <ul class="store-pagination" id="pagin">
            </ul>
          </div>
          <!-- /store bottom filter -->
        </div>
        <!-- /STORE -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /SECTION -->
  <script type="text/javascript">
    $(document).ready(function()
    {
      pageSize = 6;

      countPage = function()
      {
        $("#pagin").empty();
        var pageCount =  $(".child-item").length / pageSize;
        for(var i = 0 ; i<pageCount;i++)
        {
          $("#pagin").append('<li><a href="#">'+(i+1)+'</a></li> ');
        }
      }

      $("#viewProduct").on('change',function() {
        pageSize = $(this).val();
        var par = $(".active").find("a").trigger("click");
        // var cur = $("#pagin .active").index();
        countPage();
        // showPage(cur + 1);
      });

      showPage = function(page)
      {
        $(".child-item").hide();
        $(".child-item").each(function(n) {
            if (n >= pageSize * (page - 1) && n < pageSize * page)
                $(this).show();
        });
      }
      countPage();
      $("#pagin li").first().addClass("active");
      showPage(1);

      $("#pagin li a").click(function() {
        $("#pagin li").removeClass("active");
        $(this).parent().addClass("active");
        showPage(parseInt($(this).text()))
      });

      $("#checkbox-filter :checkbox").click(function() {
         $("div").hide();
         $("#checkbox-filter :checkbox:checked").each(function() {
             $("." + $(this).val()).show();
         });
      });
    });
  </script>
@endsection
