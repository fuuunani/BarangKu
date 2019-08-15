{!! Form::model($pengguna,['route'=>$pengguna->exists ? ['pengguna.update',$pengguna->kode]:'pengguna.store','method'=>$pengguna->exists ? 'PUT':'POST','class'=>'row']) !!}
<div class="form-group col-xs-6">
	<label for="nama">Nama Pengguna</label>
	{!! Form::text('nama',null,['class'=>'form-control','id'=>'nama']) !!}
</div>
<div class="form-group col-xs-6">
	<label for="email">Email</label>
	{!! Form::email('email',null,['class'=>'form-control','id'=>'email']) !!}
</div>
<div class="form-group col-xs-6">
	<label for="password">Password</label>
	{!! Form::text('password',null,['class'=>'form-control','id'=>'password']) !!}
</div>
<div class="form-group col-xs-6">
	<label for="akses">Akses</label>
	{!! Form::select('akses', array('1' => 'Admin', '2' => 'Staff'), $pengguna->exists ? $pengguna->akses : '1', ['class'=>'form-control','id'=>'akses']) !!}
</div>
{!! Form::close() !!}