<?php

namespace App\Http\Controllers;

use App\Models\JenisArsip;
use App\Models\JenisArsip as ModelsJenisArsip;
use Illuminate\Http\Request;
use App\Models\Arsip;
use App\Models\User;
use Illuminate\Support\Facades\File;

class DataController extends Controller
{
    //View Layout
    public function Main()
    {
        return view("layouts.main");
    }
    //View Halaman Utama
    public function index()
    {
        $data2 = User::count();
        $keluar = JenisArsip::count();
        $Arsip = Arsip::count();
        $data = [$data2, $keluar, $Arsip];

        return view("index",['data'=>$data] );
        //return view("index", compact('keluar'),compact('data2')  );
    }

}