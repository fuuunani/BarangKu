<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index()
    {
        if (!session()->has('usaha')) {
            return redirect('login');
        }
        return view('_pages._barang.index');
    }

    public function create()
    {
        $barang = new Barang();
        return view('_pages._barang._partials._form',compact('barang'));
    }

    public function store(Request $request)
    {
        $this->validate($request,['nama'=>'required','stok'=>'required','harga_jual'=>'required','harga_beli'=>'required']);$sum_date=(date('Y')+date('m'))+date('d');$kode="B".$sum_date.strtoupper(Str::random(5));$store=Barang::create(['kode'=>$kode,'usaha'=>session()->get('usaha'),'nama'=>$request->nama,'stok'=>$request->stok,'harga_jual'=>$request->harga_jual,'harga_beli'=>$request->harga_beli,]);return $store;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    public function edit(Barang $barang)
    {
        return view('_pages._barang._partials._form',compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $this->validate($request,['nama'=>'required','stok'=>'required','harga_jual'=>'required','harga_beli'=>'required',]);$barang->nama=$request->nama;$barang->stok=$request->stok;$barang->harga_jual=$request->harga_jual;$barang->harga_beli=$request->harga_beli;$barang->update();return $barang;
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();return $barang;
    }

    public function data()
    {
        if (session()->get('akses') == 0) {
            $params = ['kode','nama','stok','harga_jual','harga_beli'];
        } elseif (session()->get('akses') == 1) {
            $params = ['kode','nama','stok','harga_jual', 'action'];
        } else {
            $params = ['kode','nama','stok'];
        }
        $barang=Barang::select(['kode','nama','stok','harga_jual','harga_beli'])->where('usaha',session()->get('usaha'))->orderBy('nama','ASC');return DataTables::of($barang)->editColumn('harga_jual',function($data){return number_format($data->harga_jual,2);})->editColumn('harga_beli',function($data){return number_format($data->harga_beli,2);})->addColumn('action',function($barang){return view('_pages._barang._partials._action',['model'=>$barang,'url_edit'=>route('barang.edit',$barang->kode),'url_destroy'=>route('barang.destroy',$barang->kode),]);})->only($params)->rawColumns(['action'])->make(true);
    }
}