$(function () {
	$("#tabel_barang").DataTable({
		responsive: true,
		processing: true,
		serverSide: true,
		ajax: "{{ route('data.barang') }}",
		columns: [
			{data: 'kode', name: 'kode'},
			{data: 'nama', name: 'nama'},
			{data: 'stok', name: 'stok', className: 'text-right'},
			{data: 'harga_jual', name: 'harga_jual', className: 'text-right'},
			{data: 'harga_beli', name: 'harga_beli', className: 'text-right'},
			{data: 'action', name: 'action', orderable: false, className: 'text-center'},
		],
	});
	createForm();
});
function createForm() {
	$.get('{{ route('barang.create') }}', function(res) {
		$('#box-form .box-body').html(res);
	}).fail(function(xhr) {
		console.log(xhr.responseJSON);
	});
	return false;
}
function editForm(url) {
	$.get(url, function(res) {
		$('#box-form .box-body').html(res);
	}).fail(function(xhr) {
		console.log(xhr.responseJSON);
	});
	document.getElementById('btn-cancel').style.display = 'inline-block';
	$('html, body').animate({scrollTop: $('html, body').offset().top}, 500);
	return false;
}
function removeData(url) {
	const csrf_token = $('meta[name="csrf-token"]').attr('content');
	swal({
		title: "Kamu Yakin ?",
		text: "Data yang dipilih akan dihapus !",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((value) => {
		if (value) {
			$.post(url, {'_method': 'DELETE', '_token': csrf_token}, function(res) {
				$("#tabel_barang").DataTable().ajax.reload();
				createForm();
				document.getElementById('btn-cancel').style.display = 'none';
				swal("Good job !", "", "success");
			}).fail(function(xhr) {
				console.log(xhr.responseJSON);
				swal("Opps !", "", "error");
			});
		}
	});
	return false;
};
function angka (evt) {
	var input = evt || window.event;
  	if (input.type === 'paste') {
    	key = event.clipboardData.getData('text/plain');
  	} else {
    	var key = input.keyCode || input.which;
    	key = String.fromCharCode(key);
  	}
  	var regex = /[0-9]|\./;
  	if( !regex.test(key) ) {
    	input.returnValue = false;
    	if(input.preventDefault) input.preventDefault();
  	}
};
$('#box-form #btn-cancel').click(function(evt) {
	evt.preventDefault();
	createForm();
	document.getElementById('btn-cancel').style.display = 'none';
});
$('#box-form #btn-submit').click(function(evt) {
	evt.preventDefault();
	const object = $('.box-body form'), url = object.attr('action'), method = $('input[name=_method').val() == undefined ? 'POST' : 'PUT';
	object.find('.help-block').remove();
	object.find('.form-group').removeClass('has-error');
	$.ajax({
		url: url,
		type: method,
		data: object.serialize(),
		success: function(res) {
			object.trigger('reset');
			$("#tabel_barang").DataTable().ajax.reload();
			createForm();
			document.getElementById('btn-cancel').style.display = 'none';
			swal("Good job !", "", "success");
		},
		error: function(xhr) {
			const msg = xhr.responseJSON;
			if ($.isEmptyObject(msg) == false) {
				$.each(msg.errors, function(key, val) {
					$('#' + key).closest('.form-group').addClass('has-error').append('<span class="help-block"><strong>' + val + '</strong></span>');
				});
			}
		}
	});
});