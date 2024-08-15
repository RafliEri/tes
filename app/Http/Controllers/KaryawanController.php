<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index(): View
    {
        $karyawan = Karyawan::all();
        return view('karyawan.index', compact('karyawan'),["title" => "Karyawan"]);
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:karyawans|email',
            'no_telp' => 'required|unique:karyawans|no_telp',
            'jabatan' => 'required',
            'foto' => 'required|file|mimes:jpeg,jpg,png',
        ]);
        // Menghasilkan ID baru
        $newId = Karyawan::max('id') + 1;

        $file = $request->file('foto');
        $file->storeAs('public/images', $file->hashName());

        DB::transaction(function () use ($request, $newId, $file) {
            Karyawan::create([
                'id' => $newId,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'jabatan' =>$request->jabatan ,
                'foto' => $file->hashName(),
            ]);
        });
        return redirect()->route('karyawan.index')->with(['success' => 'Data berhasil Disimpan!']);
    }

    public function edit($id): View
    {
        $karyawan = Karyawan::find($id);
        return view('karyawan.edit', compact('karyawan'));
    }

public function update(Request $request, $id): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $id,
            'no_telp' => 'required|unique:karyawans,no_telp,' . $id,
            'jabatan' => 'required',
            'foto' => 'file|mimes:jpeg,jpg,png',
        ]);
        //get data dengan id
        $karyawan = Karyawan::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('foto')) {
            //upload gambar baru
            $file = $request->file('foto');
            $file->storeAs('public/images',$file->hashName());

            //delete gambar lama
            Storage::delete('public/images/'.$karyawan->foto);

            //update data dengan gambar baru
            $karyawan->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'foto' => $file->hashName(),
                'jabatan' => $request->jabatan,
            ]);
        } else {
            $karyawan->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'jabatan' => $request->jabatan,
            ]);
        }
        //kembali ke index
        return redirect()->route('karyawan.index')->with(['success' => ' Data Berhasil Diubah!']);

    }

    public function destroy($id): RedirectResponse
    {
        // Menghapus data
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        // Memperbarui ID data lainnya
        $karyawan = Karyawan::orderBy('id')->get();
        $newId = 1;

        foreach ($karyawan as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('karyawan.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }

}
