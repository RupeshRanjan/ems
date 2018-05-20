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
					<form role="add-employee" action="{{url('admin/employee')}}" method ="POST">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="first_name">First Name</label>
										<input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter First Name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="last_name">Last Name</label>
										<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter Last Name">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
					                    <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="" placeholder="Enter Email">
									</div>
								</div>							
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Date Of Birth</label>
                                        <div class="hashowCalender showCalendarWithInput">
                                            <input type="text" name="date_of_birth" class="form-control datepicker" readonly="readonly" name="date_of_birth" value="" placeholder="Enter Date Of Birth">
                                        </div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label>Gender</label>
									<div class="form-control radioGenderFormControl">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
								                    <div class="form-check">
								                      	<input class="form-check-input" name="gender" value="male" checked="checked" type="radio" >
								                      	<label class="form-check-label">Male</label>
								                    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
								                    <div class="form-check">
								                      	<input class="form-check-input" name="gender" type="radio" value="female">
								                      	<label class="form-check-label">Female</label>
								                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
							                    <label>Phone Code</label>
							                    <select name="phone_code" class="form-control">
							                    	<option value="+91">+91</option>
							                    </select>
											</div>
										</div>
										<div class="col-md-9">
											<div class="form-group">
							                    <label>Mobile Number</label>
							                    <input type="text" class="form-control" id="exampleInputEmail1" name="mobile_number" placeholder="Enter Mobile Number">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Current Address</label>
										<textarea name="current_address"  class="form-control" placeholder="Current Address"></textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Permanent Address</label>
										<textarea name="permanent_address"  class="form-control" placeholder="Permanent Address"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label>Marital Status</label>
									<div class="form-control radioGenderFormControl">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
								                    <div class="form-check">
								                      	<input type="radio" class="form-check-input" name="marital_status" value="married" >
								                      	<label class="form-check-label">Married</label>
								                    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
								                    <div class="form-check">
								                      	<input type="radio" class="form-check-input" name="marital_status"  value="single">
								                      	<label class="form-check-label">Single</label>
								                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">Employee Id</label>
										<input type="text" name="employee_id" class="form-control" id="exampleInputEmail1" placeholder="Enter Employee Id">
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
					                    <label>Date Of Joining</label>
                                        <div class="hashowCalender showCalendarWithInput">
                                            <input type="text" class="form-control datepicker" readonly="readonly" name="date_of_joining" value="" placeholder="Enter Date Of Joining">
                                        </div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">						
									<div class="form-group">
										<label for="exampleInputFile">Profile Image</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" name="profile_picture" class="custom-file-input" id="exampleInputFile">
												<label class="custom-file-label" for="exampleInputFile">Choose file</label>
											</div>
											<div class="input-group-append">
												<span class="input-group-text" id="">Upload</span>
											</div>
										</div>
									</div>
								</div>	
								<div class="col-md-6">						
									<div class="form-group">
										<label for="exampleInputFile">Signature</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" name="signature" class="custom-file-input" id="exampleInputFile">
												<label class="custom-file-label" for="exampleInputFile">Choose file</label>
											</div>
											<div class="input-group-append">
												<span class="input-group-text" id="">Upload</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.card-body -->

						<div class="card-footer">
							<button type="button" data-request="ajax-submit" data-target='[role="add-employee"]' class="btn btn-primary">Submit</button>
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