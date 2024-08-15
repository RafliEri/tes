<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FinanceController extends Controller{


    public function index(): View
    {
        $finances = Finance::all();
        $users = Finance::all();
        return view("finance.index",compact('finances','users'),["title" => "Finance"]);
    }


    public function create()
    {
        return view('finance.create');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
            'preview_media' => 'required|file|mimes:jpeg,jpg,png,pdf.doc,docx,txt',
            'nama_file' => 'required|min:5',
        ]);

        // Menghasilkan ID baru
        $newId = Finance::max('id') + 1;

        $file = $request->file('preview_media');
        $file->storeAs('public/images', $file->hashName());


        DB::transaction(function () use ($request, $file, $newId) {
            Finance::create([
                'id' => $newId,
                'preview_media' => $file->hashName(),
                'nama_file' => $request->input('nama_file'),
                'user_id' => auth()->user()->id,
            ]);
        });
        return redirect()->route('finance.index')->with(['success' => 'Data berhasil Disimpan!']);
    }


    public function edit($id): View
    {
        $finances = Finance::find($id);
        $user = Finance::all();
        return view('finance.edit', compact('finances', 'user'));
    }


    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'preview_media' => 'image|mimes:jpeg,jpg,png',
            'nama_file' => 'required',
        ]);
        //get data dengan id
        $finances = Finance::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('preview_media')) {
            //upload gambar baru
            $file = $request->file('preview_media');
            $file->storeAs('public/images',$file->hashName());

            //delete gambar lama
            Storage::delete('public/images/'.$finances->preview_media);

            //update data dengan gambar baru
            $finances->update([
                'preview_media' => $file->hashName(),
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $finances->update([
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        }
        //kembali ke index
        return redirect()->route('finance.index')->with(['success' => ' Data Berhasil Diubah!']);
    }


    public function destroy($id)
    {
        // Menghapus data
        $finances = Finance::findOrFail($id);
        $finances->delete();

        // Memperbarui ID data lainnya
        $finances = Finance::orderBy('id')->get();
        $newId = 1;

        foreach ($finances as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('finance.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }
}
