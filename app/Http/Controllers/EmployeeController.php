<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->get();
            // dd($request->search);
        } else {
            $data = Employee::all()->sortByDesc('id');
        }
        return view('datapegawai', compact('data'));
    }

    public function insertdata(Request $request)
    {
        // dd($request->all());
        $data = Employee::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect('/pegawai')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function tambahpegawai()
    {
        return view('tambahdata');
    }

    public function tampilkandata($id)
    {
        $data = Employee::find($id);
        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        // dd($request->all());
        $data->update($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect('/pegawai')->with('success', 'Data Berhasil Diupdate');
    }
    public function hapusdata($id)
    {
        Employee::destroy($id);

        return redirect('/pegawai')->with('success', 'Data Berhasil Dihapus');
    }
    public function exportpdf()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download();
    }
}
