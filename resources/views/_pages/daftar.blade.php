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
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href=""><b>BarangKu</b></a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Masukkan data dengan benar !</p>
			<form action="{{ route('register.post') }}" method="POST">
				@csrf
				<div class="form-group has-feedback">
					<input name="nama" id="nama" type="text" class="form-control" placeholder="Nama">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input name="email" id="email" type="email" class="form-control" placeholder="Email">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input name="password" id="password" type="text" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<hr>
				<div class="form-group has-feedback">
					<input name="nama_usaha" id="nama_usaha" type="text" class="form-control" placeholder="Nama Usaha">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="button" class="btn btn-warning btn-register btn-block btn-flat">Register</button>
					</div>
				</div>
			</form>
			<div class="social-auth-links text-center">
				<p>- OR -</p>
				<a href="{{ url('login') }}" class="btn btn-primary btn-block btn-flat">Sign In</a>
			</div>
		</div>
	</div>
	<script>
		$('.btn-register').click(function(evt) {
			evt.preventDefault();
			const object=$('.login-box-body form'), url=object.attr('action');
			object.find('.help-block').remove();
			object.find('.form-group').removeClass('has-error');
			$.post(url, object.serialize(), function(res) {
				if (res > 0) {
					window.location = "{{ url('login') }}";
				} else {
					swal("Opps !", "", "error");
				}
			}).fail(function(xhr) {
				const msg=xhr.responseJSON;
				if($.isEmptyObject(msg)==!1){
					$.each(msg.errors,function(key,val){
						$('#'+key).closest('.form-group').addClass('has-error').append('<span class="help-block"><strong>'+val+'</strong></span>');
					})
				}
			});
		});
	</script>
</body>
</html>
