<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Fundraising;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FundraisingController extends Controller{

public function index(): View
    {
        $fundraisings = Fundraising::all();
        $users = Fundraising::all();
        return view("fundraising.index",compact('fundraisings','users'),["title" => "Fundraising"]);
    }


    public function create()
    {
        return view('fundraising.create');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'preview_media' => 'required|file|mimes:jpeg,jpg,png,pdf.doc,docx,txt',
            'nama_file' => 'required|min:5',
        ]);

        // Menghasilkan ID baru
        $newId = Fundraising::max('id') + 1;

        $file = $request->file('preview_media');
        $file->storeAs('public/images', $file->hashName());


        DB::transaction(function () use ($request, $file, $newId) {
            Fundraising::create([
                'id' => $newId,
                'preview_media' => $file->hashName(),
                'nama_file' => $request->input('nama_file'),
                'user_id' => auth()->user()->id,
            ]);
        });
        return redirect()->route('fundraising.index')->with(['success' => 'Data berhasil Disimpan!']);
    }


    public function edit($id): View
    {
        $fundraisings = Fundraising::find($id);
        $user = Fundraising::all();
        return view('fundraising.edit', compact('fundraisings', 'user'));
    }


    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'preview_media' => 'image|mimes:jpeg,jpg,png',
            'nama_file' => 'required',
        ]);
        //get data dengan id
        $fundraisings = Fundraising::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('preview_media')) {
            //upload gambar baru
            $file = $request->file('preview_media');
            $file->storeAs('public/images',$file->hashName());

            //delete gambar lama
            Storage::delete('public/images/'.$fundraisings->preview_media);

            //update data dengan gambar baru
            $fundraisings->update([
                'preview_media' => $file->hashName(),
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $fundraisings->update([
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        }
        //kembali ke index
        return redirect()->route('fundraising.index')->with(['success' => ' Data Berhasil Diubah!']);
    }


    public function destroy($id)
    {
        // Menghapus data
        $fundraisings = Fundraising::findOrFail($id);
        $fundraisings->delete();

        // Memperbarui ID data lainnya
        $fundraisings = Fundraising::orderBy('id')->get();
        $newId = 1;

        foreach ($fundraisings as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('fundraising.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }
}

