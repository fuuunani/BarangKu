@extends('_pages._layout.back_end')
@section('konten')
<section class="content-header">
	<h1><b>Profile</b></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-widget widget-user-2">
				<div class="widget-user-header bg-purple">
					<div class="widget-user-image">
						<img class="img-circle" src="{{ asset('_assets/dist/img/user.png') }}" alt="User Avatar">
					</div>
					<h3 class="widget-user-username"><b>{{ session()->get('nama') }}</b></h3>
					<h5 class="widget-user-desc"><b>Owner</b></h5>
				</div>
				<div class="box-body">
					<form action="{{ url('post/profile') }}" method="POST">
						@csrf
						<div class="form-group">
							<label for="nama">Nama Pengguna</label>
							<input type="text" value="{{ $data[0]->nama }}" class="form-control" name="nama" id="nama" required="required">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" value="{{ $data[0]->email }}" class="form-control" name="email" id="email" required="required">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="text" value="{{ $data[0]->password }}" class="form-control" name="password" id="password" required="required">
						</div>
						<hr>
						<div class="form-group">
							<label for="nama_usaha">Nama Usaha</label>
							<input type="text" value="{{ $data[0]->nama_usaha }}" class="form-control" name="nama_usaha" id="nama_usaha" required="required">
						</div>
						<div class="form-group">
							<label for="alamat_usaha">Alamat Usaha</label>
							<textarea class="form-control" name="alamat_usaha" id="alamat_usaha" required="required">{{ $data[0]->alamat_usaha }}</textarea>
						</div>
						<div class="form-group">
							<label for="email_usaha">Email Usaha</label>
							<input type="email" value="{{ $data[0]->email_usaha }}" class="form-control" name="email_usaha" id="email_usaha" required="required">
						</div>
						<div class="form-group">
							<label for="telp_usaha">Telp Usaha</label>
							<input type="text" value="{{ $data[0]->telp_usaha }}" class="form-control" name="telp_usaha" id="telp_usaha" onkeypress="angka(event)" required="required">
						</div>
						<input type="submit" class="btn btn-primary pull-right" value="Simpan" style="font-weight: 600;">
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@push('script')
<script>
	function angka(evt){var input=evt||window.event;if(input.type==='paste'){key=event.clipboardData.getData('text/plain')}else{var key=input.keyCode||input.which;key=String.fromCharCode(key)}var regex=/[0-9]|\./;if(!regex.test(key)){input.returnValue=!1;if(input.preventDefault)input.preventDefault()}};
</script>
@endpush