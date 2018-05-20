<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
				 style="opacity: .8">
		<span class="brand-text font-weight-light">HRMS</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Alexander Pierce</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="pages/widgets.html" class="nav-link">
						<i class="nav-icon fa fa-th"></i>
						<p> Employee </p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-pie-chart"></i>
						<p> Employee <i class="right fa fa-angle-left"></i> </p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{url('admin/employee/create')}}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Add</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{url('admin/employee')}}" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>List</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="pages/charts/inline.html" class="nav-link">
								<i class="fa fa-circle-o nav-icon"></i>
								<p>Lead</p>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>