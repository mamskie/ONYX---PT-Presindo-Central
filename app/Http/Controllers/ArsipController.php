<?php

namespace App\Http\Controllers;

use App\Models\JenisArsip;
use Illuminate\Http\Request;
use App\Models\Arsip;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;

class ArsipController extends Controller
{


    public function viewSm()
    {
        $dataSm = Arsip::all();
        return view("data.view-sm", ['data' => $dataSm]);
    }

    public function inputSm()
    {
        $dataSm = JenisArsip::all();
        return view("data.input-sm", ['data' => $dataSm]);
    }
    public function saveSm(Request $x)
    {
        //nomor generators
        $nomor = Helper::IdGenerator(new Arsip, 'nomor', '5', 'ARS');


        //Validasi
        $messages = [
            'nomor.required' => 'Nomor arsip tidak boleh kosong!',
            'tglMasuk.required' => 'Tanggal arsip tidak boleh kosong!',
            'nama.required' => 'nama tidak boleh kosong!',
            'kategori_id.required' => 'Perihal tidak boleh kosong!',
            'file.required' => 'File arsip tidak boleh kosong!',
            'file.mimes' => 'File harus berupa file dengan tipe: pdf dengan ukuran max: 2048',
        ];
        $cekValidasi = $x->validate([
            // 'nomor' => 'required',
            'tglMasuk' => 'required',
            'nama' => 'required',
            'kategori_id' => 'required',
            'file' => 'required|mimes:pdf|max:2048'
        ], $messages);

        $file = $x->file('file');
        if (empty($file)) {
            Arsip::create([
                'nomor' => $x->nomor,
                'tglMasuk' => $x->tglMasuk,
                'nama' => $x->nama,
                'kategori_id' => $x->kategori_id,
            ], $cekValidasi);
        } else {
            $nama_file = time() . "-" . $file->getClientOriginalName();
            $ekstensi = $file->getClientOriginalExtension();
            $ukuran = $file->getSize();
            $patAsli = $file->getRealPath();
            $namaFolder = 'file';
            $file->move($namaFolder, $nama_file);
            $pathPublic = $namaFolder . "/" . $nama_file;

            Arsip::create([
                'nomor' => $nomor,
                'tglMasuk' => $x->tglMasuk,
                'nama' => $x->nama,
                'kategori_id' => $x->kategori_id,
                'file' => $pathPublic,
            ], $cekValidasi);
        }
        return redirect('/view-sm')->with('toast_success', 'Data berhasil tambah!');
    }

    //Edit arsip masuk
    public function editSm($idSmasuk)
    {
        $dataJenis = JenisArsip::all();
        $dataSm = Arsip::find($idSmasuk);
        return view("data.edit-sm", ['data' => $dataSm], ['jenis' => $dataJenis]);
    }
    public function updateSm($idSmasuk, Request $x)
    {
        //Validasi
        $messages = [
            'nomor.required' => 'Nomor arsip tidak boleh kosong!',
            'tglMasuk.required' => 'Tanggal arsip tidak boleh kosong!',
            'nama.required' => 'nama tidak boleh kosong!',
            'kategori_id.required' => 'Perihal tidak boleh kosong!',
            //'file.required' => 'File arsip tidak boleh kosong!',
            'file.mimes' => 'File harus berupa file dengan tipe: pdf dengan ukuran max: 2048',
        ];
        $cekValidasi = $x->validate([
            'nomor' => 'required',
            'tglMasuk' => 'required',
            'nama' => 'required',
            'kategori_id' => 'required',
            'file' => 'mimes:pdf|max:2048'
        ], $messages);

        $file = $x->file('file');
        if (file_exists($file)) {
            $nama_file = time() . "-" . $file->getClientOriginalName();
            $folder = 'file';
            $file->move($folder, $nama_file);
            $path = $folder . "/" . $nama_file;
            //delete
            $data = Arsip::where('id', $idSmasuk)->first();
            File::delete($data->file);
        } else {
            $path = $x->pathFile;
        }
        Arsip::where("id", "$idSmasuk")->update([
            'nomor' => $x->nomor,
            'tglMasuk' => $x->tglMasuk,
            'nama' => $x->nama,
            'kategori_id' => $x->kategori_id,
            'file' => $path,

        ], $cekValidasi);
        return redirect('/view-sm')->with('toast_success', 'Data berhasil di update!');
    }

    //hapus arsip masuk
    public function hapusSm($idSmasuk)
    {
        try {
            $data = Arsip::where('id', $idSmasuk)->first();
            File::delete($data->file);
            Arsip::where('id', $idSmasuk)->delete();
            return redirect('/view-sm')->with('toast_success', 'Data berhasil di hapus!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/view-sm')->with('toast_error', 'Data tidak bisa di hapus!');
        }
    }
}