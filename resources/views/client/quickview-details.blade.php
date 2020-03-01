{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet"> --}}
<div class="row">
  <div class="col-md-12">
    <a href="#" class="pull-right" data-dismiss="modal" style="margin-left:20px"> <i class="fa fa-close fa-lg"></i> </a>
  </div>
  <div class="space-ten"></div>
  <div class="space-ten"></div>
</div>
<div class="row" id="row">

 <div class="col-md-6 product_img">
   <div class="col-md-12" id="product-img-content">
     {{-- <img src="{{asset('images/items/'.$data['id'].'-1.jpg')}}" class="img-responsive"> --}}
     <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" style="height:300px !important;">
          <div class="item active">
            <img src="{{asset('images/items/'.$data['id'].'-1.jpg')}}" class="img-responsive">
            <div class="carousel-caption">
              One Image
            </div>
          </div>
          <div class="item">
            <img src="{{asset('images/items/'.$data['id'].'-2.jpg')}}" class="img-responsive">
            <div class="carousel-caption">
              Another Image
            </div>
          </div>
           <div class="item">
           <img src="{{asset('images/items/'.$data['id'].'-3.jpg')}}" class="img-responsive">
            <div class="carousel-caption">
              Another Image
            </div>
          </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="fa fa-angle-left fa-4x"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="fa fa-angle-right fa-4x"></span>
        </a>
      </div>
   </div>
 </div>
 <div class="col-md-6 product_content">
   <div class="product-content-animate">
     <div class="product-content-item white">
       <h2>{{$data['name']}}</h2>
       <h5>{{\DB::table('categories')->where('id',$data['category'])->pluck('cat_name')[0]}}</h5>
       <div class="rating">
         <span class="fa fa-star"></span>
         <span class="fa fa-star"></span>
         <span class="fa fa-star"></span>
         <span class="fa fa-star"></span>
         <span class="fa fa-star"></span>
         (10 reviews)
       </div>
     </div>
     <div class="space-ten"></div>
     <div class="product-content-item white">
       <div>{!!$data['description']!!}</div>
       <div class="space-ten"></div>
       <div class="space-ten"></div>
     </div>
     <div class="space-ten"></div>

     <div class="product-content-item red">
       <h3 class="cost">{{\App\Common::rupiah($data['rent_price'])}} <small> per day</h3>
       <div class="row">
         <div class="col-md-12">
           <div class="form-group">
             <label style="color: white">Rental Plan:</label>
             <input type="text" class="form-control" id="reservation-range">
           </div>
         </div>

     <div class="space-ten"></div>
     <div class="col-md-12">
       <h5 id="reservation-text"></h5>
       <div class="space-ten"></div>
       <h4 class="float-right" id="reservation-approx"></h4>
       <div class="space-ten"></div>
       <div class="btn-ground">
         <button type="button" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> Add To Cart</button>
         <button type="button" class="btn btn-primary"><span class="fa fa-heart"></span> Add To Wishlist</button>
       </div>
     </div>
   </div>
 </div>
 </div>
</div>
<script type="text/javascript">
var startDate;
var endDate;
var price = {{$data['rent_price']}};
$(document).ready(function() {
    $('#reservation-range').daterangepicker(
       {
          drops:'up',
          startdate:moment(),
          dateLimit: { days: 14 },
          showWeekNumbers: true,
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'DD/MM/YYYY',
          separator: ' to ',
       },
       function(start, end) {
        console.log("Callback has been called!");
        $('#reservation-text').html((start.diff(end,'days')*-1) + ' days (' + start.format('D MMMM YYYY') + ' to ' + end.format('D MMMM YYYY') + ')');

        var duit = price*(start.diff(end,'days')*-1);
        var	number_string = duit.toString(),
      	sisa 	= number_string.length % 3,
      	rupiah 	= number_string.substr(0, sisa),
      	ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
        if (ribuan) {
        	separator = sisa ? '.' : '';
        	rupiah += separator + ribuan.join('.');
        }

        $('#reservation-approx').html('<span>approx.</span> Rp. ' + rupiah + ',00')
        tartDate = start;
         endDate = end;

       }
    );
    //Set the initial state of the picker label
    // $('#reservation-text span').html(moment().subtract('days', 29).format('D MMMM YYYY') + ' to ' + moment().format('D MMMM YYYY'));

 });
</script>
