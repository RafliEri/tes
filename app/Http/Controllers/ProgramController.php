<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index(): View
    {
        $program = Program::all();
        $users = User::all();
        return view("Program.index",compact('program','users'),["title" => "Program"]);
    }

    public function create()
    {
        return view('Program.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'preview_media' => 'required|file|mimes:jpeg,jpg,png,pdf.doc,docx,txt',
            'nama_file' => 'required|min:5',
        ]);

        // Menghasilkan ID baru
        $newId = Program::max('id') + 1;

        $file = $request->file('preview_media');
        $file->storeAs('public/images', $file->hashName());


        DB::transaction(function () use ($request, $file, $newId) {
            Program::create([
                'id' => $newId,
                'preview_media' => $file->hashName(),
                'nama_file' => $request->input('nama_file'),
                'user_id' => auth()->user()->id,
            ]);
        });
        return redirect()->route('program.index')->with(['success' => 'Data berhasil Disimpan!']);
    }

    public function edit($id): View
    {
        $program = Program::find($id);
        $user = User::all();
        return view('Program.edit', compact('program', 'user'));
    }

    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'preview_media' => 'image|mimes:jpeg,jpg,png',
            'nama_file' => 'required',
        ]);
        //get data dengan id
        $program = Program::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('preview_media')) {
            //upload gambar baru
            $file = $request->file('preview_media');
            $file->storeAs('public/images',$file->hashName());

            //delete gambar lama
            Storage::delete('public/images/'.$program->preview_media);

            //update data dengan gambar baru
            $program->update([
                'preview_media' => $file->hashName(),
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $program->update([
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        }
        //kembali ke index
        return redirect()->route('program.index')->with(['success' => ' Data Berhasil Diubah!']);
    }

    public function destroy($id)
    {
        // Menghapus data
        $program = Program::findOrFail($id);
        $program->delete();

        // Memperbarui ID data lainnya
        $program = Program::orderBy('id')->get();
        $newId = 1;

        foreach ($program as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('program.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }
}
