<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manajemen User Dashboard';
        $dataPegawai = \App\Models\Pegawai::all();
        return view('index', compact('title', 'dataPegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePegawaiRequest $request)
    {
        // Handle File Photo
        $filePath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/photos', $fileName);
        }

        // Handle File Documents
        $documentPath = null;
        if ($request->hasFile('documents')) {
            $document = $request->file('documents');
            $documentName = time() . '_' . $document->getClientOriginalName();
            $documentPath = $document->storeAs('documents', $documentName, 'public');
        }

        $pegawai = new \App\Models\Pegawai();
        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        $pegawai->roles = $request->roles;
        $pegawai->start_date = $request->start_date;
        $pegawai->photo = $filePath;
        $pegawai->documents = $documentPath;

        if ($pegawai->save()) {
            return response()->json(['success' => 'Data pegawai berhasil ditambahkan.']);
        }

        return response()->json(['error' => 'Gagal menambahkan data pegawai.'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = \App\Models\Pegawai::find($id);

        if ($pegawai) {
            // Hapus file foto jika ada
            if ($pegawai->photo && Storage::exists($pegawai->photo)) {
                Storage::delete($pegawai->photo);
            }

            // Hapus data pegawai
            if ($pegawai->delete()) {
                return response()->json(['success' => 'Data pegawai berhasil dihapus.']);
            }
        }


        return response()->json(['error' => 'Gagal menghapus data pegawai.'], 500);
    }
}
