<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="textAlign">Add Employee</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active ">General Form</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Employee Detail</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form role="form">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">First Name</label>
										<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Last Name</label>
										<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Employee Id</label>
										<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Date Of Birth</label>
                                        <div class="hashowCalender showCalendarWithInput">
                                            <input type="text" class="form-control datepicker" readonly="readonly" name="date_of_birth" value="">
                                        </div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputFile">File input</label>
								<div class="input-group">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="exampleInputFile">
										<label class="custom-file-label" for="exampleInputFile">Choose file</label>
									</div>
									<div class="input-group-append">
										<span class="input-group-text" id="">Upload</span>
									</div>
								</div>
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">Check me out</label>
							</div>
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
				</div>
			<!--/.col (left) -->
			<!-- right column -->
		 
			<!--/.col (right) -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>
@section('requirejs')
    <script type="text/javascript">
		dynamicDatepicker('.datepicker',true,false); 
	</script>
@endsection   