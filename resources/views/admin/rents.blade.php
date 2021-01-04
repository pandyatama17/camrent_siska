@extends('layout.admin')
@section('title', $method.' Rents')
@section('content')
	@php
		$current_date = \Carbon\Carbon::today('Asia/Jakarta');

	@endphp
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">{{$method}} Rents Data</h3>
		</div>
		<div class="card-body">
			<table class="table table-bordered" id="rentsTable">
				<thead>
					<tr>
						<th>Code</th>
						<th>Client</th>
						<th>Rent Date</th>
						<th>Return Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($rents as $index => $r)
						@php
							$user = \App\User::find($r->user_id);
							$start = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$r->start_date." 00:00:00",'Asia/Jakarta');
							$end = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$r->end_date." 00:00:00",'Asia/Jakarta');
						@endphp
						<tr>
							<td><b>{{ $r->code }}</b></td>
							<td>{{ ucfirst(trans($user->first_name))." ".ucfirst(trans($user->last_name)) }}</td>
							<td>{{ $r->start_date }}</td>
							<td>{{ $r->end_date }}</td>
							@if ($start->lt($current_date) && $r->picked_up == false && $r->returned == false )
								<td>
									<span class="badge bg-orange"><span class="text-white">EXPIRED</span> </span>
								</td>
								<td>
									<p class="font-italic text-secondary">this order is expired</p>
								</td>
							@else
								<td>
									@if ($r->picked_up == false && $r->returned == false )
										<span class="badge badge-warning">not picked up yet</span>
									@elseif($r->picked_up == true && $r->returned == false)
										@if (!$end->gt($current_date))
											<span class="badge badge-danger">OVERDUE</span>
											<br>
											<span class="text-red font-italic">by {{ $end->diffInDays($current_date) }} days </span>
										@else
											<span class="badge badge-info">picked up</span>
										@endif
									@elseif($r->picked_up == true && $r->returned == true)
										<span class="badge badge-success">returned</span>
									@endif
								</td>
								<td>
									{{-- {{ $start->timezone."-".$start }} | {{ $current_date->timezone."-".$current_date }} --}}
									<button type="button" class="btn btn-info">
										<i class="fa fa-search"></i>
										Details
									</button>
									<div class="clear"></div>
									@if ($r->picked_up == 0 && $start->eq($current_date))
										<button type="button"
											class="btn btn-primary startOrder"
											data-id="{{$r->id}}"
											data-code="{{$r->code}}">
												<i class="fa fa-hourglass-start"></i>
												Start Order
										</button>
									@elseif ($r->picked_up == 1 &&  $r->returned == 0)
										<button type="button"
											data-id="{{$r->id}}"
											data-code="{{$r->code}}"
											@if (!$end->gt($current_date))
												class="btn btn-danger finishOrder"
												data-overdue = "{{ $end->diffInDays($current_date) }}"
											@else
												class="btn btn-success finishOrder"
												data-overdue = "0"
											@endif>
												<i class="fa fa-flag-checkered"></i>
												Finish Order
										</button>
									@elseif ($r->picked_up == 0 &&  $r->returned == 0)
										<p class="font-italic text-info">
											this order has not started
										</p>
									@endif
								</td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="modal fade" id="modal-finish">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Finish Order Form</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{route('finish_order')}}" method="post">
					<div class="modal-body" id="finish-container">
						<input type="hidden" name="id" id="rent_id" value="0">
						<input type="hidden" name="items" id="items" value="0">
						<table class="table table-boredered">
							<thead>
								<tr>
									<th>Item</th>
									<th>Rent Days</th>
									<th>Price</th>
									<th>Damaged</th>
								</tr>
							</thead>
							<tbody id="details-table">

							</tbody>
						</table>
						@csrf
						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="form-group row">
									<label class="col-3 col-form-label"> Client Name</label>
									<div class="col-9">
										: <span id="client_name"></span>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-3 col-form-label"> Subtotal</label>
									<div class="col-9">
										: <span id="subtotal"></span>
										<input type="hidden" id="hidden_subtotal" value="0">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-3 col-form-label"> Assurance</label>
									<div class="col-9">
										: <span id="assurance"></span>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group row">
									<label class="col-3 col-form-label"> Damage Fee</label>
									<div class="col-9">
										: <span id="damage_fee">Rp. 0,-</span>
										<input type="hidden" id="hidden_fee" value="0">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-3 col-form-label"> Overdue</label>
									<div class="col-9">
										: <span id="overdue"></span>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-3 col-form-label"> Overcharge</label>
									<div class="col-9">
										: <span id="overcharge">Rp. 0,-</span>
										<input type="hidden" name="overcharge" id="hidden_overcharge" value="0">
									</div>
								</div>
							</div>
							<div class="col-8 lg-offset-2">
								<div class="form-group row">
									<label class="col-3 col-form-label"> Total</label>
									<div class="col-9">
										: <span id="total"></span>
										<input type="hidden" name="total" id="hidden_total" value="0">
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
	<script>
	  $(function () {
	    var rentsTable = $("#rentsTable").DataTable();
			rentsTable.order([[3,'desc']]).draw();
	  });
		function parseRupiah(value)
		{
			return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
		}
		$(".startOrder").on('click',function()
		{
			var id = $(this).data('id');
			var code = $(this).data('code');

			$.get({
				url : '/admin/order/start/'+id,
				dataType : 'JSON',
				success: function(response) {
					if (response.error == false) {
						Swal.fire('success',response.message,'success').then(function() {
							window.location.reload();
						});
					}
					else {
						Swal.fire('error',response.message,'error');
					}
				}
			});
		});
		$(".finishOrder").on('click',function()
		{
			var id = $(this).data('id');
			var code = $(this).data('code');
			var overdue = parseInt($(this).data('overdue'));
			var items = 0;
			$.get({
				url : '/admin/order/get/'+id,
				dataType : 'JSON',
				success: function(response)
				{
					$("#overdue").html('');
					$("#overcharge").html('');
					console.log(response);
					$("#details-table").html("");
					$.each(response.details, function(key,value) {
						var subtotal = value['price'] * value['day_count'];
						$("#details-table").append('<tr><td>'+value['item']+'</td><td>'+value['day_count']+' days</td><td>Rp. '+parseRupiah(value['price'])+',-</td><td><input type="checkbox" class="form-control damaged" data-fee="'+value['damage_fee']+'" name="damaged_'+key+'" value="'+value['damage_fee']+'"><input type="hidden" name="details_'+key+'" value="'+value['id']+'"></td></tr>');
						items++;
					});
					$("#client_name").html(response.client['first_name']+" "+response.client['last_name']);
					$("#subtotal").html("Rp."+parseRupiah(response.rent['subtotal'])+',-');
					$("#assurance").html("Rp."+parseRupiah(response.rent['assurance'])+',-');
					$("#items").val(items);
					$("#rent_id").val(response.rent['id']);
					var total = parseInt(response.rent['total']);
					if (overdue >= 1)
					{
						$("#hidden_subtotal").val(parseInt(response.rent['total']));
						var overcharge = parseInt($("#hidden_subtotal").val())*overdue;

						$("#hidden_subtotal").val(parseInt(overcharge)+parseInt(response.rent['total']));
						$("#overdue").html(overdue+' days');
						$("#hidden_overcharge").val(overcharge);
						$("#overcharge").html('Rp.'+parseRupiah(overcharge)+',-');
						$("#total").html("Rp."+parseRupiah(parseInt(overcharge)+parseInt(response.rent['total']))+',-');
						total += overcharge
					}
					else {
						$("#hidden_subtotal").val(response.rent['subtotal']);
						$("#total").html("Rp."+parseRupiah(response.rent['total'])+',-');
						$("#overdue").html('');
						$("#overcharge").html('');
						$("#hidden_overcharge").val('0');
					}
					$("#hidden_total").val(total);
					$("#modal-finish").modal('show');
				}
			});
		});
		$(document).on('click','.damaged',function()
		{
			var fee = $(this).data('fee');
			var total = parseInt($("#hidden_total").val());
			var overcharge = parseInt($("#hidden_overcharge").val());
			if ($(this).prop('checked') == false)
			{
				var count = parseInt($("#hidden_fee").val())-parseInt(fee);
				$("#hidden_fee").val(count);
				$("#damage_fee").html('Rp.'+parseRupiah(count)+',-');
				total -= fee;
				$("#hidden_total").val(total);
			}
			else {
				var count = parseInt($("#hidden_fee").val())+parseInt(fee);
				$("#hidden_fee").val(count);
				$("#damage_fee").html('Rp.'+parseRupiah(count)+',-');
				total += fee;
				$("#hidden_total").val(total);
				// Swal.fire('Rp.'+parseRupiah(count)+",-");
			}
			$("#total").html('Rp.'+parseRupiah(total)+',-');
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
