<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // Menampilkan daftar mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required|unique:mahasiswa,nim',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswa,email',
        ]);
    
        mahasiswa::create($request->all()); // Menyimpan data mahasiswa
    
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan!');
    }
    // Menampilkan form edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data mahasiswa
    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }
}