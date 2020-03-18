<link rel="stylesheet" href="{{asset('css/animate.css')}}">
<script src="{{asset('js/autonumeric/autoNumeric.js')}}" charset="utf-8"></script>
<style media="screen">
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
  #reservation-text
  {
    color: white;
  }
  #reservation-approx
  {
    color: white;
  }
  .modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    max-width:inherit; /* For Bootstrap 4 - to avoid the modal window stretching full width */
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
  }
  .product_view .modal-dialog{max-width: 800px; width: 100%;}
  .pre-cost{text-decoration: line-through; color: #a5a5a5;}
  .cost > small{
    color: white;
  }
  .modal-content{
    background-color: rgba(28,27,34,.75);
    -webkit-backdrop-filter: blur(20px)
  }
  .space-ten{padding: 10px 0;}
  /* .product-content-item > h4 { color:white}
  .product-content-item > h5 { color:white}
  .modal-content{background-color: rgba(255,255,255,.75)}
  .modal-content>*{color: white} */
  .red > h3 { color:white}
  body.modal-open .section{
    -webkit-filter: blur(2px);
    -moz-filter: blur(2px);
    -o-filter: blur(2px);
    -ms-filter: blur(2px);
    filter: blur(2px);
  }
  .product-content-animate
  {
    visibility: hidden;
  }
  .product-content-item
  {
    /* border:1px solid rgba(216,0,0,.75); */
    border-radius: 5px;
    padding: 10px;
  }
  .white
  {
    /* background-color: rgba(28,27,34,.75); */
    background-color: rgba(255,255,255,.75);
  }
  .red
  {
    background-color: rgba(248,0,14,1);
  }
  #product-img-content
  {
    vertical-align: middle;
    height: 100%;
    border-radius: 5px;
    /* background-color: rgba(255,255,255,.9); */
  }
  #row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
  flex-wrap: wrap;
  }
  #row > [class*='col-'] {
    display: flex;
    flex-direction: column;
  }
</style>
<div id="add-cart-modal" class="modal fade product_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
       <div class="vertical-alignment-helper">
         <div class="vertical-align-center">
           <div class="modal-content">
             <div class="modal-body">
                 {{-- <div id="modal-loader" style="display: none; text-align: center;">
                  <img src="ajax-loader.gif">
                 </div> --}}
                 <!-- content will be load here -->
                 <div class="row">
                   <div class="col-md-12">
                     <a href="#" class="pull-right" data-dismiss="modal" style="margin-left:20px"> <i class="fa fa-close fa-lg"></i> </a>
                   </div>
                   <div class="space-ten"></div>
                   <div class="space-ten"></div>
                 </div>
                 <div class="row" id="row">
                  <div class="col-md-6 product_content">
                    <div class="product-content-animate">
                      <div class="product-content-item red">
                        <h3 class="cost">{{\App\Common::rupiah($item->rent_price)}} <small> per day</h3>
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
                            {{-- <div class="space-ten"></div> --}}
                            <h4 class="float-right" id="reservation-approx"></h4>
                          </div>
                        </div>
                      </div>
                      <div class="product-details product-content-item black text-center">
                        <div class="add-to-cart">
                          {{-- <button class="add-to-cart-btn"><i class="fa fa-heart-o"></i> add to wishlist</button> --}}
                          <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                      </div>
                  </div>
                 </div>
               </div>
              </div>
          </div>
         </div>
       </div>
      </div>
</div><!-- /.modal -->
<script type="text/javascript">
var startDate;
var endDate;
var price = {{$item['rent_price']}};
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
