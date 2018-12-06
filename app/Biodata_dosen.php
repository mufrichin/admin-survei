<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata_dosen extends Model
{
    protected $table = "biodata_dosen";
    protected $fillable = ["nip", "nama", "jurusan", "fakultas"];

    public function angket_dosen(){
    	return $this->hasMany("App\Angket_dosen", 'nip', 'dosen_nip');
    }
}
