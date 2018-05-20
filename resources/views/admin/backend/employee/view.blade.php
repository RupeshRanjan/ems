<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">

				<!-- Profile Image -->
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="profile-user-img img-fluid img-circle"
							src="{{$profile['profile_picture']}}"
							alt="User profile picture">
						</div>

						<h3 class="profile-username text-center">{{$profile['name']}}</h3>

						<p class="text-muted text-center">{{$profile['designation']}}</p>
						<p class="text-muted text-center">{{strtoupper($profile['status'])}}</p>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Employee Id</b> <a class="float-right">{{$profile['employee_id']}}</a>
							</li>
							<li class="list-group-item">
								<b>Email</b> <a class="float-right">{{$profile['email']}}</a>
							</li>
							<li class="list-group-item">
								<b>Mobile</b> <a class="float-right">{{sprintf('%s - %s',$profile['phone_code'],$profile['mobile_number'])}}</a>
							</li>
							<li>
								<img class="img-fluid mb-3" src="{{$profile['signature']}}" alt="Photo">
							</li>
						</ul>
						@if($profile['status'] == 'inactive')
							<a href="javascript:void(0);" class="btn btn-primary btn-block" data-url="{{url(sprintf('admin/employee/status/?id=%s&status=active',$profile['id_user']))}}" data-request="ajax-confirm" data-ask_image=" {{ url('/images/active-user.png') }}"" data-ask="Would you like to change ' {{$profile['name']}}' status from inactive to active?" >{{ucfirst($profile['status'])}}</a>
						@elseif($profile['status'] == 'pending')
							<a href="javascript:void(0);" class="btn btn-primary btn-block" data-url="{{url(sprintf('admin/employee/status/?id=%s&status=active',$profile['id_user']))}}" data-request="ajax-confirm" data-ask_image=" {{ url('/images/active-user.png') }}"" data-ask="Would you like to change ' {{$profile['name']}}' status from pending to inactive?" >{{ucfirst($profile['status'])}}</a>
						@else
							<a href="javascript:void(0);" class="btn btn-primary btn-block" data-url="{{url(sprintf('admin/employee/status/?id=%s&status=inactive',$profile['id_user']))}}" data-request="ajax-confirm" data-ask_image=" {{ url('/images/inactive-user.png') }}"" data-ask="Would you like to change ' {{$profile['name']}}' status from active to inactive?" >{{ucfirst($profile['status'])}}</a>
						@endif
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->

				<!-- About Me Box -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">About Me</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<strong><i class="fa fa-book mr-1"></i> Education</strong>

						<p class="text-muted">
							B.S. in Computer Science from the University of Tennessee at Knoxville
						</p>

						<hr>

						<strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

						<p class="text-muted">Malibu, California</p>

						<hr>

						<strong><i class="fa fa-pencil mr-1"></i> Skills</strong>

						<p class="text-muted">
							<span class="tag tag-danger">UI Design</span>
							<span class="tag tag-success">Coding</span>
							<span class="tag tag-info">Javascript</span>
							<span class="tag tag-warning">PHP</span>
							<span class="tag tag-primary">Node.js</span>
						</p>

						<hr>

						<strong><i class="fa fa-file-text-o mr-1"></i> Notes</strong>

						<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<div class="card">
					<div class="card-header p-2">
						<ul class="nav nav-pills">
							<li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Edit</a></li>
						</ul>
					</div><!-- /.card-header -->
					<div class="card-body">
						<div class="tab-content">
							<div class="tab-pane active" id="settings">
								<form class="form-horizontal">

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="first_name">First Name</label>
										<input type="text" class="form-control" name="first_name" id="first_name" maxlength="{{NAME_MAX_LENGTH}}" placeholder="Enter First Name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="last_name">Last Name</label>
										<input type="text" class="form-control" name="last_name" id="last_name" maxlength="{{NAME_MAX_LENGTH}}" placeholder="Enter Last Name">
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
								                      	<input class="form-check-input" name="gender" id="gender_male" value="male" checked="checked" type="radio" >
								                      	<label for="gender_male" class="form-check-label">Male</label>
								                    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
								                    <div class="form-check">
								                      	<input class="form-check-input" name="gender" id="gender_female" type="radio" value="female">
								                      	<label for="gender_female" class="form-check-label">Female</label>
								                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
				                    <label>Mobile Number</label>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
							                    <select name="phone_code" class="form-control">
							                    	<option value="+91">+91</option>
							                    </select>
											</div>
										</div>
										<div class="col-md-9">
											<div class="form-group">
							                    <input type="text" class="form-control" id="mobile_number" maxlength="{{PHONE_NUMBER_MAX_LENGTH}}" name="mobile_number" placeholder="Enter Mobile Number">
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
								                      	<input type="radio" class="form-check-input" id="marital_status_married" name="marital_status" value="married" >
								                      	<label for="marital_status_married" class="form-check-label">Married</label>
								                    </div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
								                    <div class="form-check">
								                      	<input type="radio" class="form-check-input" id="marital_status_single" name="marital_status"  value="single" checked="checked">
								                      	<label for="marital_status_single" class="form-check-label">Single</label>
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
								<div class="col-md-6">
									<div class="form-group">
					                    <label>Date Of Joining</label>
                                        <input type="text" class="form-control"  name="designation" value="" placeholder="Enter Designation">
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
									<div class="row">
										<div class="col-md-3">
											<button type="button" data-request="ajax-submit" class="btn btn-primary">Submit</button>
										</div>
									</div>
								</form>
							</div>
							<!-- /.tab-pane -->
						</div>
						<!-- /.tab-content -->
					</div><!-- /.card-body -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->
</section>