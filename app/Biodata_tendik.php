<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biodata_tendik extends Model
{
    protected $table = "biodata_tendik";
    protected $fillable = ["nip", "nama", "nama_unit"];
}
