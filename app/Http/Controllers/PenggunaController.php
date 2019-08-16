<?php

namespace App\Http\Controllers;

use App\Pengguna;
use Illuminate\Http\Request;
use DataTables;

class PenggunaController extends Controller
{
    public function index()
    {
        if (!session()->has('usaha')) {
            return redirect('login');
        }
        return view('_pages._pengguna.index');
    }

    public function create()
    {
        $pengguna = new Pengguna();
        return view('_pages._pengguna._partials._form',compact('pengguna'));
    }

    public function store(Request $request)
    {
        $this->validate($request,['nama'=>'required','email'=>'required|email|unique:tb_pengguna,email','password'=>'required|min:7']);$store=Pengguna::create(['usaha'=>session()->get('usaha'),'nama'=>$request->nama,'email'=>$request->email,'password'=>$request->password,'akses'=>$request->akses,]);return $store;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengguna  $pengguna
     * @return \Illuminate\Http\Response
     */
    public function show(Pengguna $pengguna)
    {
        //
    }

    public function edit(Pengguna $pengguna)
    {
        return view('_pages._pengguna._partials._form',compact('pengguna'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $this->validate($request,['nama'=>'required','email'=>'required|email|unique:tb_pengguna,email,'.$pengguna->kode.',kode','password'=>'required|min:7']);$pengguna->nama=$request->nama;$pengguna->email=$request->email;$pengguna->password=$request->password;$pengguna->akses=$request->akses;$pengguna->update();return $pengguna;
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();return $pengguna;
    }

    public function data()
    {
        if (session()->get('akses') == 0) {
            $params = ['kode','nama','email','akses','action'];
        } else {
            $params = ['kode','nama','email','akses'];
        }
        $pengguna=Pengguna::select(['kode','nama','email','akses'])->where('usaha', session()->get('usaha'));return DataTables::of($pengguna)->editColumn('akses',function($data){
            if ($data->akses == 0) {
                $level = "Owner";
            } elseif ($data->akses == 1) {
                $level = "Admin";
            } else {
                $level = "Staff";
            }
            return $level;
        })->addColumn('action',function($pengguna){
            if ($pengguna->akses == 0) {
                return "";
            } else {
                return view('_pages._pengguna._partials._action',['model'=>$pengguna,'url_edit'=>route('pengguna.edit',$pengguna->kode),'url_destroy'=>route('pengguna.destroy',$pengguna->kode),]);
            }
        })->only($params)->rawColumns(['action'])->addIndexColumn()->make(true);
    }
}
