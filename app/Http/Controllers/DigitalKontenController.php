<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DigitalKonten;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class DigitalKontenController extends Controller
{
    public function index()
    {
        $digital_kontens = DigitalKonten::all();
        $users = User::all();
        return view("digitalkonten.index",compact('digital_kontens','users'),["title" => "Digital Konten"]);
    }

    public function create()
    {
        return view('digitalkonten.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'preview_media' => 'required|file|mimes:jpeg,jpg,png,pdf.doc,docx,txt',
            'nama_konten' => 'required|min:5',
        ]);

         // Menghasilkan ID baru
         $newId = DigitalKonten::max('id') + 1;

         $file = $request->file('preview_media');
         $file->storeAs('public/images', $file->hashName());

         DB::transaction(function () use ($request, $file, $newId) {
            DigitalKonten::create([
                'id' => $newId,
                'preview_media' => $file->hashName(),
                'nama_konten' => $request->input('nama_konten'),
                'user_id' => auth()->user()->id,
            ]);
        });
        return redirect()->route('digitalkonten.index')->with(['success' => 'Data berhasil Disimpan!']);
    }

    public function edit($id): View
    {
        $digital_kontens = DigitalKonten::find($id);
        $user = User::all();
        return view("digitalkonten.edit",compact('digital_kontens','user'));
    }

    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'preview_media' => 'image|mimes:jpeg,jpg,png',
            'nama_konten' => 'required',
        ]);
        //get data dengan id
        $digital_kontens = DigitalKonten::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('preview_media')) {
            //upload gambar baru
            $file = $request->file('preview_media');
            $file->storeAs('public/images',$file->hashName());

            //delete gambar lama
            Storage::delete('public/images/'.$digital_kontens->preview_media);

            //update data dengan gambar baru
            $digital_kontens->update([
                'preview_media' => $file->hashName(),
                'nama_konten' => $request->nama_konten,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $digital_kontens->update([
                'nama_konten' => $request->nama_konten,
                'user_id' => auth()->user()->id,
            ]);
        }
        //kembali ke index
        return redirect()->route('digitalkonten.index')->with(['success' => ' Data Berhasil Diubah!']);

    }

    public function destroy($id)
    {
        // Menghapus data
        $digital_kontens = DigitalKonten::findOrFail($id);
        $digital_kontens->delete();

        // Memperbarui ID data lainnya
        $digital_kontens = DigitalKonten::orderBy('id')->get();
        $newId = 1;

        foreach ($digital_kontens as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('digitalkonten.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }
}
