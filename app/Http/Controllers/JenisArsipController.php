<?php

namespace App\Http\Controllers;

use App\Models\JenisArsip;
use Illuminate\Http\Request;
use App\Models\Arsip;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class JenisArsipController extends Controller
{
    /*
    * JENIS SURAT
    */
    //view jenis surat
    public function viewJenis()
    {
        $dataJenis = JenisArsip::all();
        return view("kategori.view-jenis", ['data' => $dataJenis]);
    }

    //tambah jenis surat
    public function inputJenis()
    {
        return view("kategori.input-jenis");
    }
    public function saveJenis(Request $x)
    {
        //Validasi
        $messages = [
            'kategori.required' => 'Kode Jenis Surat tidak boleh kosong!',
            'keterangan.required' => 'Keterangan tidak boleh kosong!',
        ];
        $cekValidasi = $x->validate([
            'kategori' => 'required',
            'keterangan' => 'required',
        ], $messages);

        JenisArsip::create([
            'kategori' => $x->kategori,
            'keterangan' => $x->keterangan,
        ], $cekValidasi);
        return redirect('/view-jenis')->with('toast_success', 'Data berhasil tambah!');
    }

    //edit jenis surat
    public function editJenis($idJenis)
    {
        $dataJenis = JenisArsip::find($idJenis);
        return view("kategori.edit-jenis", ['data' => $dataJenis]);
    }
    public function updateJenis($idJenis, Request $x)
    {
        //Validasi
        $messages = [
            'kategori.required' => 'Kode Jenis Surat tidak boleh kosong!',
            'keterangan.required' => 'Keterangan tidak boleh kosong!',
        ];
        $cekValidasi = $x->validate([
            'kategori' => 'required',
            'keterangan' => 'required',
        ], $messages);

        JenisArsip::where("id", "$idJenis")->update([
            'kategori' => $x->kategori,
            'keterangan' => $x->keterangan,
        ], $cekValidasi);
        return redirect('/view-jenis')->with('toast_success', 'Data berhasil di update!');
    }
    
    //Hapus jenis surat
    public function hapusJenis($id)
    {
        try {
            JenisArsip::where('id', $id)->delete();
            return redirect('/view-jenis')->with('toast_success', 'Data berhasil di hapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/view-jenis')->with('toast_error', 'Data tidak bisa di hapus!');
        }
    }
}