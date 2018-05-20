@extends('layouts.front')
<!-- header logo: style can be found in header.less -->
@section('content')
	@includeIf('admin.front.includes.header')
	@includeIf($view)
	@includeIf('admin.front.includes.footer')
@endsection