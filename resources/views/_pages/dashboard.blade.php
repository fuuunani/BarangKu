@extends('_pages._layout.back_end')
@section('konten')
<section class="content-header">
	<h1><b>Dashboard</b></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>{{ $pengguna }}</h3>
					<p><b>Pengguna</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-users"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-red">
				<div class="inner">
					<h3>{{ $barang }}</h3>
					<p><b>Barang</b></p>
				</div>
				<div class="icon">
					<i class="fa fa-cubes"></i>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection