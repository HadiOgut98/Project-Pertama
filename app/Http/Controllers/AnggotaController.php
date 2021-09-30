<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use PDF;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = Anggota::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(5);
        }else{
            $data = Anggota::paginate(5);
        }
        return view('anggota',compact('data'));
    }

    public function tambah_data()
    {
        return view('tambah_data');
    }
    
    public function insert_data(Request $request)
    {
        // dd($request->all());
        $data = Anggota::create($request->all());
        if($request->hasFile('foto'))
        {
            $request->file('foto')->move('foto_anggota/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('anggota')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampil_data($id)
    {
        $data = Anggota::find($id);
        return view('tampil_data', compact('data'));
    }

    public function update_data(Request $request, $id){
        $data = Anggota::find($id);
        $data->update($request->all());
        return redirect()->route('anggota')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $data = Anggota::find($id);
        $data->delete();
        return redirect()->route('anggota')->with('success', 'Data Berhasil Dihapus');
    }

    public function export_pdf()
    {
        $data = Anggota::all();

        view()->share('data', $data);
        $pdf = PDF::loadview('dataanggota-pdf');
        return $pdf->download('data-anggota.pdf');
    }
}
