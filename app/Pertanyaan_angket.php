<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertanyaan_angket extends Model
{
    use SoftDeletes;
    protected $table = "pertanyaan_angket";
    protected $dates = ["deleted_at"];
    protected $fillable = ['kd_pertanyaan', 'pertanyaan', 'sasaran'];
}
