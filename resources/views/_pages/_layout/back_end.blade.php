<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BarangKu</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('_assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('_assets/plugins/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('_assets/plugins/datatables/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('_assets/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('_assets/dist/css/skins/skin-purple.min.css') }}">
	<!-- JS -->
	<script src="{{ asset('_assets/plugins/jQuery/jquery-3.3.1.min.js') }}"></script>
	<script src="{{ asset('_assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('_assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('_assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('_assets/dist/js/app.min.js') }}"></script>
	<script src="{{ asset('_assets/plugins/SweetAlert/sweetalert.min.js') }}"></script>
</head>
<body class="hold-transition skin-purple fixed sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<a href="" class="logo">
				<span class="logo-mini"><b><i class="fa fa-globe"></i></b></span>
				<span class="logo-lg"><b>BarangKu</b></span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="{{ asset('_assets/dist/img/user.png') }}" class="user-image" alt="User Image">
								<span class="hidden-xs" style="font-weight: 600;">{{ session()->get('nama') }}</span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="{{ asset('_assets/dist/img/user.png') }}" class="img-circle" alt="User Image">
									<p><b>{{ session()->get('nama') }}</b></p>
									<p><b>- {{ session()->get('akses') == 0 ? 'Owner' : '' }}{{ session()->get('akses') == 1 ? 'Admin' : '' }}{{ session()->get('akses') == 2 ? 'Staff' : '' }} -</b></p>
								</li>
								<li class="user-footer">
									@if(session()->get('akses') == 0)
									<div class="pull-left">
										<a href="{{ url('profile/' . urlencode(base64_encode(session()->get('kode')))) }}" class="btn btn-default btn-flat"><b>Profile</b></a>
									</div>
									@endif
									<div class="pull-right">
										<a href="{{ url('logout') }}" class="btn btn-default btn-flat"><b>Sign  Out</b></a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{{ asset('_assets/dist/img/user.png') }}" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><b>{{ session()->get('nama') }}</b></p>
						<a href=""><b><i class="fa fa-circle text-success"></i> Online</b></a>
					</div>
				</div>
				<ul class="sidebar-menu">
					<li class="header">MENU UTAMA</li>
					<li class="{{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
						<a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
					</li>
					<li class="treeview {{ Request::segment(1) === 'barang' || Request::segment(1) === 'pengguna' ? 'active' : null }}">
						<a href="#">
							<i class="fa fa-table"></i> <span>Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class="{{ Request::segment(1) === 'pengguna' ? 'active' : null }}"><a href="{{ url('pengguna') }}"><i class="fa fa-circle-o text-danger"></i> Data Pengguna</a></li>
							<li class="{{ Request::segment(1) === 'barang' ? 'active' : null }}"><a href="{{ url('barang') }}"><i class="fa fa-circle-o text-aqua"></i> Data Barang</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</aside>
		<div class="content-wrapper">
			@yield('konten')
		</div>
	</div>
	@stack('script')
</body>
</html>
