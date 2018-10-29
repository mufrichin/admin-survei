<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata_mahasiswa extends Model
{
    protected $table = "biodata_mahasiswa";
    protected $fillable = ["nim", "nama", "email", "prodi", "jurusan", "fakultas", "kelas", "tahun"];
}
