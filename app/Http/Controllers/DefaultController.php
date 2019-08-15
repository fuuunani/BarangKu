<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DefaultController extends Controller
{
    public function index()
    {
        if (session()->has('usaha')) {
            return redirect('dashboard');
        }
    	return view('_pages.login');
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|size:7',
    	]);
    	$login = \DB::select("SELECT `kode`, `usaha`, `nama`, `akses` FROM `tb_pengguna` WHERE `email`='" . $request->email . "' AND `password`='" . $request->password . "';");
        if (count($login) > 0) {
            session()->put('kode', $login[0]->kode);
            session()->put('usaha', $login[0]->usaha);
            session()->put('nama', $login[0]->nama);
            session()->put('akses', $login[0]->akses);
            session()->save();
        }
        return $login;
    }

    public function register()
    {
        return view('_pages.daftar');
    }

    public function registerPost(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:tb_pengguna,email,'.session()->get('kode').',kode',
            'password' => 'required|size:7',
            'nama_usaha' => 'required|unique:tb_usaha,nama,'.session()->get('usaha').',kode',
        ]);
        $sum_date=(date('Y')+date('m'))+date('d');
        $kode_usaha="U".$sum_date.strtoupper(Str::random(5));
        $usaha=\DB::table('tb_usaha')->insert(['kode'=>$kode_usaha,'nama'=>$request->nama_usaha]);
        if ($usaha >= 0) {
            $pengguna=\DB::table('tb_pengguna')->insert(['usaha'=>$kode_usaha,'nama'=>$request->nama,'email'=>$request->email,'password'=>$request->password]);
            return "1";
        } else {
            return "0";
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('login');
    }

    public function profile($request)
    {
        $kode = base64_decode(urldecode($request));
        $data = \DB::select("SELECT a.`nama`, a.`email`, a.`password`, b.`nama` AS `nama_usaha`, b.`alamat` AS `alamat_usaha`, b.`alamat` AS `alamat_usaha`, b.`email` AS `email_usaha`, b.`telp` AS `telp_usaha` FROM `tb_pengguna` a INNER JOIN `tb_usaha` b ON b.`kode`=a.`usaha` WHERE a.`kode`='" . $kode . "';");
        if (count($data) <= 0) {
            return redirect('dashboard');
        }
        return view('_pages.profile', compact('data'));
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request,['nama'=>'required','email'=>'required|email|unique:tb_pengguna,email,'.session()->get('kode').',kode','password'=>'required|size:7','nama_usaha'=>'required','alamat_usaha'=>'required','email_usaha'=>'required|email|unique:tb_usaha,email,'.session()->get('usaha').',kode','telp_usaha'=>'required']);
        $pengguna = \DB::table('tb_pengguna')->where('kode', session()->get('kode'))->update(['nama' => $request->nama, 'email' => $request->email, 'password' => $request->password]);
        session()->put('kode', session()->get('kode'));
        session()->put('usaha', session()->get('usaha'));
        session()->put('nama', $request->nama);
        session()->put('akses', session()->get('akses'));
        session()->save();
        if ($pengguna >= 0) {
            $usaha = \DB::table('tb_usaha')->where('kode', session()->get('usaha'))->update(['nama' => $request->nama_usaha, 'alamat' => $request->alamat_usaha, 'email' => $request->email_usaha, 'telp' => $request->telp_usaha]);
            return redirect('dashboard');
        } else {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        if (!session()->has('usaha')) {
            return redirect('login');
        }
        $pengguna = \DB::table('tb_pengguna')->where('usaha', session()->get('usaha'))->count();
        $barang = \DB::table('tb_barang')->where('usaha', session()->get('usaha'))->count();
        return view('_pages.dashboard', compact('pengguna', 'barang'));
    }
}
