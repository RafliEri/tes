<?php

namespace App\Http\Controllers;

use App\Models\IT;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ItController extends Controller{
    public function index(): View
    {
        $users = User::all();
        $its = [];

        // Menggunakan chunk untuk memproses data IT dalam batch kecil
        IT::chunk(200, function ($itBatch) use (&$its) {
            foreach ($itBatch as $it) {
                $it->file_url = Storage::url('public/images/' . $it->preview_media);
                $its[] = $it;
            }
        });

        return view("it.index",compact('its','users'),["title" => "IT"]);
    }

    public function create()
    {
        return view('it.create');
    }

    public function store(Request $request): RedirectResponse
{
    $this->validate($request, [
        'preview_media' => 'required|file|mimes:jpeg,jpg,png,pdf,doc,docx,txt,xlsx,mp4,webm,ogg',
        'nama_file' => 'required',
    ]);

    // Get chunk file and parameters
    $chunkFile = $request->file('file'); // pastikan sesuai dengan input field name dari Resumable.js
    if (!$chunkFile) {
        return redirect()->route('it.create')->withErrors('File not received.');
    }

    $fileName = $request->query('resumableFilename');
    $chunkNumber = $request->query('resumableChunkNumber');
    $totalChunks = $request->query('resumableTotalChunks');
    $chunkDir = storage_path('app/public/images/temp');

    if (!is_dir($chunkDir)) {
        mkdir($chunkDir, 0777, true);
    }

    // Save chunk temporarily
    $chunkFile->move($chunkDir, $fileName . '.part' . $chunkNumber);

    // Combine chunks if all have been uploaded
    $uploadedChunks = glob($chunkDir . '/' . $fileName . '.part*');
    if (count($uploadedChunks) == $totalChunks) {
        $finalPath = storage_path('app/public/images/' . $fileName);
        $destination = fopen($finalPath, 'ab');

        foreach ($uploadedChunks as $chunk) {
            $chunkContent = fopen($chunk, 'rb');
            stream_copy_to_stream($chunkContent, $destination);
            fclose($chunkContent);
            unlink($chunk); // Delete chunk after merging
        }

        fclose($destination);

        // Create IT record
        IT::create([
            'preview_media' => $fileName,
            'nama_file' => $request->input('nama_file'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('it.index')->with(['success' => 'Data berhasil Disimpan!']);
    }

    return redirect()->route('it.create')->withErrors('File not fully uploaded.');
}

    private function combineChunks($chunkDir, $finalPath, $totalChunks)
    {
        $destination = fopen($finalPath, 'ab');

        for ($i = 0; $i < $totalChunks; $i++) {
            $chunkPath = $chunkDir . '/file.part' . $i;
            $chunk = fopen($chunkPath, 'rb');
            stream_copy_to_stream($chunk, $destination);
            fclose($chunk);
            unlink($chunkPath); // Delete chunk after merging
        }

        fclose($destination);
    }

    public function edit($id): View
    {
        $its = IT::find($id);
        $user = User::all();
        return view('IT.edit', compact('its', 'user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'preview_media' => 'file|mimes:jpeg,jpg,png,pdf,doc,docx,txt,mp4,webm,ogg',
            'nama_file' => 'required',
        ]);
        //get data dengan id
        $its = IT::findOrFail($id);

        //check gambar yang di upload
        if($request->hasFile('preview_media')) {
            $file = $request->file('preview_media');
        $originalFileName = $file->getClientOriginalName();

        // Simpan file dengan nama asli
        $file->storeAs('public/images', $originalFileName);

        // Hapus file lama
        Storage::delete('public/images/'.$its->preview_media);

            //update data dengan gambar baru
            $its->update([
                'preview_media' => $originalFileName,
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $its->update([
                'nama_file' => $request->nama_file,
                'user_id' => auth()->user()->id,
            ]);
        }
        //kembali ke index
        return redirect()->route('it.index')->with(['success' => ' Data Berhasil Diubah!']);

    }

    public function destroy($id): RedirectResponse
    {
        // Menghapus data
        $its = IT::findOrFail($id);
        $its->delete();

        // Memperbarui ID data lainnya dalam batch
        IT::chunk(200, function ($itBatch) {
            $newId = 1;
            foreach ($itBatch as $item) {
                $item->id = $newId;
                $item->save();
                $newId++;
            }
        });

        return redirect()->route('it.index')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }
}
