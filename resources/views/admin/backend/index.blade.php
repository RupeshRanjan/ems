@extends('layouts.dashboard')
<!-- header logo: style can be found in header.less -->
@section('content')
	@includeIf('admin.backend.includes.header')
		@includeIf('admin.backend.includes.sidebar')
		<div class="content-wrapper">
				@includeIf($view)
		</div><!-- ./wrapper -->
	@includeIf('includes.footer')
@endsection