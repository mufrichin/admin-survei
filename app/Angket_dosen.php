<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angket_dosen extends Model
{
    protected $table = "angket_dosen";

    function biodata_dosen(){
    	return $this->belongsTo("App\Biodata_dosen", "dosen_nip", "nip");
    }
}
