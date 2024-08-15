<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller{

public function index(): View

    {
        $mitras = Mitra::all();
        $users = Mitra::all();
        return view("mitra.index",compact('mitras','users'),["title" => "Mitra"]);
    }


    public function create()
    {
        return view('mitra.create');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'preview_media' => 'required|file|mimes:jpeg,jpg,png,pdf.doc,docx,txt',
            'nama_file' => 'required|min:5',
        ]);

        // Menghasilkan ID baru
        $newId = Mitra::max('id') + 1;

        $file = $request->file('preview_media');
        $file->storeAs('public/images', $file->hashName());


        DB::transaction(function () use ($request, $file, $newId) {
            Mitra::create([
                'id' => $newId,
                'preview_media' => $file->hashName(),
                'nama_file' => $request->input('nama_file'),
                'user_id' => auth()->user()->id,
            ]);
        });
        return redirect()->route('mitra.index')->with(['success' => 'Data berhasil Disimpan!']);
    }


    public function edit($id): View
    {
        $mitras = Mitra::find($id);
        $user = Mitra::all();
        return view('mitra.edit', compact('mitras', 'user'));
    }


    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'preview_media' => 'image|mimes:jpeg,jpg,png',
            'nama_file' => 'required',
        ]);
        //get data dengan id
        $mitras = Mitra::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('preview_media')) {
            //upload gambar baru
            $file = $request->file('preview_media');
            $file->storeAs('public/images',$file->hashName());

            //delete gambar lama
            Storage::delete('public/images/'.$mitras->preview_media);

            //update data dengan gambar baru
            $mitras->update([
                'preview_media' => $file->hashName(),
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $mitras->update([
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        }
        //kembali ke index
        return redirect()->route('mitra.index')->with(['success' => ' Data Berhasil Diubah!']);
    }


    public function destroy($id)
    {
        // Menghapus data
        $mitras = Mitra::findOrFail($id);
        $mitras->delete();

        // Memperbarui ID data lainnya
        $mitras = Mitra::orderBy('id')->get();
        $newId = 1;

        foreach ($mitras as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('mitra.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }
}
