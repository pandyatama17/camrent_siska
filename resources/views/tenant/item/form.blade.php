@extends('layout.admin')
@section('content')
  <section class="container">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Add New Item</h3>
      </div>
      <form enctype="multipart/form-data" action="{{action('TenantController@submitItem')}}" method="post">
        @csrf
        <input type="hidden" name="tenant_id" value="{{Auth::user()->id}}">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Item Details</h3>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select class="select2 form-control" name="category">
                      <option selected disabled>select a category...</option>
                      @foreach (\App\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Brand</label>
                    <select class="form-control select2" name="brand">
                      <option selected disabled>select a brand...</option>
                      @foreach (\App\Brand::all() as $br)
                        <option value="{{$br->id}}">{{$br->brand_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="form-group">
                        <label>Rent Price<small>/per day</small></label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp. </span>
                          </div>
                          <input type="number" id="priceInput" name="rent_price" class="form-control phone">
                          <div class="input-group-append">
                            <span class="input-group-text">,00</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <label> Tax (10%)</label>
                      <p id="commissionLabel" class="form-control-static"></p>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Item Description</label>
                    <textarea name="description" class="form-control" rows="8" cols="80"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Images</h3>
                </div>
                <div class="card-body">
                  @for ($i=1; $i <= 3; $i++)
                    <div class="form-group">
                      <label>Image {{$i}}</label>
                      <input type="file" accept="image/jpeg" data-index={{$i}} name="img_{{$i}}" id="imgInput_{{$i}}" class="form-control-file imgInput">
                    </div>
                  @endfor
                  <div class="form-group">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img id="img_1" class="d-block w-100" src="{{asset('images/400x400_placeholder.png')}}" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                          <img id="img_2" class="d-block w-100" src="{{asset('images/400x400_placeholder.png')}}" alt="Image 2">
                        </div>
                        <div class="carousel-item">
                          <img id="img_3" class="d-block w-100" src="{{asset('images/400x400_placeholder.png')}}" alt="Image 3">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Submit
          </button>
        </div>
      </form>
    </div>
  </section>
  <script type="text/javascript">
    $(document).ready(function() {
      $(".select2").select2();

      $("#priceInput").on('change',function(event)
      {
        var amt = parseInt($(this).val());
        var comm = (10/100)*amt;
        $("#commissionLabel").html("Rp. "+comm+",00");
      });
      $(".imgInput").on('change',function(event)
      {
        readImage(this,($(this).data('index')));
      });
    });
    function readImage(input,index) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#img_'+index).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }
  </script>
@endsection
