<?php

namespace App\Http\Controllers;

use App\Models\Pasien; 
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Pasien::latest()->paginate(10); 
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required',
            'nomor_telepon' => 'required|numeric',
        ]);

        Pasien::create($request->all());

        // REVISI: Mengarah ke user.patients sesuai web.php
        return redirect()->route('user.patients')->with('success', 'Pasien berhasil ditambah!');
    }

    public function show($id)
    {
        $patient = Pasien::with('rekamMedis')->findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Pasien::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'required',
            'nomor_telepon' => 'required|numeric',
        ]);

        $patient = Pasien::findOrFail($id);
        $patient->update($request->all());

        // REVISI: Mengarah ke user.patients sesuai web.php
        return redirect()->route('user.patients')->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $patient = Pasien::findOrFail($id);
        $patient->delete();

        // REVISI: Mengarah ke user.patients sesuai web.php
        return redirect()->route('user.patients')->with('success', 'Pasien berhasil dihapus!');
    }
}