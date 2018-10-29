<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angket_tendik extends Model
{
    protected $table = "angket_tendik";
    protected $fillable = ["nip", "nama", "nama_unit"];
}
