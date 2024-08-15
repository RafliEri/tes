<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marketing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MarketingController extends Controller
{
    public function index(): View
    {
        $marketings = Marketing::all();
        $users = User::all();
        return view("marketing.index",compact('marketings','users'),["title" => "Marketing"]);
    }

    public function create()
    {
        return view('marketing.create');
    }

    public function store(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'preview_media' => 'required|file|mimes:jpeg,jpg,png,pdf.doc,docx,txt',
            'nama_file' => 'required|min:5',
        ]);

        // Menghasilkan ID baru
        $newId = marketing::max('id') + 1;

        $file = $request->file('preview_media');
        $file->storeAs('public/images', $file->hashName());


        DB::transaction(function () use ($request, $file, $newId) {
            Marketing::create([
                'id' => $newId,
                'preview_media' => $file->hashName(),
                'nama_file' => $request->input('nama_file'),
                'user_id' => auth()->user()->id,
            ]);
        });
        return redirect()->route('marketing.index')->with(['success' => 'Data berhasil Disimpan!']);
    }

    public function edit($id): View
    {
        $marketings = Marketing::find($id);
        $user = User::all();
        return view('marketing.edit', compact('marketings', 'user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'preview_media' => 'file|mimes:jpeg,jpg,png,pdf.doc,docx,txt',
            'nama_file' => 'required',
        ]);
        //get data dengan id
        $marketings = Marketing::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('preview_media')) {
            //upload gambar baru
            $file = $request->file('preview_media');
            $file->storeAs('public/images',$file->hashName());

            //delete gambar lama
            Storage::delete('public/images/'.$marketings->preview_media);

            //update data dengan gambar baru
            $marketings->update([
                'preview_media' => $file->hashName(),
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $marketings->update([
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        }
        //kembali ke index
        return redirect()->route('marketing.index')->with(['success' => ' Data Berhasil Diubah!']);

    }

    public function destroy($id): RedirectResponse
    {
        // Menghapus data
        $marketings = Marketing::findOrFail($id);
        $marketings->delete();

        // Memperbarui ID data lainnya
        $marketings = Marketing::orderBy('id')->get();
        $newId = 1;

        foreach ($marketings as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('marketing.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }
}
