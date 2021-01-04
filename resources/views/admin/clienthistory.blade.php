<table class="table table-bordered" id="historyTable">
	<thead>
		<tr>
			<th>Rent Code</th>
			<th>Items</th>
			<th class="all" style="width:22%">action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rents as $r)
			@php
				$details = \App\RentDetail::where('parent_id',$r->id)->get();
			@endphp
			<tr>
				<td>{{ $r->code }}</td>
				<td>
					<ul>
						@foreach ($details as $rd)
							<li>{{ \App\Item::find($rd->item_id)->name }}. <br><span class="badge bg-purple">({{$rd->day_count}} days.)</span> @if ($rd->damaged == true) <span class="badge badge-danger">DAMAGED</span> @endif</li>
						@endforeach
					</ul>
				</td>
				<td>
					<a href="#" class="btn btn-info">
						<i class="fa fa-receipt"></i> Invoice
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$("#historyTable").DataTable({
		"paging":true,
		"bLengthChange": false,
		"search": true,
		"info": true,
	})
</script>
