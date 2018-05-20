@extends('layouts.dashboard')
<!-- header logo: style can be found in header.less -->
@section('content')
	@includeIf('admin.backend.includes.header')
	<div class="wrapper row-offcanvas row-offcanvas-left">
		@includeIf('admin.backend.includes.sidebar')
			@includeIf($view)
	</div><!-- ./wrapper -->
	@includeIf('includes.footer')
@endsection