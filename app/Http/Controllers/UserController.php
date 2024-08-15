<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(): View
    {
        $user = User::all();
        return view('user.index', compact('user'),["title" => "User"]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'role' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);
        // Menghasilkan ID baru
        $newId = User::max('id') + 1;

        DB::transaction(function () use ($request, $newId) {
            User::create([
                'id' => $newId,
                'role' => $request->role,
                'username' => $request->username,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
            ]);
        });
        return redirect()->route('user.index')->with(['success' => 'Data berhasil Disimpan!']);
    }
    public function edit($id): View
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }
    public function update(Request $request, User $user): RedirectResponse
    {
        //validasi form
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'role' => 'required',
            'email' => 'required|unique:users,email,' . $user->id . '|email',
            'password' => 'nullable|min:6',
        ]);

         //update data baru
         $user->update([
            'username' => $request->username,
            'role' => $request->role,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);


    //kembali ke index
    return redirect()->route('user.index')->with(['success' => ' Data Berhasil Diubah!']);

    }

    public function destroy($id)
    {
        // Menghapus data
        $user = User::findOrFail($id);
        $user->delete();

        // Memperbarui ID data lainnya
        $user = User::orderBy('id')->get();
        $newId = 1;

        foreach ($user as $item) {
            $item->id = $newId;
            $item->save();
            $newId++;
        }

        return redirect()->route('logout')->with(['success' => 'Data berhasil dihapus dan ID diperbarui!']);
    }

}
