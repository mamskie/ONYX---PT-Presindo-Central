<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisArsip extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "kategori";
    protected $primaryKey = "id";
    protected $fillable = ["kategori","keterangan"];

    public function Arsip(){
        return $this->hasMany(Arsip::class, 'kategori_id');
    }
}