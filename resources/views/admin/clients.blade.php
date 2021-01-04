@extends('layout.admin')
@section('title','Items')
@section('content')
	<div class="row">
		<div class="col-lg-7 col-sm-12 ">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Items Data</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered" id="clientsTable">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Surname</th>
								<th>Contact</th>
								<th class="all" style="width:22%">action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($clients as $c)
								<tr>
									<td>{{ $c->first_name }}</td>
									<td>{{ $c->last_name }}</td>
									<td>
										<a href="mailto:{{ $c->email }}" class="text-info" style="font-size:10pt">
											<i class="fa fa-envelope"></i> {{ $c->email }}
										</a>
										<br>
										<a href="tel:{{ $c->phone }}" class="text-primary" style="font-size:10pt">
											<i class="fa fa-phone"></i> {{ $c->phone }}
										</a>
										<br>
										<a href="https://api.whatsapp.com/send?phone={{ $c->phone }}" class="text-green" style="font-size:10pt">
											<i class="fab fa-whatsapp"></i> {{ $c->phone }}
										</a>
									</td>
									<td>
										<button data-target="{{$c->id}}" class="btn btn-info showHistory"><i class="fa fa-history"></i> History</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-5 col-sm-12 ">
			<div class="card card-info">
				<div class="card-header">
					<h3 class="card-title">Rent History</h3>
				</div>
				<div class="card-body" id="historyContainer">
					<div style="height:500px" class="text-center">
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$("#clientsTable").DataTable({
			"paging": true,
			"ordering": true,
			"info": true,
			"responsive": true,
		});
		$(".showHistory").on('click',function()
		{
			var target = $(this).data('target');
			console.log("target: "+target);
			$.get({
				url: '/admin/client/history/'+target,
				dataType:'HTML',
				success: function(response)
				{
					$("#historyContainer").html(response);
				}
			})

		})

	</script>
@endsection
