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
<div id="view-modal" class="modal fade product_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
     <div class="modal-dialog">
       <div class="vertical-alignment-helper">
         <div class="vertical-align-center">
           <div class="modal-content">
             <div class="modal-body">
                 {{-- <div id="modal-loader" style="display: none; text-align: center;">
                  <img src="ajax-loader.gif">
                 </div> --}}
                 <!-- content will be load here -->
                 <div id="dynamic-content"></div>

              </div>
          </div>
         </div>
       </div>
      </div>
</div><!-- /.modal -->
