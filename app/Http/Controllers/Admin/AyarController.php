<?php

namespace App\Http\Controllers\Admin;

use App\Ayar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AyarController extends Controller
{
    //
    public function index(){
        $ayarlar = Ayar::all();

        return view('admin.site_ayarlari', compact('ayarlar'));
    }

    public function guncelle(Request $request){
        $this->validate($request, [
            'baslik' => 'required',
            'author' => 'required',
            'aciklama' => 'required',
            'keywords' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'github' => 'required'
        ]);

        Ayar::where('name', 'baslik')->update(['value' => $request->baslik]);
        Ayar::where('name', 'author')->update(['value' => $request->author]);
        Ayar::where('name', 'aciklama')->update(['value' => $request->aciklama]);
        Ayar::where('name', 'keywords')->update(['value' => $request->keywords]);
        Ayar::where('name', 'facebook')->update(['value' => $request->facebook]);
        Ayar::where('name', 'twitter')->update(['value' => $request->twitter]);
        Ayar::where('name', 'github')->update(['value' => $request->github]);

        Session::flash('status',1);

        return redirect()->back();
    }
}
