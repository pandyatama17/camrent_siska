@php
	switch ($action) {
		case 'show':
			$action  = 'Items Data';
			break;
		case 'register_request':
			$action  = 'Unaccepted Registered Items';
			break;
		case 'retract_request':
			$action  = 'Retract Request';
			break;
		default:
			// code...
			break;
	}
@endphp
@extends('layout.admin')
@section('title','Items')
@section('content')
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">{{$action}}</h3>
		</div>
		<div class="card-body">
			<table class="table table-bordered" id="itemsTable">
				<thead>
					<tr>
						{{-- <th>#</th> --}}
						<th>Name</th>
						<th>Category</th>
						<th>Tenant</th>
						<th>Item Status</th>
						<th class="none">&nbsp;</th>
						<th class="none">Brand</th>
						<th class="none">Rent Price</th>
						<th class="none">Damage Fee</th>
						<th class="none">Description</th>
						{{-- <th>Action</th> --}}
					</tr>
				</thead>
				<tbody>
					@foreach ($items as $key => $i)
						@php
							$unreturned = count(\App\RentDetail::where('item_id',$i->id)->leftJoin('rents','rents.id','rent_details.parent_id')->where('rents.returned', false)->get());
						@endphp
						<tr>
							{{-- <td>&nbsp;&nbsp;<span>{{ $key + 1 }}</span> </td> --}}
							<td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $i->name }}</td>
							<td>{{\App\Category::find($i->category)->cat_name}}</td>
							<td>{{\App\User::find($i->tenant_id)->first_name}} {{\App\User::find($i->tenant_id)->last_name}}</td>
							<td>
								<div class="row">
									<div class="col-7">
										@if ($i->available == true)
											<span class="badge badge-success">Available</span>
										@else
											@if ($i->retracted == false)
												@if ($i->accepted == false)
													<span class="badge bg-orange text-white">Unaccepted</span>
												@else
													<span class="badge badge-danger">Currently Rented</span>
													@php
														$rd = \App\RentDetail::where('item_id',$i->id)->latest('id')->first();
														$r = \App\Rent::find($rd->parent_id);
														$cl = \App\User::find($r->user_id);
													@endphp
													<br>
													<small>
														rented at {{$rd->start_date}}, returning in {{$rd->end_date}}.
														<br>
														by {{$cl->first_name}} {{$cl->last_name}}
													</small>
												@endif
											@else
												<span class="badge badge-warning">Retracted</span>
											@endif
										@endif
									</div>
									<div class="col-5 border-left">
										@if ($i->available == false && $i->retract_request == false && $i->retracted == false && $i->accepted == true)
											<button type="button" class="btn btn-info" name="button">
												<i class="fa fa-receipt"></i> Invoice
											</button>
										@elseif ($i->available == false && $i->retract_request == false && $i->retracted == false && $i->accepted == false)
											<a href="{{route('accept_request',$i->id)}}" class="btn btn-primary" name="button">
												<i class="fa fa-handshake"></i> Confirm Lease
											</a>
										@elseif ($i->available == true && $i->retract_request == true && $i->retracted == false && $i->accepted == true)
											<button type="button" class="btn btn-warning" name="button">
												<i class="fa fa-dolly"></i> Confirm Rretract
											</button>
										@endif
									</div>
								</div>
							</td>
							<td>
								<div class="row">
									<div class="col-4">
										<img src="{{ asset('images/items/'.$i->id.'-1.jpg') }}" style="width:100%">
									</div>
									<div class="col-4">
										<img src="{{ asset('images/items/'.$i->id.'-2.jpg') }}" style="width:100%">
									</div>
									<div class="col-4">
										<img src="{{ asset('images/items/'.$i->id.'-3.jpg') }}" style="width:100%">
									</div>
								</div>
							</td>
							<td>{{\App\Brand::find($i->brand)->brand_name}}</td>
							<td>{{\App\Common::rupiah($i->rent_price)}}</td>
							<td>{{\App\Common::rupiah($i->bail_price)}}</td>
							<td>{{ $i->description }}</td>
							{{-- <td>-</td> --}}
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{-- <div class="card-footer">
			<button type="button" class="btn btn-primary" id="addItem">
				<i class="fa fa-plus"></i> Add Item
 			</button>
		</div> --}}
	</div>
	<div class="modal fade" id="modal-add">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add item Form</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{route('add_item')}}" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						@csrf
						<div class="row">
							<div class="col-lg-6 col-sm-12">
								<div class="form-group">
									<label>Item Name</label>
									<input type="text" name="name" class="form-control" placeholder="Item Name">
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="form-group">
									<label>Brand</label>
									<select class="select2 form-control" name="brand">
										<option selected disabled>Select brand....</option>
										@foreach (\App\Brand::all() as $brand)
											<option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="form-group">
									<label>Category</label>
									<select class="select2 form-control" name="category">
										<option selected disabled>Select Category....</option>
										@foreach (\App\Category::all() as $category)
											<option value="{{ $category->id }}">{{ $category->cat_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-5">
								<div class="form-group">
									<label>Rent Price</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp.</span>
										</div>
										<input type="number" name="rent_price" class="form-control" placeholder="rent price for the item">
										<div class="input-group-append">
											<span class="input-group-text">,-</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-5">
								<div class="form-group">
									<label>Damage Fee Charge</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp.</span>
										</div>
										<input type="number" name="bail_price" class="form-control" placeholder="Damage charge if the item is damaged when returned">
										<div class="input-group-append">
											<span class="input-group-text">,-</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-2">
								<div class="form-group">
									<label>Stock</label>
									<input type="number" name="stock" class="form-control" placeholder="Item stock">
								</div>
							</div>
							<div class="col-8">
								<div class="form-group">
									<label>Description</label>
									<textarea name="description" class="form-control" placeholder="Item description..." rows="8" cols="80"></textarea>
								</div>
							</div>
							<div class="col-4">
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Image 1</label>
											<input type="file" name="image-1" class="form-control" accept="image/jpeg">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Image 2</label>
											<input type="file" name="image-2" class="form-control" accept="image/jpeg">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Image 3</label>
											<input type="file" name="image-3" class="form-control" accept="image/jpeg">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit Finish</button>
					</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<script type="text/javascript">
		@if (Session::has('message'))
			Swal.fire('{{Session::get('message')}}','','{{Session::get('message-type')}}');
		@else

		@endif

		$("#itemsTable").DataTable({
			"paging": true,
			"ordering": true,
			"info": true,
			"responsive": true,
			// "aoColumns": [
			// 	{ "sType": 'numeric',"oCustomInfo":
			// 		{
	    // 			"decimalPlaces":1,
	    // 			"decimalSeparator":"."
			// 		}
      //   },
			// 	null,
			// 	null,
			// 	null,
			// 	null,
			// 	null,
			// 	null,
			// 	null,
			// 	null,
      //   null],
		});
		$("#addItem").click(function() {
			$("#modal-add").modal('show');
		});
		$('body').on('submit','form',function(event) {
			event.preventDefault();
			var form = $(this);
			var action  = form.attr('action');
			var data = form.formSerialize();
			form.ajaxSubmit(
			{
				url:action,
				type: 'POST',
				data : data,
				dataType: "JSON",
				beforeSend: function()
				{
						$("#sectionLoader").show(250);
				},
				success : function(response)
				{
					console.log(response);
					if (response.err == false) {
						Swal.fire('success',response.msg,'success').then(function() {
							window.location.reload();
						});
					}
					else {
						Swal.fire('failed',response.msg,'error');
					}
				}
			});
		});
	</script>
@endsection
