@extends('_pages._layout.back_end')
@section('konten')
<section class="content-header">
	<h1><b>Data Pengguna</b></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			@if(session()->get('akses') == 0)
			<div class="box box-success" id="box-form">
				<div class="box-body"></div>
				<div class="box-footer">
					<div class="pull-right">
						<button class="btn btn-danger" style="font-weight: bold; display: none;" id="btn-cancel">Batal</button>
						<button class="btn btn-success" style="font-weight: bold;" id="btn-submit">Simpan</button></div>
					</div>
				</div>
			@endif
			<div class="box box-primary">
				<div class="box-body">
					<table id="tabel_pengguna" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="text-align: center;">Nomor</th>
								<th style="text-align: center;" width="30%">Nama</th>
								<th style="text-align: center;">Email</th>
								<th style="text-align: center;">Akses</th>
								@if(session()->get('akses') == 0)
								<th style="text-align: center;"></th>
								@endif
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@push('script')
<script>
	$(function(){
		$("#tabel_pengguna").DataTable({
			responsive:!0,
			processing:!0,
			serverSide:!0,
			ajax:"{{ route('data.pengguna') }}",
			columns:[
				{data:'DT_RowIndex',name:'kode'},
				{data:'nama',name:'nama'},
				{data:'email',name:'email'},
				{data:'akses',name:'akses'},
				@if(session()->get('akses') == 0)
				{data:'action',name:'action',orderable:!1,className:'text-center'},
				@endif
			],
			paginationType:"full",
			lengthMenu:[[25,50,100],[25,50,100]],
		});
		createForm();
	});
	function createForm(){
		$.get('{{ route('pengguna.create') }}',function(res){
			$('#box-form .box-body').html(res);
		}).fail(function(xhr){
			console.log(xhr.responseJSON);
		});
		return!1;
	};
	function editForm(url){
		$.get(url,function(res){
			$('#box-form .box-body').html(res);
		}).fail(function(xhr){
			console.log(xhr.responseJSON);
		});
		document.getElementById('btn-cancel').style.display='inline-block';
		$('html, body').animate({scrollTop:$('html, body').offset().top},500);
		return!1;
	};
	function removeData(url){
		const csrf_token=$('meta[name="csrf-token"]').attr('content');
		swal({
			title:"Kamu Yakin ?",
			text:"Data yang dipilih akan dihapus !",
			icon:"warning",
			buttons:!0,
			dangerMode:!0,
		}).then((value)=>{
			if(value){
				$.post(url,{'_method':'DELETE','_token':csrf_token},function(res){
					$("#tabel_pengguna").DataTable().ajax.reload();
					createForm();
					document.getElementById('btn-cancel').style.display='none';
					swal("Good job !","","success");
				}).fail(function(xhr){
					console.log(xhr.responseJSON);
					swal("Opps !","","error");
				});
			}
		});
		return!1;
	};
	$('#box-form #btn-cancel').click(function(evt){
		evt.preventDefault();
		createForm();
		document.getElementById('btn-cancel').style.display='none';
	});
	$('#box-form #btn-submit').click(function(evt){
		evt.preventDefault();
		const object=$('.box-body form'),url=object.attr('action'),method=$('input[name=_method').val()==undefined?'POST':'PUT';
		object.find('.help-block').remove();
		object.find('.form-group').removeClass('has-error');
		$.ajax({
			url:url,
			type:method,
			data:object.serialize(),
			cache:false,
			success:function(res){
				object.trigger('reset');
				$("#tabel_pengguna").DataTable().ajax.reload();
				createForm();
				document.getElementById('btn-cancel').style.display='none';
				swal("Good job !","","success")
			},error:function(xhr){
				const msg=xhr.responseJSON;
				if($.isEmptyObject(msg)==!1){
					$.each(msg.errors,function(key,val){
						$('#'+key).closest('.form-group').addClass('has-error').append('<span class="help-block"><strong>'+val+'</strong></span>')
					})
				}
			}
		})
	})
</script>
@endpush