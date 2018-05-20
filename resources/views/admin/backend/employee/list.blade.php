<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Hover Data Table</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					{!! $html->table() !!}
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
@section('requirejs')
{!! $html->scripts()!!}
@endsection