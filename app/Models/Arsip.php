<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "data";
    protected $primaryKey = "id";
    protected $fillable = ["nomor","tglMasuk","nama","file","kategori_id"];
    //protected $fillable = ["nomor","nama","file","kategori_id"];

    public function JenisArsip(){
        return $this->belongsTo(JenisArsip::class, 'kategori_id');
    }
}
